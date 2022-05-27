<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MateriaStoreRequest;
use App\Http\Resources\MateriaResource;
use App\Models\Materia;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    public function index()
    {
        return MateriaResource::collection(materia::all());
    }

    public function store(MateriaStoreRequest $request)
    {
        $materia = Materia::create($request->validated());

        return ['estado_accion' => true];
    }

    public function show(Materia $materia)
    {
        return new MateriaResource($materia);
    }

    public function update($id, MateriaStoreRequest $request)
    {
        $materia = Materia::find($id);

        $materia->update($request->validated());

        return ['estado_accion' => true];
    }

    public function destroy($id, Materia $materia)
    {
        $materia = Materia::find($id);

        $materia->delete();
        return response()->noContent();
    }

    public function calcularHoras(Request $request)
    {
        $materias = Materia::whereIn('id', $request->get('vectormaterias'))->get();

        $total_horas = 0;

        foreach($materias as $materia)
        {
            $total_horas = $total_horas + $materia->nhor_mat;
        }

        return ['total_horas' => $total_horas];
    }
}
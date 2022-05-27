<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PeriodoStoreRequest;
use App\Http\Resources\PeriodoResource;
use App\Models\Periodo;
use Illuminate\Http\Request;

class PeriodoController extends Controller
{
    public function index()
    {
        return PeriodoResource::collection(periodo::orderBy('created_at', 'desc')->get()); 
    }

    public function listAsignadoc()
    {
        return periodo::where('estado', 'En curso')->orderBy('created_at', 'desc')->get(); 
    }

    public function store(PeriodoStoreRequest $request)
    {
        $periodo = Periodo::where('ano_per', $request->get('ano_per'))
                        ->where('peri_per', $request->get('peri_per'))
                        ->first();

        if($periodo)
        {
            return ['estado_accion' => false, 'mensaje' => 'El periodo ingresado ya existe'];
        }
        
        $periodo = Periodo::create($request->validated());

        return ['estado_accion' => true];
    }

    public function show(Periodo $periodo)
    {
        return new PeriodoResource($periodo);
    }

    public function update(PeriodoStoreRequest $request, $id)
    {
        $periodo = Periodo::where('ano_per', $request->get('ano_per'))
                        ->where('peri_per', $request->get('peri_per'))
                        ->first();

        if($periodo)
        {
            if($periodo->id != $id)
            {
                return ['estado_accion' => false, 'mensaje' => 'El periodo ingresado ya existe'];
            }
        }

        $periodo = Periodo::find($id);

        $periodo->update($request->validated());

        return ['estado_accion' => true];
    }

    public function destroy(Periodo $periodo)
    {
        $periodo->delete();
        return response()->noContent();
    }

    public function finalizar($id)
    {
        $periodo = Periodo::find($id);

        $periodo->estado = 'Finalizado';

        $periodo->save();

        return response(true);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EjecursoStoreRequest;
use App\Http\Resources\EjecursoResource;
use App\Models\Ejecurso;
use Illuminate\Http\Request;

class EjecursoController extends Controller
{
    public function index()
    {
        return EjecursoResource::collection(ejecurso::all());
    }

    public function store(EjecursoStoreRequest $request)
    {
        $ejecurso = Ejecurso::create($request->validated());

        return ['estado_accion' => true];
    }

    public function show(Ejecurso $ejecurso)
    {
        return new EjecursoResource($ejecurso);
    }

    public function update(Ejecurso $ejecurso, EjecursoStoreRequest $request)
    {
        $ejecurso->update($request->validated());
        
        return ['estado_accion' => true];
    }

    public function destroy(Ejecurso $ejecurso)
    {
        $ejecurso->delete();
        return response()->noContent();
    }

}

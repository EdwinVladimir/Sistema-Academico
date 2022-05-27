<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EspecialidadStoreRequest;
use App\Http\Resources\EspecialidadResource;
use App\Models\Especialidad;
use Illuminate\Http\Request;

class EspecialidadController extends Controller
{
    public function index()
    {
        return EspecialidadResource::collection(especialidad::all());
    }

    public function store(EspecialidadStoreRequest $request)
    {
        $especialidad = Especialidad::create($request->validated());

        return ['estado_accion' => true];
    }

    public function show(Especialidad $especialidad)
    {
        return new EspecialidadResource($especialidad);
    }

    public function update(Especialidad $especialidad, EspecialidadStoreRequest $request)
    {
        $especialidad->update($request->validated());
        
        return ['estado_accion' => true];
    }

    public function destroy(Especialidad $especialidad)
    {
        $especialidad->delete();
        return response()->noContent();
    }

}

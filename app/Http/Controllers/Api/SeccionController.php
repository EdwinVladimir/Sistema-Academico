<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SeccionStoreRequest;
use App\Http\Resources\SeccionResource;
use App\Models\Seccion;
use Illuminate\Http\Request;

class SeccionController extends Controller
{
    public function index()
    {
        return SeccionResource::collection(seccion::all());
    }

    public function store(SeccionStoreRequest $request)
    {
        $seccion = Seccion::create($request->validated());

        return ['estado_accion' => true];
    }

    public function show(Seccion $seccion)
    {
        return new SeccionResource($seccion);
    }

    public function update(Seccion $seccion, SeccionStoreRequest $request)
    {
        $seccion->update($request->validated());
        
        return ['estado_accion' => true];
    }

    public function destroy(Seccion $seccion)
    {
        $seccion->delete();
        return response()->noContent();
    }
}


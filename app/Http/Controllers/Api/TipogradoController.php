<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TipogradoStoreRequest;
use App\Http\Resources\TipogradoResource;
use App\Models\Tipogrado;
use Illuminate\Http\Request;

class TipogradoController extends Controller
{
    public function index()
    {
        return TipogradoResource::collection(tipogrado::all());
    }

    public function store(TipogradoStoreRequest $request)
    {
        $tipogrado = Tipogrado::create($request->validated());

        return ['estado_accion' => true];
    }

    public function show(Tipogrado $tipogrado)
    {
        return new TipogradoResource($tipogrado); 
    }

    public function update(Tipogrado $tipogrado, TipogradoStoreRequest $request)
    {
        $tipogrado->update($request->validated());

        return ['estado_accion' => true];
    }

    public function destroy(Tipogrado $tipogrado)
    {
        $tipogrado->delete();
        return response()->noContent();
    }
}
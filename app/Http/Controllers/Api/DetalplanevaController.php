<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DetalplanevaStoreRequest;
use App\Http\Resources\DetalplanevaResource;
use App\Models\Detalplaneva;
use Illuminate\Http\Request;

class DetalplanevaController extends Controller
{
    public function index()
    {
        return DetalplanevaResource::collection(detalplaneva::all());
    }

    public function store(DetalplanevaStoreRequest $request)
    {

        if($request->hasFile('thumbnail')){
            $filename = $request->thumbnail->getClientOriginalName();
            info($filename); //log
        }
        $detalplaneva = Detalplaneva::create($request->validated());

        return new DetalplanevaResource($detalplaneva);
    }

    public function show(detalplaneva $detalplaneva)
    {
        return new DetalplanevaResource($detalplaneva);
    }

    public function update(Detalplaneva $detalplaneva, DetalplanevaStoreRequest $request)
    {
        $detalplaneva->update($request->validated());
        return new DetalplanevaResource(($detalplaneva));
    }

    public function destroy(detalplaneva $detalplaneva)
    {
        $detalplaneva->delete();
        return response()->noContent();
    }
}

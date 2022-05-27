<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ModalidadcursoStoreRequest;
use App\Http\Resources\ModalidadcursoResource;
use App\Models\Modalidadcurso;
use Illuminate\Http\Request;

class ModalidadcursoController extends Controller
{
    public function index()
    {
        return ModalidadcursoResource::collection(modalidadcurso::all());
     
    }

    public function store(ModalidadcursoStoreRequest $request)
    {
        // sleep(3);
        if($request->hasFile('thumbnail')){
            $filename = $request->thumbnail->getClientOriginalName();
            info($filename); //log
        }
        $modalidadcurso = Modalidadcurso::create($request->validated());

        return new ModalidadcursoResource($modalidadcurso);
    }

    public function show(Modalidadcurso $modalidadcurso)
    {
        return new ModalidadcursoResource($modalidadcurso);
    }

    public function update(Modalidadcurso $modalidadcurso, ModalidadcursoStoreRequest $request)
    {
      
        $modalidadcurso->update($request->validated());
        //dd($modalidadcurso);
        return new ModalidadcursoResource(($modalidadcurso));
    }

    public function destroy(Modalidadcurso $modalidadcurso)
    {
        $modalidadcurso->delete();
        return response()->noContent();
    }
}

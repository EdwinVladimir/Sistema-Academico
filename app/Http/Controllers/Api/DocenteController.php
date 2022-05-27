<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DocenteStoreRequest;
use App\Http\Resources\DocenteResource;

use App\Models\Docente;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use DB;

class DocenteController extends Controller
{
    public function index(Request $request)
    {
        $buscar = $request->input('name');

        return DocenteResource::collection(docente::Filtername($buscar)->Filterapel($buscar)->Filterdni($buscar)->get()->all());
    }

    public function store(DocenteStoreRequest $request)
    {
        $docente = Docente::create($request->validated());

        return ['estado_accion' => true];
    }

    public function show(Docente $docente)
    {
        return new DocenteResource($docente);
    }

    public function update(Docente $docente, DocenteStoreRequest $request)
    {
        $docente->update($request->validated());
        return new DocenteResource(($docente));
    }

    public function destroy(Docente $docente)
    {
        $docente->delete();
        return response()->noContent();
    }
    
    public function getDni(Request $request)
    {
        $docente = Docente::where('dni_doc', $request->get('dni_doc'))->first();

        return ['docente' => $docente];
    }

    public function getApellido($ape_al)
    {
        $lista_docentes = Docente::where('ape_doc', 'like', '%'. $ape_al .'%')->get();

        return ['lista_docentes' => $lista_docentes];
    }
}

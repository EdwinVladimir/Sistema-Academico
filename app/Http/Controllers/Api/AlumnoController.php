<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AlumnoStoreRequest;
use App\Http\Resources\AlumnoResource;

use App\Models\Alumno;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use DB;

class AlumnoController extends Controller
{
    public function index(Request $request)
    {   
        $buscar = $request->input('name');

        return AlumnoResource::collection(alumno::Filtername($buscar)->Filterapel($buscar)->Filterdni($buscar)->get()->all());
    }

    public function store(AlumnoStoreRequest $request)
    {
        $alumno = Alumno::create($request->validated());

        return ['estado_accion' => true];
    }

    public function show(Alumno $alumno)
    {
        return new AlumnoResource($alumno);
    }

    public function update(Alumno $alumno, AlumnoStoreRequest $request)
    {
        $alumno->update($request->validated());
        
        return ['estado_accion' => true];
    }

    public function destroy(Alumno $alumno)
    {
        $alumno->delete();
        return response()->noContent();
    }
    
    public function getDni(Request $request)
    {
        $alumno = Alumno::where('dni_al', $request->get('dni_al'))->first();

        return ['alumno' => $alumno];
    }

    public function getApellido($ape_al)
    {
        $lista_estudiantes = Alumno::where('ape_al', 'like', '%'. $ape_al .'%')->get();

        return ['lista_estudiantes' => $lista_estudiantes];
    }
}

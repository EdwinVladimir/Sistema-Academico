<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MatriculaStoreRequest;
use App\Http\Resources\MatriculaResource;
use App\Http\Resources\ModalidadcursoResource;
use App\Models\{Asignadoc, Evaluacion, Matricula, Planeva, PromedioMateria};
use Illuminate\Http\Request;

use DB;

class MatriculaController extends Controller
{
    public function index(Request $request)
    {

        $buscarp = $request->input('periodo_id');
        $buscarc = $request->input('curso_id');
        $buscar = $request->input('name');
            
        return MatriculaResource::collection(matricula::Filterpid($buscarp)->Filtercid($buscarc)->FilterNpd($buscar)->orderBy('id', 'desc')->get()->all());
        
    }

    public function store(MatriculaStoreRequest $request)
    {
        $validacionMatricula = Matricula::where('periodo_id', $request->get('periodo_id'))
                                        ->where('alumno_id', $request->get('alumno_id'))
                                        ->where('curso_id', $request->get('curso_id'))
                                        ->where('seccion_id', $request->get('seccion_id'))
                                        ->first();

        if($validacionMatricula)
        {
            return ['estado_accion' => false];
        }

        try
        {
            DB::beginTransaction();
            
            $matricula = Matricula::create($request->validated());

            $lista_asignadoc = Asignadoc::where('periodo_id', $request->get('periodo_id'))
                                    ->where('curso_id', $request->get('curso_id'))
                                    ->where('seccion_id', $request->get('seccion_id'))
                                    ->where('estado', 'Planificado')
                                    ->get();

            foreach($lista_asignadoc as $asignadoc)
            {
                $lista_planes = Planeva::with('detalplanevas')
                                        ->where('docente_id', $asignadoc->docente_id)
                                        ->where('periodo_id', $asignadoc->periodo_id)
                                        ->where('materia_id', $asignadoc->materia_id)
                                        ->get();

                foreach($lista_planes as $plan)
                {
                    $evaluacion = new Evaluacion();

                    $evaluacion->fecreg_eval     = date('Y-m-d');
                    $evaluacion->nota_deteva     = 0;
                    $evaluacion->alumno_id       = $matricula->alumnos->id;
                    $evaluacion->periodo_id      = $matricula->periodo_id;
                    $evaluacion->materia_id      = $asignadoc->materia_id;
                    $evaluacion->detalplaneva_id = $plan->detalplanevas[0]->id;

                    $evaluacion->save();
                }
            }

            DB::commit();

            return ['estado_accion' => true];
        }
        catch(Exception $e)
        {
            DB::rollback();

            return ['estado_accion' => false];
        }
    }

    public function show(Matricula $matricula)
    {
        return new MatriculaResource($matricula);
    }

    public function update(Matricula $matricula, MatriculaStoreRequest $request)
    {
        $validacionMatricula = Matricula::where('periodo_id', $request->get('periodo_id'))
                                        ->where('alumno_id', $request->get('alumno_id'))
                                        ->where('curso_id', $request->get('curso_id'))
                                        ->where('seccion_id', $request->get('seccion_id'))
                                        ->first();

        if($validacionMatricula)
        {
            if($validacionMatricula->id != $request->get('id'))
            {
                return ['estado_accion' => false];
            }
        }

        $matricula->update($request->validated());
        
        return ['estado_accion' => true];
    }

    public function destroy(Matricula $matricula)
    {
        $matricula->delete();

        return ['estado_accion' => true];
    }
}
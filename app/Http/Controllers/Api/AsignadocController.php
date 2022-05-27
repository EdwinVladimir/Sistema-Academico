<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AsignadocStoreRequest;
use App\Http\Resources\AsignadocResource;

use App\Models\Asignadoc;
use App\Models\Evaluacion;
use App\Models\Detalplaneva;
use App\Models\Matricula;
use App\Models\Planeva;

use Illuminate\Http\Request;

use DB;
use Session;

class AsignadocController extends Controller
{
    public function index(Request $request)
    {
        if($request->input('docente_id'))
        {
            return AsignadocResource::collection(asignadoc::FilterDocente($request->input('docente_id'))->orderby('created_at', 'desc')->get()->all());
        }

        return AsignadocResource::collection(asignadoc::orderby('created_at', 'desc')->get()->all());
    }

    //permite registrar asignaciones a docentes
    public function store(AsignadocStoreRequest $request)
    {
        $validacionAsignacion = Asignadoc::where('docente_id', $request->get('docente_id'))
                                        ->where('periodo_id', $request->get('periodo_id'))
                                        ->where('seccion_id', $request->get('seccion_id'))
                                        ->where('materia_id', $request->get('materia_id'))
                                        ->where('curso_id', $request->get('curso_id'))
                                        ->where('aula_id', $request->get('aula_id'))
                                        ->first();

        if($validacionAsignacion)
        {
            return ['estado_accion' => false];
        }

        $asignadoc = Asignadoc::create($request->all());

        return ['estado_accion' => true];
    }

    public function show(Asignadoc $asignadoc)
    {
        return new AsignadocResource($asignadoc);
    }

    public function update(Asignadoc $asignadoc, AsignadocStoreRequest $request)
    {
        $validacionAsignacion = Asignadoc::where('docente_id', $request->get('docente_id'))
                                        ->where('periodo_id', $request->get('periodo_id'))
                                        ->where('seccion_id', $request->get('seccion_id'))
                                        ->where('materia_id', $request->get('materia_id'))
                                        ->where('curso_id', $request->get('curso_id'))
                                        ->where('aula_id', $request->get('aula_id'))
                                        ->first();

        if($validacionAsignacion)
        {
            if($validacionAsignacion->id != $request->get('id'))
            {
                return ['estado_accion' => false];
            }
        }

        $asignadoc->update($request->validated());

        return ['estado_accion' => true];
    }

    public function destroy(Asignadoc $asignadoc)
    {
        try
        {
            DB::beginTransaction();

            $planevas = Planeva::where('docente_id', $asignadoc->docente_id)
                            ->where('periodo_id', $asignadoc->periodo_id)
                            ->where('materia_id', $asignadoc->materia_id)
                            ->get();

            foreach($planevas as $planeva)
            {
                $detalle_planeva = Detalplaneva::where('planeva_id', $planeva->id)->first();

                $evaluacion = Evaluacion::where('periodo_id', $asignadoc->periodo_id)
                                        ->where('materia_id', $asignadoc->materia_id)
                                        ->where('detalplaneva_id', $detalle_planeva->id)
                                        ->delete();

                $detalle_planeva->delete();

                $matriculas = Matricula::where('periodo_id', $asignadoc->periodo_id)
                                        ->where('curso_id', $asignadoc->curso_id)
                                        ->where('seccion_id', $asignadoc->seccion_id)
                                        ->delete();
            }

            $planevas = Planeva::where('docente_id', $asignadoc->docente_id)
                                ->where('periodo_id', $asignadoc->periodo_id)
                                ->where('materia_id', $asignadoc->materia_id)
                                ->delete();

            $asignadoc->delete();
                
            DB::commit();

            return ['estado_accion' => true];    
        }
        catch(Exception $e)
        {
            DB::rollback();

            return ['estado_accion' => true]; 
        }
    }

    public function guardarPlanificacion($id)
    {
        try
        {
            DB::beginTransaction();

            $asignadoc = Asignadoc::find($id);

            $asignadoc->estado = 'Planificado';

            $asignadoc->save();

            $lista_matriculas = Matricula::with('alumnos')
                                            ->where('periodo_id', $asignadoc->periodo_id)
                                            ->where('curso_id', $asignadoc->curso_id)
                                            ->where('seccion_id', $asignadoc->seccion_id)
                                            ->get();


            $lista_planes = Planeva::with('detalplanevas')
                                    ->where('docente_id', $asignadoc->docente_id)
                                    ->where('periodo_id', $asignadoc->periodo_id)
                                    ->where('materia_id', $asignadoc->materia_id)
                                    ->get();

            foreach($lista_matriculas as $matricula)
            {
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

            return response()->json(true);
        }
        catch(Exception $e)
        {
            DB::rollback();

            return response()->json(false);
        }
    }

}

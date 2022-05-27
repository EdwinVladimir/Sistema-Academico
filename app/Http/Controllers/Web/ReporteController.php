<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;

use App\Models\Alumno;
use App\Models\Asignadoc;
use App\Models\Docente;
use App\Models\Curso;
use App\Models\Materia;
use App\Models\Matricula;
use App\Models\Planeva;
use App\Models\PromedioMateria;
use App\Models\Periodo;
use App\Models\RangoPromedio;

use Illuminate\Http\Request;

use DB;
use PDF;
use Session;

class ReporteController extends Controller
{
    public function filtros()
    {
        $docente_id = '';
        $roles_check = '';

        foreach(Session::get('usuario')->user_roles as $role)
        {
            $roles_check = $roles_check == '' ? $role->rol->name : $roles_check .','. $role->rol->name;

            if($docente_id == '' && $role->rol->name == 'Docente')
            {
                $docente_id = Session::get('usuario')->docente[0]->id;
            }
        }

        if($docente_id)
        {
            $ids_periodos = Asignadoc::where('docente_id', Session::get('usuario')->docente[0]->id)->get('periodo_id');

            $lista_periodos = Periodo::whereIn('id', $ids_periodos)->orderBy('ano_per', 'desc')->get();
        }
        else
        {
            $lista_periodos = Periodo::orderBy('ano_per', 'desc')->get();
        }

        $lista_estudiantes = Alumno::orderBy('ape_al', 'asc')->get();

        $lista_rangos = RangoPromedio::orderBy('nota_minima', 'asc')->get();


        return ['lista_estudiantes' => $lista_estudiantes, 'lista_periodos' => $lista_periodos, 'lista_rangos' => $lista_rangos];
    }

    public function listarPeriodos($alumno_id)
    {
        $periodos_ids = Matricula::where('alumno_id', $alumno_id)->get('periodo_id');

        $lista_periodos = Periodo::whereIn('id', $periodos_ids)->get();

        return ['lista_periodos' => $lista_periodos];
    }

    public function listarCursosHistorial($alumno_id)
    {
        $cursos_ids = Matricula::where('alumno_id', $alumno_id)
                                ->get('curso_id');
        
        $lista_cursos = Curso::whereIn('id', $cursos_ids)->get();

        return ['lista_cursos' => $lista_cursos];
    }

    public function listarCursos($periodo_id, $alumno_id = null)
    {
        if($alumno_id)
        {
            $cursos_ids = Matricula::where('alumno_id', Session::get('usuario')->alumno[0]->id)
                                ->where('periodo_id', $periodo_id)
                                ->get('curso_id');
        }
        else
        {
            $cursos_ids = Matricula::where('periodo_id', $periodo_id)->get('curso_id');
        }
        
        $lista_cursos = Curso::whereIn('id', $cursos_ids)->get();

        return ['lista_cursos' => $lista_cursos];
    }

    public function listarMaterias($periodo_id, $curso_id, $docente_id)
    {
        $materias_ids = Asignadoc::where('periodo_id', $periodo_id)
                                    ->where('curso_id', $curso_id)
                                    ->where('docente_id', $docente_id)
                                    ->where('estado', 'Planificado')
                                    ->get('materia_id');

        $lista_materias = Materia::whereIn('id', $materias_ids)->get();

        return ['lista_materias' => $lista_materias];
    }

    public function listarDocentes($periodo_id, $curso_id)
    {
        $docentes_ids = Asignadoc::where('periodo_id', $periodo_id)
                                    ->where('curso_id', $curso_id)
                                    ->get('docente_id');

        $lista_docentes = Docente::whereIn('id', $docentes_ids)->get();

        return ['lista_docentes' => $lista_docentes];
    }

    public function listarAlumnos($periodo_id, $curso_id)
    {
        $alumno_ids = Matricula::where('periodo_id', $periodo_id)
                                ->where('curso_id', $curso_id)
                                ->get('alumno_id');

        $lista_alumnos = Alumno::whereIn('id', $alumno_ids)->get();

        return ['lista_alumnos' => $lista_alumnos];
    }

    public function matriculas()
    {
        return view('web.reportematriculas'); 
    }

    public function matriculasDescargar($curso_id, $periodo_id, $type)
    {
        $lista_matriculas = Matricula::where('curso_id', $curso_id)
                                    ->where('periodo_id', $periodo_id)
                                    ->orderby('feins_matri', 'asc')
                                    ->get();

        if(count($lista_matriculas) > 0 )
        {
            $curso   = Curso::find($curso_id);
            $periodo = Periodo::find($periodo_id);

            $jefe_departamento = DB::table('pie_reporte')->where('cargo', 'Jefe departamento')->first();
            $supervisor        = DB::table('pie_reporte')->where('cargo', 'Supervisor')->first();
                
            if($type == 'preview')
            {
                return view('web.reporte.matricula', [

                    'curso' => $curso,
                    'periodo' => $periodo,
                    'lista_matriculas' => $lista_matriculas,
                    'jefe_departamento' => $jefe_departamento,
                    'supervisor' => $supervisor,
                    'type' => $type,
                ]);
            }

            $pdf = PDF::loadView('web.reporte.matricula', 

                [
                    'curso' => $curso,
                    'periodo' => $periodo,
                    'lista_matriculas' => $lista_matriculas,
                    'jefe_departamento' => $jefe_departamento,
                    'supervisor' => $supervisor,
                    'type' => $type,
                ]
            );
                    
            $pdf->setPaper('A4');

            return $pdf->download('Reporte Matrículas.pdf');
            //return $pdf->stream();
        }                       

        return "No existe información para los datos filtrados.";
    }

    public function registroNotas()
    {
        return view('web.reporteregistronotas');
    }
 
    public function registroNotaDescargar($curso_id, $materia_id, $periodo_id, $docente_id, $type)
    {
        $asignadoc = null;

        if($docente_id)
        {
            $asignadoc = Asignadoc::where('docente_id', $docente_id)
                                ->where('curso_id', $curso_id)
                                ->where('materia_id', $materia_id)
                                ->where('periodo_id', $periodo_id)
                                ->first();
        }
        
        if($asignadoc)
        {
            $lista_matriculas = Matricula::where('periodo_id', $periodo_id)
                                    ->where('curso_id', $curso_id)
                                    ->where('seccion_id', $asignadoc->seccion_id)
                                    ->get();

            $lista_reporte = [];

            if(count($lista_matriculas) > 0)
            {
                foreach($lista_matriculas as $matricula)
                {
                    $promedio_materia = PromedioMateria::where('matricula_id', $matricula->id)
                                                        ->where('materia_id', $materia_id)
                                                        ->first();

                    $promedio_letra = RangoPromedio::where('nota_minima', '<=', $promedio_materia->nota)
                                                    ->where('nota_maxima', '>=', $promedio_materia->nota)
                                                    ->first();

                    $reporte = [

                        'grado' => $matricula->alumnos->tipogrado->nom_grado,
                        'alumno' => $matricula->alumnos->ape_al .' '. $matricula->alumnos->nom_al,
                        'promedio_numero' => round($promedio_materia->nota),
                        'promedio_letra' => $promedio_letra->nombre
                    ];

                    array_push($lista_reporte, $reporte);
                }

                $curso   = Curso::find($curso_id);
                $materia = Materia::find($materia_id);
                $periodo = Periodo::find($periodo_id);
                $docente = Docente::find($docente_id);

                if($type == 'preview')
                {
                    return view('web.reporte.reporte_registro_notas', [

                        'curso' => $curso, 'docente' => $docente, 'materia' => $materia, 'periodo' => $periodo ,'lista_reporte' => $lista_reporte, 'type' => $type,
                    ]);
                }

                $pdf = PDF::loadView('web.reporte.reporte_registro_notas', ['curso' => $curso, 'docente' => $docente, 'materia' => $materia, 'periodo' => $periodo ,'lista_reporte' => $lista_reporte, 'type' => $type,]);
                        
                $pdf->setPaper('A4');

                return $pdf->download('Reporte Registro de Notas.pdf');
                //return $pdf->stream();
            }
            
            return "No existe información para los datos filtrados.";
        }

        return "No existe información para los datos filtrados.";
    }

    public function notas()
    {
        return view('web.reportenotas'); 
    }

    public function notasDescargar($curso_id, $periodo_id, $type)
    {
        $matricula = Matricula::with('cursos.materias')
                            ->where('alumno_id', Session::get('usuario')->alumno[0]->id)
                            ->where('curso_id', $curso_id)
                            ->where('periodo_id', $periodo_id)
                            ->first();

        $lista_reporte = [];

        if($matricula)
        {
            foreach($matricula->cursos->materias as $materia)
            {
                $asignadoc = Asignadoc::where('seccion_id', $matricula->seccion_id)
                                ->where('curso_id', $curso_id)
                                ->where('materia_id', $materia->id)
                                ->where('periodo_id', $periodo_id)
                                ->first();

                $promedio_general = 0;

                if($asignadoc)
                {
                    $lista_planes = Planeva::with('detalplanevas.evaluacions')
                                    ->where('docente_id', $asignadoc->docente_id)
                                    ->where('periodo_id', $periodo_id)
                                    ->where('materia_id', $materia->id)
                                    ->get();

                                    
                    $promedio_actitudinal = 0;
                    $promedio_individual  = 0;
                    $promedio_grupal      = 0;

                    $cantidad_actitudinal = 0;
                    $cantidad_individual  = 0;
                    $cantidad_grupal      = 0;

                    foreach($lista_planes as $planeva)
                    {
                        foreach($planeva->detalplanevas[0]->evaluacions as $evaluacion)
                        {
                            if($evaluacion->detalplanevas->tipoact_acti == 'Aporte actitudinal' && $matricula->alumno_id == $evaluacion->alumno_id && $evaluacion->materia_id)
                            {
                                $promedio_actitudinal = $promedio_actitudinal + $evaluacion->nota_deteva;

                                $cantidad_actitudinal++;
                            }
                            elseif($evaluacion->detalplanevas->tipoact_acti == 'Aporte individual' && $matricula->alumno_id == $evaluacion->alumno_id)
                            {
                                $promedio_individual = $promedio_individual + $evaluacion->nota_deteva;

                                $cantidad_individual++;
                            }
                            elseif($evaluacion->detalplanevas->tipoact_acti == 'Aporte grupal' && $matricula->alumno_id == $evaluacion->alumno_id)
                            {
                                $promedio_grupal = $promedio_grupal + $evaluacion->nota_deteva;

                                $cantidad_grupal++;
                            }
                        }
                    }

                    if($cantidad_actitudinal > 0 && $cantidad_individual > 0 && $cantidad_grupal > 0)
                    {
                        $promedio_actitudinal = ($promedio_actitudinal / $cantidad_actitudinal) * $asignadoc->porcentaje_actitudinal / 100;
                        $promedio_individual  = ($promedio_individual / $cantidad_individual) * $asignadoc->porcentaje_individual / 100;
                        $promedio_grupal      = ($promedio_grupal / $cantidad_grupal) * $asignadoc->porcentaje_grupal / 100;

                        $promedio_general = round($promedio_actitudinal + $promedio_individual + $promedio_grupal);
                    }
                }

                if($promedio_general >= 19)
                {
                    $promedio_letra = 'Sobresaliente';
                }
                else if($promedio_general >= 17 && $promedio_general <= 18)
                {
                    $promedio_letra = 'Muy Buena';
                }
                else if($promedio_general >= 13 && $promedio_general <= 16)
                {
                    $promedio_letra = 'Regular';
                }
                else if($promedio_general >= 0 && $promedio_general <= 15)
                {
                    $promedio_letra = 'Malo';
                }

                $reporte = [

                    'materia' => $materia->nom_mat,
                    'promedio_numero' => $promedio_general,
                    'promedio_letra' => $promedio_letra
                ];

                array_push($lista_reporte, $reporte);
            }

            $alumno = $matricula->alumnos;
            $curso   = Curso::find($curso_id);
            $periodo = Periodo::find($periodo_id);

            $lista_rangos = RangoPromedio::all();

            $jefe_seccion = DB::table('pie_reporte')->where('cargo', 'Jefe sección')->first();

            if($type == 'preview')
            {
                return view('web.reporte.notas', [

                    'curso' => $curso, 'alumno' => $alumno, 'periodo' => $periodo ,'lista_reporte' => $lista_reporte, 'lista_rangos' => $lista_rangos, 'jefe_seccion' => $jefe_seccion, 'type' => $type
                ]);
            }

            $pdf = PDF::loadView('web.reporte.notas', ['curso' => $curso, 'alumno' => $alumno, 'periodo' => $periodo ,'lista_reporte' => $lista_reporte, 'lista_rangos' => $lista_rangos, 'jefe_seccion' => $jefe_seccion, 'type' => $type]);
                    
            $pdf->setPaper('A4');

            return $pdf->download('Reporte Mis Notas.pdf');
            //return $pdf->stream();
        }

        return "No existe información para los datos filtrados.";
    }

    public function cursos()
    {
        return view('web.reportecursos'); 
    }

    public function cursosDescargar($curso_id, $periodo_id, $type)
    {
        $matriculas = Matricula::with('cursos.materias')
                            ->where('curso_id', $curso_id)
                            ->where('periodo_id', $periodo_id)
                            ->get();

        $lista_reporte = [];

        if(count($matriculas))
        {
            foreach($matriculas as $matricula)
            {
                $notas_materia = [];

                $curso_materias = DB::table('curso_materia')->where('curso_id', $matricula->curso_id)->get();

                $promedio_curso = 0;
                $cantidad_materias = 0;

                foreach($curso_materias as $key => $materia)
                {
                    $promedio_materia = PromedioMateria::where('matricula_id', $matricula->id)
                                                        ->where('materia_id', $curso_materias[$key]->materia_id)
                                                        ->first();

                    if($promedio_materia)
                    {
                        $promedio_materia = round($promedio_materia->nota);
                    }
                    else
                    {
                        $promedio_materia = 0;
                    }

                    $promedio_curso = $promedio_curso + $promedio_materia;

                    $cantidad_materias++;

                    array_push($notas_materia, $promedio_materia);
                }

                $promedio_curso = round($promedio_curso / ($cantidad_materias ? $cantidad_materias : 1));

                $promedio_letra = RangoPromedio::where('nota_minima', '<=', $promedio_curso)
                                                    ->where('nota_maxima', '>=', $promedio_curso)
                                                    ->first();

                $reporte = [

                    'grado' => $matricula->alumnos->tipogrado->nom_grado,
                    'alumno' => $matricula->alumnos->ape_al .' '. $matricula->alumnos->nom_al,
                    'notas_materia' => $notas_materia,
                    'promedio_curso' => round($promedio_curso),
                    'promedio_letra' => $promedio_letra->nombre,
                ];

                array_push($lista_reporte, $reporte);
            }

            $alumno   = $matricula->alumnos;
            $curso    = Curso::find($curso_id);
            $periodo  = Periodo::find($periodo_id);
            $materias = $matricula->cursos->materias;
            
            $jefe_departamento = DB::table('pie_reporte')->where('cargo', 'Jefe departamento')->first();
            $supervisor        = DB::table('pie_reporte')->where('cargo', 'Supervisor')->first();

            if($type == 'preview')
            {
                return view('web.reporte.cursos', [

                    'curso' => $curso, 'alumno' => $alumno, 'periodo' => $periodo , 'materias' => $materias, 'lista_reporte' => $lista_reporte, 'jefe_departamento' => $jefe_departamento, 'supervisor' => $supervisor, 'type' => $type
                ]);
            }
            
            
            $pdf = PDF::loadView('web.reporte.cursos', ['curso' => $curso, 'alumno' => $alumno, 'periodo' => $periodo , 'materias' => $materias, 'lista_reporte' => $lista_reporte, 'jefe_departamento' => $jefe_departamento, 'supervisor' => $supervisor, 'type' => $type]);
                    
            $pdf->setPaper('A4');

            return $pdf->download('Reporte De Cursos.pdf');
            //return $pdf->stream();
        }

        return "No existe información para los datos filtrados.";
    }

    public function aptitudMaterias()
    {
        return view('web.reporteaptitudmaterias'); 
    }

    public function registroNotaAptitudDescargar($curso_id, $materia_id, $periodo_id, $docente_id, $type)
    {
        $asignadoc = null;

        if($docente_id)
        {
            $asignadoc = Asignadoc::where('docente_id', $docente_id)
                                ->where('curso_id', $curso_id)
                                ->where('materia_id', $materia_id)
                                ->where('periodo_id', $periodo_id)
                                ->first();
        }
        
        if($asignadoc)
        {
            $lista_matriculas = Matricula::where('periodo_id', $periodo_id)
                                    ->where('curso_id', $curso_id)
                                    ->where('seccion_id', $asignadoc->seccion_id)
                                    ->get();

            $lista_planes = Planeva::with('detalplanevas.evaluacions')
                                    ->where('docente_id', $docente_id)
                                    ->where('periodo_id', $periodo_id)
                                    ->where('materia_id', $materia_id)
                                    ->get();

            $lista_reporte = [];

            if(count($lista_matriculas) > 0)
            {
                foreach($lista_matriculas as $matricula)
                {
                    $notas_materia = [];

                    foreach($matricula->cursos->materias as $materia)
                    {
                        $asignadoc = Asignadoc::where('seccion_id', $matricula->seccion_id)
                                    ->where('curso_id', $curso_id)
                                    ->where('materia_id', $materia->id)
                                    ->where('periodo_id', $periodo_id)
                                    ->first();

                        $promedio_general = 0;

                        if($asignadoc)
                        {
                            $lista_planes = Planeva::with('detalplanevas.evaluacions')
                                            ->where('docente_id', $asignadoc->docente_id)
                                            ->where('periodo_id', $periodo_id)
                                            ->where('materia_id', $materia->id)
                                            ->get();


                            $promedio_actitudinal = 0;
                            $promedio_individual  = 0;
                            $promedio_grupal      = 0;

                            $cantidad_actitudinal = 0;
                            $cantidad_individual  = 0;
                            $cantidad_grupal      = 0;

                            foreach($lista_planes as $planeva)
                            {
                                foreach($planeva->detalplanevas[0]->evaluacions as $evaluacion)
                                {
                                    if($evaluacion->detalplanevas->tipoact_acti == 'Aporte actitudinal' && $matricula->alumno_id == $evaluacion->alumno_id && $evaluacion->materia_id)
                                    {
                                        $promedio_actitudinal = $promedio_actitudinal + $evaluacion->nota_deteva;

                                        $cantidad_actitudinal++;
                                    }
                                    elseif($evaluacion->detalplanevas->tipoact_acti == 'Aporte individual' && $matricula->alumno_id == $evaluacion->alumno_id)
                                    {
                                        $promedio_individual = $promedio_individual + $evaluacion->nota_deteva;

                                        $cantidad_individual++;
                                    }
                                    elseif($evaluacion->detalplanevas->tipoact_acti == 'Aporte grupal' && $matricula->alumno_id == $evaluacion->alumno_id)
                                    {
                                        $promedio_grupal = $promedio_grupal + $evaluacion->nota_deteva;

                                        $cantidad_grupal++;
                                    }
                                }
                            }

                            if($cantidad_actitudinal > 0 && $cantidad_individual > 0 && $cantidad_grupal > 0)
                            {
                                $promedio_actitudinal = ($promedio_actitudinal / $cantidad_actitudinal) * $asignadoc->porcentaje_actitudinal / 100;
                                $promedio_individual  = ($promedio_individual / $cantidad_individual) * $asignadoc->porcentaje_individual / 100;
                                $promedio_grupal      = ($promedio_grupal / $cantidad_grupal) * $asignadoc->porcentaje_grupal / 100;

                                $promedio_general = $promedio_actitudinal + $promedio_individual + $promedio_grupal;
                            }
                        }

                        if($promedio_general >= 19)
                        {
                            $promedio_letra = 'Sobresaliente';
                        }
                        else if($promedio_general >= 17 && $promedio_general <= 18)
                        {
                            $promedio_letra = 'Muy Buena';
                        }
                        else if($promedio_general >= 13 && $promedio_general <= 16)
                        {
                            $promedio_letra = 'Regular';
                        }
                        else if($promedio_general >= 0 && $promedio_general <= 15)
                        {
                            $promedio_letra = 'Malo';
                        }

                        array_push($notas_materia, $promedio_general);
                    }

                    $promedio_aptitudinal = round($promedio_individual) + round($promedio_grupal) + round($promedio_actitudinal);

                    $promedio_letra = RangoPromedio::where('nota_minima', '<=', $promedio_aptitudinal)
                                                    ->where('nota_maxima', '>=', $promedio_aptitudinal)
                                                    ->first();

                    $reporte = [

                        'grado' => $matricula->alumnos->tipogrado->nom_grado,
                        'alumno' => $matricula->alumnos->ape_al .' '. $matricula->alumnos->nom_al,
                        'promedio_actitudinal' => round($promedio_actitudinal),
                        'promedio_individual' => round($promedio_individual),
                        'promedio_grupal' => round($promedio_grupal),
                        'promedio_aptitudinal' => $promedio_aptitudinal,
                        'promedio_letra' => $promedio_letra,
                    ];

                    array_push($lista_reporte, $reporte);
                }

                $curso   = Curso::find($curso_id);
                $materia = Materia::find($materia_id);
                $periodo = Periodo::find($periodo_id);
                $docente = Docente::find($docente_id);

                if($type == 'preview')
                {
                    return view('web.reporte.aptitud_materias', [

                        'curso' => $curso, 'docente' => $docente, 'materia' => $materia, 'periodo' => $periodo ,'lista_reporte' => $lista_reporte, 'type' => $type,
                    ]);
                }

                $pdf = PDF::loadView('web.reporte.aptitud_materias', ['curso' => $curso, 'docente' => $docente, 'materia' => $materia, 'periodo' => $periodo ,'lista_reporte' => $lista_reporte, 'type' => $type,]);
                        
                $pdf->setPaper('A4');

                return $pdf->download('Reporte Registro de Notas.pdf');
            }
            
            return "No existe información para los datos filtrados.";
        }

        return "No existe información para los datos filtrados.";
    }

    public function aptitudCursos()
    {
        return view('web.reporteaptitudcursos');
    }

    public function aptitudCursosDescargar($curso_id, $periodo_id, $alumno_id, $type)
    {
        $matricula = Matricula::with('cursos.materias')
                            ->where('alumno_id', $alumno_id)
                            ->where('curso_id', $curso_id)
                            ->where('periodo_id', $periodo_id)
                            ->first();

        $lista_reporte = [];

        if($matricula)
        {
            foreach($matricula->cursos->materias as $materia)
            {
                $asignadoc = Asignadoc::where('seccion_id', $matricula->seccion_id)
                                ->where('curso_id', $curso_id)
                                ->where('materia_id', $materia->id)
                                ->where('periodo_id', $periodo_id)
                                ->first();

                $promedio_general = 0;

                $promedio_actitudinal = 0;
                $promedio_individual  = 0;
                $promedio_grupal      = 0;

                $cantidad_actitudinal = 0;
                $cantidad_individual  = 0;
                $cantidad_grupal      = 0;

                if($asignadoc)
                {
                    $lista_planes = Planeva::with('detalplanevas.evaluacions')
                                    ->where('docente_id', $asignadoc->docente_id)
                                    ->where('periodo_id', $periodo_id)
                                    ->where('materia_id', $materia->id)
                                    ->get();
                    
                    foreach($lista_planes as $planeva)
                    {
                        foreach($planeva->detalplanevas[0]->evaluacions as $evaluacion)
                        {
                            if($evaluacion->detalplanevas->tipoact_acti == 'Aporte actitudinal' && $matricula->alumno_id == $evaluacion->alumno_id && $evaluacion->materia_id)
                            {
                                $promedio_actitudinal = $promedio_actitudinal + $evaluacion->nota_deteva;

                                $cantidad_actitudinal++;
                            }
                            elseif($evaluacion->detalplanevas->tipoact_acti == 'Aporte individual' && $matricula->alumno_id == $evaluacion->alumno_id)
                            {
                                $promedio_individual = $promedio_individual + $evaluacion->nota_deteva;

                                $cantidad_individual++;
                            }
                            elseif($evaluacion->detalplanevas->tipoact_acti == 'Aporte grupal' && $matricula->alumno_id == $evaluacion->alumno_id)
                            {
                                $promedio_grupal = $promedio_grupal + $evaluacion->nota_deteva;

                                $cantidad_grupal++;
                            }
                        }
                    }

                    if($cantidad_actitudinal > 0 && $cantidad_individual > 0 && $cantidad_grupal > 0)
                    {
                        $promedio_actitudinal = ($promedio_actitudinal / $cantidad_actitudinal) * $asignadoc->porcentaje_actitudinal / 100;
                        $promedio_individual  = ($promedio_individual / $cantidad_individual) * $asignadoc->porcentaje_individual / 100;
                        $promedio_grupal      = ($promedio_grupal / $cantidad_grupal) * $asignadoc->porcentaje_grupal / 100;

                        $promedio_general = round($promedio_actitudinal + $promedio_individual + $promedio_grupal);
                    }
                }
                
                $promedio_letra = RangoPromedio::where('nota_minima', '<=', $promedio_general)
                                                    ->where('nota_maxima', '>=', $promedio_general)
                                                    ->first();

                $reporte = [

                    'materia' => $materia->nom_mat,
                    'promedio_actitudinal' => $promedio_actitudinal,
                    'promedio_individual' => $promedio_individual,
                    'promedio_grupal' => $promedio_grupal,
                    'promedio_numero' => $promedio_general,
                    'promedio_letra' => $promedio_letra->nombre
                ];

                array_push($lista_reporte, $reporte);
            }

            $alumno = $matricula->alumnos;
            $curso   = Curso::find($curso_id);
            $periodo = Periodo::find($periodo_id);

            $lista_rangos = RangoPromedio::all();

            $jefe_seccion = DB::table('pie_reporte')->where('cargo', 'Jefe sección')->first();

            if($type == 'preview')
            {
                return view('web.reporte.aptitud_cursos', [

                    'curso' => $curso, 'alumno' => $alumno, 'periodo' => $periodo ,'lista_reporte' => $lista_reporte, 'lista_rangos' => $lista_rangos, 'jefe_seccion' => $jefe_seccion, 'type' => $type
                ]);
            }

            $pdf = PDF::loadView('web.reporte.aptitud_cursos', ['curso' => $curso, 'alumno' => $alumno, 'periodo' => $periodo ,'lista_reporte' => $lista_reporte, 'lista_rangos' => $lista_rangos, 'jefe_seccion' => $jefe_seccion, 'type' => $type]);
                    
            $pdf->setPaper('A4');

            return $pdf->download('Reporte Mis Notas.pdf');
            //return $pdf->stream();
        }

        return "No existe información para los datos filtrados.";
    }

    public function historialEstudiante()
    {
        return view('web.reportehistorialestudiante');
    }

    public function historialEstudianteDescargar($alumno_id, $type)
    {
        $lista_matriculas = Matricula::with(['cursos.materias', 'periodos'])
                            ->where('alumno_id', $alumno_id)
                            ->orderby('created_at')
                            ->get();

        $lista_reporte = [];

        if(count($lista_matriculas) > 0)
        {
            foreach($lista_matriculas as $matricula)
            {
                $lista_materias = [];

                foreach($matricula->cursos->materias as $materia)
                {
                    $promedio_materia = PromedioMateria::where('matricula_id', $matricula->id)
                                                        ->where('materia_id', $materia->id)
                                                        ->first();
                    
                    if($promedio_materia)
                    {
                        $promedio_letra = RangoPromedio::where('nota_minima', '<=', $promedio_materia->nota)
                                                        ->where('nota_maxima', '>=', $promedio_materia->nota)
                                                        ->first();

                        array_push($lista_materias, ["materia" => $materia->nom_mat, "promedio_materia" => $promedio_materia->nota]);
                    }
                    else
                    {
                        array_push($lista_materias, ["materia" => $materia->nom_mat, "promedio_materia" => 0]);
                    }
                }

                $reporte = [

                    'periodo' => $matricula->periodos->peri_per .' ('. $matricula->periodos->ano_per .')',
                    'curso' => $matricula->cursos->nom_cur,
                    'materias' => $lista_materias,
                ];

                array_push($lista_reporte, $reporte);
            }

            $alumno = Alumno::with('tipogrado')->find($alumno_id);

            $supervisor        = DB::table('pie_reporte')->where('cargo', 'Supervisor')->first();
            $jefe_departamento = DB::table('pie_reporte')->where('cargo', 'Jefe departamento')->first();

            if($type == 'preview')
            {
                return view('web.reporte.historial_estudiante', [

                    'alumno' => $alumno, 'lista_reporte' => $lista_reporte, 'jefe_departamento' => $jefe_departamento, 'supervisor' => $supervisor, 'type' => $type
                ]);
            }

            $pdf = PDF::loadView('web.reporte.historial_estudiante', [

                    'alumno' => $alumno, 'lista_reporte' => $lista_reporte, 'jefe_departamento' => $jefe_departamento, 'supervisor' => $supervisor, 'type' => $type
                ]);
                    
            $pdf->setPaper('A4');

            return $pdf->download('Reporte Mis Notas.pdf');
            //return $pdf->stream();
        }

        return "No existe información para los datos filtrados.";
    }

    public function historialDocente()
    {
        return view('web.reportehistorialdocente');
    }

    public function historialDocenteDescargar($docente_id, $type)
    {
        $lista_asignadoc = Asignadoc::with(['materias.cursos', 'periodos'])
                            ->where('docente_id', $docente_id)
                            ->orderby('created_at', 'desc')
                            ->get();

        $lista_reporte = [];

        if(count($lista_asignadoc) > 0)
        {
            foreach($lista_asignadoc as $asignadoc)
            {
                $lista_materias = [];

                $curso = Curso::find($asignadoc->curso_id);

                $reporte = [

                    'periodo' => $asignadoc->periodos->peri_per .' ('. $asignadoc->periodos->ano_per .')',
                    'curso' => $curso->nom_cur,
                    'materias' => $asignadoc->materias->nom_mat,
                    'horas' => $asignadoc->materias->nhor_mat,
                ];

                array_push($lista_reporte, $reporte);
            }

            $docente = Docente::with('tipogrado')->find($docente_id);

            $supervisor        = DB::table('pie_reporte')->where('cargo', 'Supervisor')->first();
            $jefe_departamento = DB::table('pie_reporte')->where('cargo', 'Jefe departamento')->first();

            if($type == 'preview')
            {
                return view('web.reporte.historial_docente', [

                    'docente' => $docente, 'lista_reporte' => $lista_reporte, 'jefe_departamento' => $jefe_departamento, 'supervisor' => $supervisor, 'type' => $type
                ]);
            }

            $pdf = PDF::loadView('web.reporte.historial_docente', [

                    'docente' => $docente, 'lista_reporte' => $lista_reporte, 'jefe_departamento' => $jefe_departamento, 'supervisor' => $supervisor, 'type' => $type
                ]);
                    
            $pdf->setPaper('A4');

            return $pdf->download('Reporte Mis Notas.pdf');
            //return $pdf->stream();
        }

        return "No existe información para los datos filtrados.";
    }
}
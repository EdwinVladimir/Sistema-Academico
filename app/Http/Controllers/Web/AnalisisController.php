<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Curso;
use App\Models\Materia;
use App\Models\Matricula;
use App\Models\PromedioMateria;
use App\Models\AuxPromedioCurso;
use App\Models\RangoPromedio;

use DB;
use stdClass;

class AnalisisController extends Controller
{
    public function analisisDatosCursos(){

        return view('web.analisis-datos-cursos');
    }

    public function analisisDatosCursosRangos(){

        return view('web.analisis-datos-cursos-rangos');
    }

    public function mostrarCursos($periodo_id)
    {
        $lista_matriculas = Matricula::select('curso_id')
                                    ->where('periodo_id', $periodo_id)
                                    ->groupBy('curso_id')
                                    ->get('curso_id');


        $lista_cursos   = Curso::whereIn('id', $lista_matriculas)->get();

        return ['lista_cursos' => $lista_cursos];
    }

    public function mostrarMaterias($curso_id)
    {
        $lista_materias = DB::table('curso_materia')
                            ->join('materias', 'curso_materia.materia_id', '=', 'materias.id')
                            ->where('curso_id', $curso_id)
                            ->select('materias.*')
                            ->get();

        return ['lista_materias' => $lista_materias];
    }

    public function analizar(Request $request)
    {
        //promedios de los cursos A y B para mostrar la comparación gráficamente
        $promedio_a = $this->CalcularPromedioCurso($request->get('periodo_id_a'), $request->get('curso_id_a'));
        $promedio_b = $this->CalcularPromedioCurso($request->get('periodo_id_b'), $request->get('curso_id_b'));

        //aprobados y desaprobados de los cursos A y B
        $cantidad_aprobado_desaprobado_a = $this->AprobadosDesaprobados($request->get('periodo_id_a'), $request->get('curso_id_a'));
        $cantidad_aprobado_desaprobado_b = $this->AprobadosDesaprobados($request->get('periodo_id_b'), $request->get('curso_id_b'));

        $cantidad_aprobado_a    = $cantidad_aprobado_desaprobado_a[0];
        $cantidad_desaprobado_a = $cantidad_aprobado_desaprobado_a[1];

        $cantidad_aprobado_b    = $cantidad_aprobado_desaprobado_b[0];
        $cantidad_desaprobado_b = $cantidad_aprobado_desaprobado_b[1];

        //promedio alumnos con mayor nota A y B
        $promedios_alumnos_a = $this->PromedioCursoMayorNota($request->get('periodo_id_a'), $request->get('curso_id_a'));
        $promedios_alumnos_b = $this->PromedioCursoMayorNota($request->get('periodo_id_b'), $request->get('curso_id_b'));

        $curso_a = Curso::find($request->get('curso_id_a'));
        $curso_b = Curso::find($request->get('curso_id_b'));

        return [

            'promedio_a' => $promedio_a, 
            'promedio_b' => $promedio_b,
            'curso_a'    => $curso_a->nom_cur, 
            'curso_b'    => $curso_b->nom_cur,

            'cantidad_aprobado_a' => $cantidad_aprobado_a,
            'cantidad_desaprobado_a' => $cantidad_desaprobado_a,
            'cantidad_aprobado_b' => $cantidad_aprobado_b,
            'cantidad_desaprobado_b' => $cantidad_desaprobado_b,

            'promedios_alumnos_a' => $promedios_alumnos_a,
            'promedios_alumnos_b' => $promedios_alumnos_b,
        ];
    }

    public function analizarMaterias(Request $request)
    {
        //promedio materias cursos A y B
        $promedios_materia_a = $this->PromedioMaterias($request->get('periodo_id_a'), $request->get('curso_id_a'), $request->get('materia_ids_a'));
        $promedios_materia_b = $this->PromedioMaterias($request->get('periodo_id_b'), $request->get('curso_id_b'), $request->get('materia_ids_b'));

        $curso_a = Curso::find($request->get('curso_id_a'));
        $curso_b = Curso::find($request->get('curso_id_b'));

        return [

            'curso_a' => $curso_a->nom_cur, 
            'curso_b' => $curso_b->nom_cur,

            'promedios_materia_a' => $promedios_materia_a,
            'promedios_materia_b' => $promedios_materia_b,
        ];
    }

    public function CalcularPromedioCurso($periodo_id, $curso_id)
    {
        $lista_matriculas = Matricula::with('cursos.materias')
                                        ->where('periodo_id', $periodo_id)
                                        ->where('curso_id', $curso_id)
                                        ->get();

        $promedio = 0;

        foreach($lista_matriculas as $matricula)
        {
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
            }

            $promedio_curso = round($promedio_curso / ($cantidad_materias ? $cantidad_materias : 1));

            $promedio = $promedio + round($promedio_curso);
        }

        $promedio = $promedio / count($lista_matriculas);

        return $promedio;
    }

    public function AprobadosDesaprobados($periodo_id, $curso_id)
    {
        $lista_matriculas = Matricula::with('cursos.materias')
                                        ->where('periodo_id', $periodo_id)
                                        ->where('curso_id', $curso_id)
                                        ->get();

        $cantidad_aprobado    = 0;
        $cantidad_desaprobado = 0;

        foreach($lista_matriculas as $matricula)
        {
            $promedio_curso = 0;
            $cantidad_materias = 0;

            $curso_materias = DB::table('curso_materia')->where('curso_id', $matricula->curso_id)->get();

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
            }

            $promedio_curso = round($promedio_curso / ($cantidad_materias ? $cantidad_materias : 1));

            if($promedio_curso > 15)
            {
                $cantidad_aprobado++;
            }
            else
            {
                $cantidad_desaprobado++;
            }
        }

        return [$cantidad_aprobado, $cantidad_desaprobado];
    }

    public function PromedioCursoMayorNota($periodo_id, $curso_id)
    {
        $lista_matriculas = Matricula::with('cursos.materias')
                                        ->where('periodo_id', $periodo_id)
                                        ->where('curso_id', $curso_id)
                                        ->get();

        $cantidad_aprobado    = 0;
        $cantidad_desaprobado = 0;

        DB::table('aux_promedio_curso')->truncate();

        foreach($lista_matriculas as $matricula)
        {
            $promedio_curso = 0;
            $cantidad_materias = 0;

            $curso_materias = DB::table('curso_materia')->where('curso_id', $matricula->curso_id)->get();

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
            }

            $promedio_curso = round($promedio_curso / ($cantidad_materias ? $cantidad_materias : 1));

            $aux_promedio_curso = new AuxPromedioCurso();

            $aux_promedio_curso->estudiante = $matricula->alumnos->nom_al .' '. $matricula->alumnos->ape_al;
            $aux_promedio_curso->nota       = round($promedio_curso);

            $aux_promedio_curso->save();
        }

        $promedio_mayor = AuxPromedioCurso::all('nota')->max();

        return AuxPromedioCurso::where('nota', $promedio_mayor->nota)->get();
    }

    public function analizarRangosCursos(Request $request)
    {
        //rango alumnos curso a y b
        $promedio_rango_alumnos_a = $this->PromedioCursoRango($request->get('periodo_id_a'), $request->get('curso_id_a'), $request->get('rangos_ids'));
        $promedio_rango_alumnos_b = $this->PromedioCursoRango($request->get('periodo_id_b'), $request->get('curso_id_b'), $request->get('rangos_ids'));

        $lista_rangos_check = RangoPromedio::whereIn('id', $request->get('rangos_ids'))->get(); 

        return [

            'promedio_rango_alumnos_a' => $promedio_rango_alumnos_a,
            'promedio_rango_alumnos_b' => $promedio_rango_alumnos_b,
            'lista_rangos_check' => $lista_rangos_check,
        ];
    }

    public function PromedioCursoRango($periodo_id, $curso_id, $rango_ids)
    {
        $lista_matriculas = Matricula::with('cursos.materias')
                                        ->where('periodo_id', $periodo_id)
                                        ->where('curso_id', $curso_id)
                                        ->get();

        $lista_rangos = [];

        $cantidad_sobresaliente = ['Sobresaliente', 0];
        $cantidad_muy_buena     = ['Muy buena', 0];
        $cantidad_buena         = ['Buena', 0];
        $cantidad_regular       = ['Regular', 0];
        $cantidad_deficiente    = ['Deficiente', 0];
        $cantidad_insuficiente  = ['Insuficiente', 0];

        foreach($lista_matriculas as $matricula)
        {
            $promedio_curso = 0;
            $cantidad_materias = 0;

            $curso_materias = DB::table('curso_materia')->where('curso_id', $matricula->curso_id)->get();

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
            }

            $promedio_curso = round($promedio_curso / ($cantidad_materias ? $cantidad_materias : 1));

            $rango_promedio = RangoPromedio::where('nota_minima', '<=', $promedio_curso)
                                                    ->where('nota_maxima', '>=', $promedio_curso)
                                                    ->first();

            if($cantidad_sobresaliente[0] == $rango_promedio->nombre)
                $cantidad_sobresaliente[1]++;

            if($cantidad_muy_buena[0] == $rango_promedio->nombre)
                $cantidad_muy_buena[1]++;

            if($cantidad_buena[0] == $rango_promedio->nombre)
                $cantidad_buena[1]++;

            if($cantidad_regular[0] == $rango_promedio->nombre)
                $cantidad_regular[1]++;

            if($cantidad_deficiente[0] == $rango_promedio->nombre)
                $cantidad_deficiente[1]++;

            if($cantidad_insuficiente[0] == $rango_promedio->nombre)
                $cantidad_insuficiente[1]++;
        }

        return [$cantidad_sobresaliente, $cantidad_muy_buena, $cantidad_buena, $cantidad_regular, $cantidad_deficiente, $cantidad_insuficiente];
    }

    public function PromedioMaterias($periodo_id, $curso_id, $materias_ids)
    {
        $lista_matriculas = Matricula::with('cursos.materias')
                                        ->where('periodo_id', $periodo_id)
                                        ->where('curso_id', $curso_id)
                                        ->get();

        $promedio_materias = [];

        for($i = 0; $i < count($materias_ids); $i++)
        {
            $cantidad_notas_materias = 0;
            $nota_total              = 0;

            foreach($lista_matriculas as $matricula)
            {
                $promedio_materia = PromedioMateria::where('matricula_id', $matricula->id)
                                                ->where('materia_id', $materias_ids[$i])
                                                ->first();

                if($promedio_materia)
                {
                    $nota_total = $nota_total + $promedio_materia->nota;

                    $cantidad_notas_materias++;
                }
            }

            $promedio_materia = round($nota_total / ($cantidad_notas_materias == 0 ? 1 : $cantidad_notas_materias ));

            $materia = Materia::find($materias_ids[$i]);

            array_push($promedio_materias, [ 'materia' => $materia->nom_mat, 'promedio' => $promedio_materia ]);
        }

        return $promedio_materias;
    }
}
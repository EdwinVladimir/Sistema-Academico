<?php
use Illuminate\Support\Facades\Route;


Route::get('/password', [App\Http\Controllers\Web\PasswordController::class, 'password'])->name('web');

Route::get('/salir', [App\Http\Controllers\Web\SalirController::class, 'salir'])->name('web');
 
Route::get('/', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('web');
Route::post('/user/login', [App\Http\Controllers\Web\UsuarioController::class, 'login'])->name('login');
Route::get('/user/recoveryPass', [App\Http\Controllers\Web\UsuarioController::class, 'recoveryPass']);
Route::post('/user/sendRecoveryPass', [App\Http\Controllers\Web\UsuarioController::class, 'sendCodeRecoveryPass']);
Route::get('/user/form/coderecuperation', [App\Http\Controllers\Web\UsuarioController::class, 'formRecuperationPass']);
Route::post('/user/code/validation', [App\Http\Controllers\Web\UsuarioController::class, 'codeValidationPass']);
Route::get('/logout', [App\Http\Controllers\Web\UsuarioController::class, 'logout'])->name('logout');

Route::get('home', [App\Http\Controllers\Admin\HomeController::class, 'home'])->name('home');

//Rutas del administrador
Route::group(['middleware' => 'administrador'], function(){

    Route::get('/usuario', [App\Http\Controllers\Web\UsuarioController::class, 'usuario'])->name('web');
});

//Rutas del docente
Route::group(['middleware' => 'docente'], function(){

    Route::get('/actividades', [App\Http\Controllers\Web\ActividadesController::class, 'actividades'])->name('web');

    Route::get('/evaluaciones', [App\Http\Controllers\Web\EvaluacionesController::class, 'evaluaciones'])->name('web');

    Route::get('/reporte/registro-notas', [App\Http\Controllers\Web\ReporteController::class, 'registroNotas'])->name('web');
    Route::get('/reporte/registro-notas/descargar/{curso_id}/{materia_id}/{periodo_id}/{docente_id}/{type}', [App\Http\Controllers\Web\ReporteController::class, 'registroNotaDescargar'])->name('web');

    Route::get('/reporte/listar/cursos/{periodo_id}', [App\Http\Controllers\Web\ReporteController::class, 'listarCursos']);
    Route::get('/reporte/listar/docentes/{periodo_id}/{curso_id}', [App\Http\Controllers\Web\ReporteController::class, 'listarDocentes']);
    Route::get('/reporte/listar/materias/{periodo_id}/{curso_id}/{docente_id}', [App\Http\Controllers\Web\ReporteController::class, 'listarMaterias']);

    Route::get('/reporte/aptitud-materia', [App\Http\Controllers\Web\ReporteController::class, 'aptitudMaterias'])->name('web');
    Route::get('/reporte/registro-notas-aptitud/descargar/{curso_id}/{materia_id}/{periodo_id}/{docente_id}/{type}', [App\Http\Controllers\Web\ReporteController::class, 'registroNotaAptitudDescargar'])->name('web');
});

//Rutas del docente
Route::group(['middleware' => 'estudiante'], function(){

    Route::get('/reporte/listar/periodos/{alumno_id}', [App\Http\Controllers\Web\ReporteController::class, 'listarPeriodos']);
    Route::get('/reporte/listar/cursos-alumnos/{periodo_id}', [App\Http\Controllers\Web\ReporteController::class, 'listarCursos']);
    Route::get('/reporte/listar/cursos-alumnos/{periodo_id}/{alumno_id}', [App\Http\Controllers\Web\ReporteController::class, 'listarCursos']);
    Route::get('/reporte/notas', [App\Http\Controllers\Web\ReporteController::class, 'notas'])->name('web');
    Route::get('/reporte/notas/descargar/{curso_id}/{periodo_id}/{type}', [App\Http\Controllers\Web\ReporteController::class, 'notasDescargar'])->name('web');

    Route::get('/reporte/aptitud-curso', [App\Http\Controllers\Web\ReporteController::class, 'aptitudCursos'])->name('web');
    Route::get('/reporte/aptitud-curso/descargar/{curso_id}/{periodo_id}/{alumno_id}/{type}', [App\Http\Controllers\Web\ReporteController::class, 'aptitudCursosDescargar'])->name('web');
    Route::get('/reporte/listar/alumnos/{periodo_id}/{curso_id}', [App\Http\Controllers\Web\ReporteController::class, 'listarAlumnos']);
});

//reportes
Route::get('/reporte/listar/filtros', [App\Http\Controllers\Web\ReporteController::class, 'filtros'])->name('web');

//Rutas del técnico
Route::group(['middleware' => 'tecnico'], function(){

    Route::get('/analisis-de-datos-cursos', [App\Http\Controllers\Web\AnalisisController::class, 'analisisDatosCursos'])->name('web');
    Route::get('/analisis-de-datos-cursos-rangos', [App\Http\Controllers\Web\AnalisisController::class, 'analisisDatosCursosRangos'])->name('web');

    Route::get('/analisis-de-datos/mostrarCursos/{periodo_id}', [App\Http\Controllers\Web\AnalisisController::class, 'mostrarCursos'])->name('web');
    Route::post('/analisis-de-datos/analizar/rangos', [App\Http\Controllers\Web\AnalisisController::class, 'analizarRangosCursos'])->name('web');
    Route::get('/analisis-de-datos/mostrarMaterias/{curso_id}', [App\Http\Controllers\Web\AnalisisController::class, 'mostrarMaterias'])->name('web');
    Route::post('/analisis-de-datos/analizar/promedio-materias', [App\Http\Controllers\Web\AnalisisController::class, 'analizarMaterias'])->name('web');

    Route::post('/analisis-de-datos/analizar', [App\Http\Controllers\Web\AnalisisController::class, 'analizar'])->name('web');

    Route::get('/estudiantes', [App\Http\Controllers\Web\EstudiantesController::class, 'estudiantes'])->name('web');

    Route::get('/docentes', [App\Http\Controllers\Web\DocentesController::class, 'docentes'])->name('web');

    Route::get('/periodos', [App\Http\Controllers\Web\PeriodosController::class, 'periodos'])->name('web');

    Route::get('/asignadoc', [App\Http\Controllers\Web\AsignadocController::class, 'asignadoc'])->name('web');

    Route::get('/matriculacion', [App\Http\Controllers\Web\MatriculacionController::class, 'matriculacion'])->name('web');

    Route::get('/aula', [App\Http\Controllers\Web\AulaController::class, 'aula'])->name('web');

    Route::get('/seccion', [App\Http\Controllers\Web\SeccionController::class, 'seccion'])->name('web');

    Route::get('/materias', [App\Http\Controllers\Web\MateriasController::class, 'materias'])->name('web');

    Route::get('/cursos', [App\Http\Controllers\Web\CursosController::class, 'cursos'])->name('web');

    Route::get('/reparto', [App\Http\Controllers\Web\RepartoController::class, 'reparto'])->name('web');

    Route::get('/especialidad', [App\Http\Controllers\Web\EspecialidadController::class, 'especialidad'])->name('web');

    Route::get('/tipogrado', [App\Http\Controllers\Web\TipogradoController::class, 'tipogrado'])->name('web');

    Route::get('/tipocurso', [App\Http\Controllers\Web\TipocursoController::class, 'tipocurso'])->name('web');

    Route::get('/ejecurso', [App\Http\Controllers\Web\EjecursoController::class, 'ejecurso'])->name('web');

    Route::get('/tiposangre', [App\Http\Controllers\Web\TiposangreController::class, 'tiposangre'])->name('web');

    Route::get('/porcentajes', [App\Http\Controllers\Web\PorcentajeNotaController::class, 'index'])->name('web');

    Route::get('/reporte/matriculas', [App\Http\Controllers\Web\ReporteController::class, 'matriculas'])->name('web');
    Route::get('/reporte/matriculas/descargar/{curso_id}/{periodo_id}/{type}', [App\Http\Controllers\Web\ReporteController::class, 'matriculasDescargar'])->name('web');

    Route::get('/reporte/cursos', [App\Http\Controllers\Web\ReporteController::class, 'cursos'])->name('web');
    Route::get('/reporte/cursos/descargar/{curso_id}/{periodo_id}/{type}', [App\Http\Controllers\Web\ReporteController::class, 'cursosDescargar'])->name('web');

    Route::get('/reporte/historial/cursos-alumnos/{alumno_id}', [App\Http\Controllers\Web\ReporteController::class, 'listarCursosHistorial']);
    Route::get('/reporte/historial-estudiante', [App\Http\Controllers\Web\ReporteController::class, 'historialEstudiante'])->name('web');
    Route::get('/reporte/historial-estudiante/descargar/{alumno_id}/{type}', [App\Http\Controllers\Web\ReporteController::class, 'historialEstudianteDescargar'])->name('web');

    Route::get('/reporte/historial-docente', [App\Http\Controllers\Web\ReporteController::class, 'historialDocente'])->name('web');
    Route::get('/reporte/historial-docente/descargar/{alumno_id}/{type}', [App\Http\Controllers\Web\ReporteController::class, 'historialDocenteDescargar'])->name('web');

    Route::get('/reporte/configurar-footer', [App\Http\Controllers\Web\PieReporteController::class, 'index'])->name('web');
});

Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('auth');

Route::get('/perfil', [App\Http\Controllers\Auth\PerfilController::class, 'perfil'])->name('auth');

Route::get('/dashboard', [App\Http\Controllers\Web\DashboardController::class, 'dashboard'])->name('web');


Route::get('/planes', [App\Http\Controllers\Web\PlanesController::class, 'planes'])->name('web');


Route::get('/modalidad', [App\Http\Controllers\Web\ModalidadController::class, 'modalidad'])->name('web');


Route::get('/general', [App\Http\Controllers\Web\GeneralController::class, 'general'])->name('web');

Route::get('/calificaciones', [App\Http\Controllers\Web\CalificacionesController::class, 'calificaciones'])->name('web');

Route::get('/analisisdatos', [App\Http\Controllers\Web\AnalisisdatosController::class, 'analisisdatos'])->name('web');

Route::get('/roles', [App\Http\Controllers\Web\RolesController::class, 'roles'])->name('web');


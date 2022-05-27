<?php

use App\Http\Controllers\Api\AsignadocController;
use App\Models\Asignadoc;
use App\Http\Controllers\Api\DetalplanevaController;
use App\Models\Detalplaneva;
use App\Http\Controllers\Api\AlumnoController;
use App\Models\Alumno;
use App\Http\Controllers\Api\AulaController;
use App\Models\Aula;
use App\Http\Controllers\Api\CursoController;
use App\Models\Curso;
use App\Http\Controllers\Api\DocenteController;
use App\Models\Docente;
use App\Http\Controllers\Api\EjecursoController;
use App\Models\Ejecurso;
use App\Http\Controllers\Api\EspecialidadController;
use App\Models\Especialidad;
use App\Http\Controllers\Api\EvaluacionController;
use App\Models\Evaluacion;
use App\Http\Controllers\Api\MateriaController;
use App\Models\Materia;
use App\Http\Controllers\Api\MatriculaController;
use App\Models\Matricula;
use App\Http\Controllers\Api\ModalidadcursoController;
use App\Models\Modalidadcurso;
use App\Http\Controllers\Api\PeriodoController;
use App\Models\Periodo;
use App\Http\Controllers\Api\PlanestudioController;
use App\Models\Planes;
use App\Http\Controllers\Api\PlanevaController;
use App\Models\Planeva;
use App\Http\Controllers\Api\RepartoController;
use App\Models\Reparto;
//use App\Http\Controllers\Api\RolesController;
use App\Http\Controllers\Api\SeccionController;
use App\Http\Controllers\Api\TipocursoController;
use App\Models\Tipocurso;
use App\Http\Controllers\Api\TipogradoController;
use App\Models\Tipogrado;
use App\Http\Controllers\Api\TiposangreController;
use App\Models\Tiposangre;
use App\Http\Controllers\Api\UserController;
Use App\Models\RoleUser;
use App\Http\Controllers\Api\RoleController;
Use App\Models\Role;
use App\Http\Controllers\Api\PermissionController;
Use App\Models\Permission;

use App\Http\Controllers\Api\{PorcentajeNotaController, ReportePieController};

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// API MODELO ACTIVIDAD
Route::apiResource('detalplaneva',DetalplanevaController::class);

// API MODELO ALUMNO
Route::apiResource('alumno',AlumnoController::class);
Route::get('buscar/alumno/byDni', [AlumnoController::class, 'getDni']);
Route::get('buscar/alumno/{byApellido}', [AlumnoController::class, 'getApellido']);

// API MODELO AULA
Route::apiResource('aula',AulaController::class);

// API MODELO EJECURSO
Route::apiResource('ejecurso',EjecursoController::class);

// API MODELO ESPECIALIDAD
Route::apiResource('especialidad',EspecialidadController::class);

//API MODELO EVALUACION
Route::apiResource('evaluacion', EvaluacionController::class);
Route::get('evaluacion/planificacion/{docente_id}/{periodo_id}/{curso_id}/{materia_id}/{seccion_id}/{aula_id}', [EvaluacionController::class, 'listarRegistro']);
Route::post('evaluacion/guadar/nota', [EvaluacionController::class, 'guardarNota']);
Route::post('evaluacion/guadar/promedio', [EvaluacionController::class, 'guardarPromedio']);

// API MODELO ASIGNADOC
Route::apiResource('asignadoc',AsignadocController::class);
Route::get('asignadoc/planificar/{idAsignadoc}', [AsignadocController::class, 'guardarPlanificacion']);

// API MODELO MATERIA
Route::apiResource('materia',MateriaController::class);
Route::post('materia/calcular-horas', [MateriaController::class, 'calcularHoras']);

// API MODELO CURSO
Route::apiResource('curso',CursoController::class);

// API MODELO MATRICULA
Route::apiResource('matricula',MatriculaController::class);

// API MODELO MODALIDAD
Route::apiResource('modalidad',ModalidadcursoController::class);

// API MODELO CLASE
Route::apiResource('clase',ClasesController::class);

// API MODELO DOCENTE
Route::apiResource('docente',DocenteController::class);
Route::get('buscar/docente/byDni', [DocenteController::class, 'getDni']);
Route::get('buscar/docente/{byApellido}', [DocenteController::class, 'getApellido']);

// API MODELO PERIODO
Route::apiResource('periodo',PeriodoController::class);
Route::get('listar/periodo', [PeriodoController::class, 'listAsignadoc']);
Route::get('periodo/finalizar/{id}', [PeriodoController::class, 'finalizar']);

// API MODELO PLANEVA
Route::apiResource('planeva',PlanevaController::class);

// API MODELO PLANESTUDIO
Route::apiResource('planestudio',PlanestudioController::class);

// API MODELO REPARTO
Route::apiResource('reparto',RepartoController::class);

// API MODELO ROLES
Route::apiResource('role',RoleController::class);

// API MODELO PERMISO
Route::apiResource('permission',PermissionController::class);

// API MODELO SECCION
Route::apiResource('seccion',SeccionController::class);

// API MODELO TIPOCURSO
Route::apiResource('tipocurso',TipocursoController::class);

// API MODELO TIPOGRADO
Route::apiResource('tipogrado',TipogradoController::class);

// API MODELO TIPOSANGRE
Route::apiResource('tiposangre',TiposangreController::class);

Route::apiResource('porcentajes',PorcentajeNotaController::class);

Route::apiResource('reporte-pie',ReportePieController::class);
Route::get('reporte-pie/actualizar', [ReportePieController::class, 'actualizar']);

// API MODELO USER
Route::apiResource('user',UserController::class);
Route::post('user/create/estudiante-docente', [UserController::class, 'createEstudianteDocente']);
Route::post('user/update/estudiante-docente/{id}', [UserController::class, 'updateEstudianteDocente']);

Route::post('user/create/usuario', [UserController::class, 'createUsuario']);
Route::post('user/update/usuario/{id}', [UserController::class, 'updateUsuario']);

Route::get('user/mostrar/{id}', [UserController::class, 'mostrar']);
Route::put('user/update/{id}', [UserController::class, 'update']);
Route::delete('user/delete/{id}', [UserController::class, 'delete']);

Route::get('user/resetear/{id}', [UserController::class, 'resetearPassword']);
Route::post('user/cambiar-password', [UserController::class, 'cambiarPassword']);
@extends('adminlte::page')

@section('title', 'Reporte de Notas Aptitud Cursos')

@section('content_header')

@stop

@section('content')
<link rel="stylesheet" href="/css/cargando.css">
<div id="loader"></div>
        
<div>
    <div id="app" data-app>
        <Reporteaptitudcursos-Reporteaptitudcursos></Reporteaptitudcursos-Reporteaptitudcursos>
    </div>
</div>     

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop 
<?php
    
    $roles_check = '';
    $alumno_id = '';

    foreach (Session::get('usuario')->user_roles as $role)
    {
        $roles_check = $roles_check == '' ? $role->rol->name : $roles_check .','. $role->rol->name;

        if($alumno_id == '' && $role->rol->name == 'Estudiante')
        {
            $alumno_id = Session::get('usuario')->alumno[0]->id;
        }
    }
?>
@section('js')
    <script>
        var rol        = '{{$roles_check}}';
        var usuario    = '{{Session::get('usuario')->email}}';
        var alumno_id = '{{$alumno_id}}';
    </script>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/permisos.js')}}?{{time()}}"></script>
    <script> console.log('Hit'); </script>
@stop
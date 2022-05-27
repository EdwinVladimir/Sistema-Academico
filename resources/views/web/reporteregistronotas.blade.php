@extends('adminlte::page')

@section('title', 'Reporte Registro de Notas')

@section('content_header')

@stop

@section('content')
<link rel="stylesheet" href="/css/cargando.css">
<div id="loader"></div>
      
<div>
    <div id="app" data-app>
        <Reporteregistronota-Reporteregistronota></Reporteregistronota-Reporteregistronota>
    </div>
</div>     

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop 
<?php
    $roles_check = '';
    $docente_id = '';

    foreach (Session::get('usuario')->user_roles as $role)
    {
        $roles_check = $roles_check == '' ? $role->rol->name : $roles_check .','. $role->rol->name;

        if($docente_id == '' && $role->rol->name == 'Docente')
        {
            $docente_id = Session::get('usuario')->docente[0]->id;
        }
    }
?>
@section('js')
    <script>
        var rol        = '{{$roles_check}}';
        var usuario    = '{{Session::get('usuario')->email}}';
        var docente_id = '{{$docente_id}}';
    </script>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/permisos.js')}}?{{time()}}"></script>
    <script> console.log('Hit'); </script>
@stop
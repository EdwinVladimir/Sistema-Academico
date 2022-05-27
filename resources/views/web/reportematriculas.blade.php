@extends('adminlte::page')

@section('title', 'Reporte de Matrículas')

@section('content_header')

@stop
<style>
    #loader {
        position: fixed;
        left: 0px;
        top: 0px;
        width: 100%; 
        height: 100%;
        z-index: 9999;
        background: url('/cargando.gif') 50% 50% no-repeat rgb(0,0,0);
        opacity: 0.92;
    }
</style>
@section('content')
<div id="loader"></div>   
<div>
    <div id="app" data-app>
        <Reportematricula-Reportematricula></Reportematricula-Reportematricula>
    </div>
</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop 
<?php
    $roles_check = '';

    foreach (Session::get('usuario')->user_roles as $role)
    {
        $roles_check = $roles_check == '' ? $role->rol->name : $roles_check .','. $role->rol->name;
    }
?>
@section('js')
    <script>
        var rol     = '{{$roles_check}}';
        var usuario = '{{Session::get('usuario')->email}}';
    </script>
    <script src="{{asset('js/app.js')}}"></script>
    //<script src="{{asset('js/permisos.js')}}?{{time()}}"></script>
    <script> console.log('Hit'); </script>
@stop
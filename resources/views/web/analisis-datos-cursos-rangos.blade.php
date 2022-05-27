@extends('adminlte::page')

@section('title', 'Análisis de datos Rangos de Cursos')

@section('content_header')

@stop
<style>
    .div-a
    {
        border: 1px solid #febaad;
        background-color: #febaad;
        margin-right: 10px;
    }
    .div-b
    {
        border: 1px solid #007bff;
        background-color: #007bff;
        margin-right: 10px;
    }
    input[type=checkbox], input[type=radio]
        {
            height: 20px;
            width: 20px;
        }
</style>
<script src="https://code.highcharts.com/highcharts.js"></script>
@section('content')
<link rel="stylesheet" href="/css/cargando.css">
<div id="loader"></div>

<div>
    <div id="app" data-app>
       <Analisisdatoscursosrangos-Analisisdatoscursosrangos></Analisisdatoscursosrangos-Analisisdatoscursosrangos>
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
    <script src="{{asset('js/permisos.js')}}?{{time()}}"></script>
    <script> console.log('Hit'); </script>
@stop

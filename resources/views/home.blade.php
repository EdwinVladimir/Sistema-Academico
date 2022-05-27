@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')

@stop

@section('css')
@stop

@section('content')
<link rel="stylesheet" href="/css/cargando.css">
<div id="loader"></div>

<div class="text-center">
    <h1 class="text-center">Bienvenido al Sistema</h1>
    <h1 class="text-center">SG Académico</h1>
    <h3>{{Session::get('usuario')->rol}}</h3>
</div>
<div class="login-logo">
              <img class="logo" src="{{asset('login/assets/images/ed.png')}}">
            
            </div>

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

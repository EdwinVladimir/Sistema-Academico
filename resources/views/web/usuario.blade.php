@extends('adminlte::page')

@section('title', 'Gestión de Usuarios')

@section('content_header')

@stop

@section('content')
<link rel="stylesheet" href="/css/cargando.css">
<div id="loader"></div>
      
<div>
    <div id="app" data-app>
        <Usuario-Usuario></Usuario-Usuario>
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
    <script>
        function EvaluateHttpResponse(status)
        {
            switch (status) {
                case 0:
                    swal(
                        'Error',
                        'No se pudo conectar con el servidor, verifique su conexion a internet',
                        'warning'
                    )
                    break;
                case 408:
                    swal(
                        'Error 408',
                        'El proceso excedio el limite de tiempo permitido.',
                        'warning'
                    )
                    break;
                case 401:
                        swal(
                            'Su sesión ha caducado',
                            'Debe iniciar sesión nuevamente',
                            'warning'
                        )
                        setTimeout(function(){ location.reload();}, 4000);
                        break;
                case 404:
                    swal(
                        'Recurso no encontrado',
                        'No se encontró el recurso solicitado',
                        'warning'
                    )

                    break;
                case 403:
                    swal(
                        'No Autorizado',
                        'No tiene autorización para realizar esta acción.',
                        'warning'
                    )
                    break;
                case 419:
                    swal(
                        'Token fallido',
                        'Su llave de seguridad ha expirado.',
                        'warning'
                    )
                    setTimeout(function(){ location.reload();}, 4000);
                    break;
                case 422:
                    swal(
                        'Error de validación',
                        'Revise el formulario y corrija los campos de color rojo',
                        'error'
                    )
                    break;
                case 500:
                    swal(
                        'Error 500',
                        'Error no controlado.',
                        'warning'
                    )

                    break;

            }
        }
    </script>
@stop

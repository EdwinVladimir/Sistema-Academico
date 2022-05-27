<!DOCTYPE html>
<html lang="es">

<head>
<title>SG Academico</title>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link href="{{asset('login/assets/css/custom.min.css')}}" rel="stylesheet">
 </head>
<body>

    <section id="login">
        <div class="container" id="c1">
          <div class="row">

            <div class="col-md-7 p-0">
              <div id="registro" class="login-wrapper">
                <div class="login-logo" style="margin-bottom: 0px;">
                <p style="margin-bottom: 0px;"> <img class="logo" src="{{asset('login/assets/images/user.png')}}" alt="Imagen user del login del SGA"/></p>
                </div>
                <div class="white-bg-login text-center">
                    <h3 align="center" style="color: #003882; font-size: 25px; font-family: Arial; font-weight: bold">Sistema Académico FAE SGA</h3>
                    <h4 class="text-primary">Nueva Contraseña</h4>
                    @if(Session::has('success'))
                        <div class="alert alert-success"  role="alert" style="margin-bottom: 10px;">
                            <strong>{{ Session::get('success') }} </strong>
                        </div>
                    @elseif(Session::has('error'))
                        <div class="alert alert-danger"  role="alert" style="margin-bottom: 10px;">
                            <strong>{{ Session::get('error') }} </strong>
                        </div>
                    @endif
                </div>
                    <form method="POST"  action="{{url('user/code/validation')}}" >
                        @csrf
                        <p for="cs-field field">
                            <label for="code_recuperation">Código:</label>
                            <input type="text" id="code_recuperation" name="code_recuperation" class="form-control _ge_de_ol" type="text" placeholder="" required="" aria-required="true" tabindex="1">
                        </p>
                        <p for="cs-field field">
                            <label for="new_password">Nueva contraseña:</label>
                            <input type="password" id="new_password" name="new_password" class="form-control _ge_de_ol" type="text" placeholder="" required="" aria-required="true" tabindex="1">
                        </p>
                        <p for="cs-field field">
                            <label for="confirmation_password">Confirmar contraseña:</label>
                            <input type="password" id="confirmation_password" name="confirmation_password" class="form-control _ge_de_ol" type="text" placeholder="" required="" aria-required="true" tabindex="1">
                        </p>
                        <button class="login-enviar cs-btn btn-blue">Actualizar Contraseña</button>
                   </form>
                </div>
            </div>
            <div id="login-img" class="col-md-5 p-0 h-100">
              <div class="img-fit">
                <img src="{{asset('login/assets/images/fondo.jpg')}}" alt="Imagen fondo  del login del SGA"> -->
              </div>
            </div>
          </div>
        </div>
    </section>
<script src="assets/js/custom.js"></script>
</body>
</html>
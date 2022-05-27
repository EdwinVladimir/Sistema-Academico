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
                <p> <img class="logo" src="{{asset('login/assets/images/user.png')}}" alt="Imagen user del login del SGA"/></p>
                </div>
                <div class="white-bg-login text-center">
                <h3 align="center" style="color: #003882; font-size: 25px; font-family: Arial; font-weight: bold">Sistema Académico FAE SGA</h3>
                <h4 class="text-primary">Recuperar Contraseña</h4>
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
                    <form method="POST" action="{{url('user/sendRecoveryPass')}}" >
                        @csrf
                        <p for="cs-field field">
                        <input type="email" name="email" class="form-control _ge_de_ol" type="text" placeholder="Correo electrónico" required="" aria-required="true" tabindex="1">
                        <br>
                        <button class="login-enviar cs-btn btn-blue">Recuperar contraseña</button>
                        <br>
                        <a href="{{url('/')}}" class="text text-primary">Iniciar Sesión</a>
                        <br>
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
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
            <div class="login-logo">
            <p> <img class="logo" src="{{asset('login/assets/images/user.png')}}" alt="Imagen user del login del SGA"/></p>
            </div>
            <div class="white-bg-login">
            <h3 align="center" style="color: #003882; font-size: 25px; font-family: Arial; font-weight: bold">Sistema Académico FAE SGA</h3>
            @if(Session::has('error-login'))
                <div class="alert alert-danger"  role="alert" style="margin-bottom: 0px;">
                    <strong>{{ Session::get('error-login') }} </strong>
                </div>
            @else
                <br>
                
            @endif
            </div>
                <form method="POST"  action="{{url('user/login')}}" >
                    @csrf
                    <p for="cs-field field">
                        <label for="pass">Usuario:</label>
                        <input type="email" id="pass" name="email" class="form-control _ge_de_ol" type="text" placeholder="Correo electrónico" required="" aria-required="true" tabindex="1">
                    </p>
                        <p for="cs-field field">
                        <label for="pass">Contraseña:</label>
                        <input type="password" id="pass" name="password" class="form-control _ge_de_ol" type="text" placeholder="Contraseña" required="" aria-required="true" tabindex="1">
                    </p>

                    <button class="login-enviar cs-btn btn-blue">Iniciar sesión</button>
                    <br>
                    <a href="{{url('user/recoveryPass')}}" class="text text-primary">¿Recuperar contraseña?</a>
                    <br>
                    <h1 align="center" style="color: blue; font-size: 20px; font-family: Arial; font-weight: bold">"Más alla del alcance de los cazas"</h1>
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
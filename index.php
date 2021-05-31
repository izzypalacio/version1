<?php

require_once("modelos/conexion.php");



if (isset($_POST["enviar"]) and $_POST["enviar"] == "si") {

  require_once("modelos/Usuarios.php");

  $usuario = new Usuarios();

  $usuario->login();
}

?>


<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sistema</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="public/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="public/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="public/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="public/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="public/plugins/iCheck/square/blue.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


</head>

<body>
  <div class="login-box">

    <main class="main d-flex w-100">
      <div>
        <div>
          <div>
            <div>



              <div class="card">
                <div class="card-body">
                  <div class="m-sm-4">
                    <div class="text-center">
                      <img src="img\logo.png" alt="Pan Samsil" class="img-fluid rounded-circle" width="300" height="75">
                    </div>

                    <div class="text-center mt-4">
                      <h1 class="h1">Bienvenidos</h1>

                    </div>
                    <form action="" method="post">
                      <div class="form-group">
                        <label>Usuario</label>
                        <input type="text" name="usuario" id="usuario" class="form-control form-control-lg" placeholder="Usuario" style="border-radius: 7px;" required="required">
                      </div>
                      <div class="form-group">

                        <label>Contraseña</label>
                        <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="Contraseña" style="border-radius: 7px;" required>
                      </div>
                      <br /><br />
                      <div class="form-group">
                        <input type="hidden" name="enviar" class="form-control" value="si">

                      </div>
                      <div class="row">

                        <div class="text-center mt-3">
                          <button type="submit" style="border-radius: 7px;" class="btn btn-lg btn-primary">Iniciar Sesión</button>
                        </div>
                        <!-- /.col -->
                      </div>
                    </form>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </main>

    <script src="js/app.js"></script>


    <!--INICIO MENSAJES DE ALERTA-->
    <div class="container-fluid">


      <div class="row">
        <div class="col-lg-12">

          <div class="box-body">

            <?php


            if (isset($_GET["m"])) {

              switch ($_GET["m"]) {


                case "1";
            ?>

                  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4></i> Usuario incorrecto</h4>

                  </div>

                <?php
                  break;


                case "2";
                ?>
                  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4></i> Los campos estan vacios</h4>

                  </div>
            <?php
                  break;
              }
            }


            ?>


          </div>


        </div>
      </div>
    </div>

  </div>
  </div>
  <!-- /.login-box -->


  <!-- jQuery 3 -->
  <script src="public/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="public/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- iCheck -->
  <script src="public/plugins/iCheck/icheck.min.js"></script>
  <script>
    $(function() {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
      });
    });
  </script>
</body>

</html>
<?php
require_once("../modelos/conexion.php");
if (isset($_SESSION["correo"])) {
?>

  <?php require_once("header.php"); ?>

  <!DOCTYPE html>
  <html>
  <header>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistema</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="../public/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../public/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../public/bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../public/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="../public/plugins/iCheck/square/blue.css">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link rel="stylesheet" href="../img/estilos.css">

  </header>

  <body>


    <div class="content-wrapper">
      <div class="image-fondo cabecera">
        <section class="content-header">
          <section id="top" class="one dark cover">
            <div class="container">
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
              <h1 class="text-center mt-4">Sistema De Costos De Produccion</h1>
              <br>
              <h1 class="text-center mt-4">Sispro</h1>
              <br>
              <br>
              <div class="text-center">
                <img src="../img\logo.png" alt="Pan Samsil" class="img-fluid rounded-circle" width="350" height="125">
              </div>


              <br>
              <h2 class="alt" align="center"></h2>
              <br>
              <br>
              <br>
              <br>
              <br>
              <br>
            </div>




          </section>
        </section>
      </div>
    </div>

    <script src="../public/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="../public/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="../public/plugins/iCheck/icheck.min.js"></script>



  </body>

  </html>

<?php

} else {

  header("Location:" . Conectar::ruta() . "index.php");
  exit();
}
?>
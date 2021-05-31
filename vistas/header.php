<?php


/*validamos si no existe una variable de session entonces el id de session es menor que 1 entonces iniciaria la session y si ya existen una session iniciada entonces no vamos hacer nada, esto para omitir algunos errores de que si ya ha existido la session anteriormente*/
if (strlen(session_id()) < 1)

  session_start();



require_once("../modelos/conexion.php");

if (isset($_SESSION["id_usuario"])) {

  /*Se llaman los modelos y se crean los objetos para llamar el numero de registros en el menu lateral izquierdo y en el home*/
  require_once("../modelos/Categorias.php");
  require_once("../modelos/producto.php");
  require_once("../modelos/Usuarios.php");
  require_once("../modelos/Dproducto.php");
  require_once("../modelos/Mprima.php");
  require_once("../modelos/Cfabricacion.php");
  require_once("../modelos/Batida.php");
  require_once("../modelos/cif.php");

  $categoria = new Categoria();
  $producto = new producto();
  $usuario = new Usuarios();
  $Dproducto = new Dproducto();
  $Mprima = new Mprima();
  $Cfabricacion = new Cfabricacion();
  $Batida = new Batida();
  $cif = new cif();
?>

  <!DOCTYPE html>
  <html>

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sispro | Pan Samsil</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="../public/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="../public/bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="../public/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="../public/datatables/jquery.dataTables.min.css">
    <link href="../public/datatables/buttons.dataTables.min.css" rel="stylesheet" />
    <link href="../public/datatables/responsive.dataTables.min.css" rel="stylesheet" />
    <!-- Theme style -->
    <link rel="stylesheet" href="../public/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="../public/dist/css/skins/_all-skins.min.css">
    <!-- Morris chart -->
    <link rel="stylesheet" href="../public/bower_components/morris.js/morris.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="../public/bower_components/jvectormap/jquery-jvectormap.css">
    <!-- Date Picker -->
    <link rel="stylesheet" href="../public/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="../public/bower_components/bootstrap-daterangepicker/daterangepicker.css">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="../public/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <!--ESTILOS-->
    <link rel="stylesheet" href="../public/css/estilos.css">
  </head>

  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              </a>
        </div>


      </header>

      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->

          <!-- opciones plegables -->
          <ul class="sidebar-menu" data-widget="tree">

            <li class="">
              <a href="home.php">
                <i class="fa fa-home" aria-hidden="true"></i> <span>Inicio</span>
              </a>

            </li>

            <?php if ($_SESSION["cif"] == 1) {

              echo '<li class="">

              <a href="cif.php">
                <i class="fa fa-list-alt" aria-hidden="true"></i><span>CIF</span>
              </a>
          </li>';
            }
            ?>





            <?php if ($_SESSION["categoria"] == 1) {

              echo '<li class="">

              <a href="categorias.php">
                <i class="fa fa-list-alt" aria-hidden="true"></i><span>Categoría</span>
              </a>
          </li>';
            }
            ?>



            <?php if ($_SESSION["producto"] == 1) {

              echo '

         <li class="">
          <a href="producto.php">
            <i class="fa fa-product-hunt" aria-hidden="true"></i><span>producto</span>
          </a>
        </li>';
            }
            ?>

            <?php if ($_SESSION["Mprima"] == 1) {

              echo '

         <li class="">
          <a href="Mprima.php">
            <i class="fa fa-money" aria-hidden="true"></i><span>Costos</span>
          </a>
        </li>';
            }
            ?>


            <?php if ($_SESSION["Dproducto"] == 1) {

              echo '

         <li class="sidebar-item">
            <a href="#pages" data-toggle="collapse" class="sidebar-link collapsed">
              <i class="fa fa-cogs" aria-hidden="true"></i><i class="align-middle" data-feather="layout"></i> <span class="align-middle">Formulas</span>
            </a>
            <ul style="text-align:center;" id="pages" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
              <li class="sidebar-item"><a class="sidebar-link" href="Dproducto.php">Generar Formula</a></li>
              <br>
              <li class="sidebar-item"><a class="sidebar-link" href="update.php">Actualizar Formula</a></li>
              <br>
              <li class="sidebar-item"><a class="sidebar-link" href="consultar_Dproducto.php">Formulas</a></li>
              
            </ul>
          </li>';
            }
            ?>

            <?php if ($_SESSION["Batida"] == 1) {

              echo '<li class="sidebar-item">
            <a href="#layouts" data-toggle="collapse" class="sidebar-link collapsed">
              <i class="fa fa-calculator" aria-hidden="true"></i><i class="align-middle" data-feather="monitor"></i> <span class="align-middle">Produccion</span>
            </a>
            <ul style="text-align:center;" id="layouts" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
              <li class="sidebar-item"><a class="sidebar-link" href="Batida.php">Generar Produccion</a></li>
             <br>
              <li class="sidebar-item"><a class="sidebar-link" href="consultar_Batida.php">Reportes</a></li>
              
            </ul>
          </li>';
            }
            ?>




            <?php if ($_SESSION["usuarios"] == 1) {

              echo '

         <li class="">
          <a href="usuarios.php">
            <i class="fa fa-users" aria-hidden="true"></i><span>usuarios</span>
          </a>
        </li>';
            }
            ?>

            <li class="">
              <a href="logout.php">
                <i class="fa fa-sign-out" aria-hidden="true"></i><span>Salir</span>
              </a>
            </li>





          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <div id="resultados_ajax" class="text-center"></div>



    <?php

  } else {

    header("Location:" . Conectar::ruta() . "index.php");
    exit();
  }
    ?>
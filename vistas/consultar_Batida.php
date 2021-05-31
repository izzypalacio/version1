<?php

require_once("../modelos/conexion.php");

if (isset($_SESSION["id_usuario"])) {


?>


  <!-- INICIO DEL HEADER - LIBRERIAS -->
  <?php require_once("header.php"); ?>

  <!-- FIN DEL HEADER - LIBRERIAS -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1 align="center">
        Consulta Produccion

      </h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <div id="resultados_ajax"></div>

      <div class="panel panel-default">

        <div class="panel-body">

          <div class="btn-group text-center">
            <a href="consultar_Batida_fecha.php" class="btn btn-primary btn-lg"><i aria-hidden="true"></i>Produccion Por Fecha</a>
          </div>

          <div class="btn-group text-center">
            <a href="consultar_Batida_mes.php" class="btn btn-primary btn-lg"><i aria-hidden="true"></i>Produccion Por Meses</a>
          </div>


        </div>
      </div>


      <!--VISTA MODAL PARA VER DETALLE COMPRA EN VISTA MODAL-->
      <?php require_once("modal/detalle_Batida_modal.php"); ?>


      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-header">
              <h3 class="box-title"></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="lista_Batida_data" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Ver Detalle</th>
                    <th>Fecha Batida</th>
                    <th>Número Batida</th>
                    <th>Producto</th>
                    <th>Total</th>
                    <th>Estado</th>


                  </tr>
                </thead>

              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->




  <?php require_once("footer.php"); ?>

  <!--AJAX PROVEEDORES-->
  <script type="text/javascript" src="js/Batida.js"></script>


<?php

} else {

  header("Location:" . Conectar::ruta() . "vistas/index.php");
}

?>
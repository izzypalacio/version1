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
      <h1>
        Consultar Produccion Por Fecha

      </h1>

    </section>

    <!-- Main content -->
    <section class="content">

      <div id="resultados_ajax"></div>

      <div class="panel panel-default">

        <div class="panel-body">

          <form class="form-inline">


            <div class="form-group">
              <label for="staticEmail" class="col-sm-2 col-form-label">Fecha Inicial</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="datepicker" name="datepicker" placeholder="Fecha Inicial">
              </div>
            </div>

            <div class="form-group">
              <label for="inputPassword" class="col-sm-2 col-form-label">Fecha Final</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="datepicker2" name="datepicker2" placeholder="Fecha Final">
              </div>
            </div>



            <div class="btn-group text-center">
              <button type="button" class="btn btn-primary" id="btn_Batida_fecha"><i class="fa fa-search" aria-hidden="true"></i> Consultar</button>
            </div>
          </form>

        </div>
      </div>


      <!--VISTA MODAL PARA VER DETALLE COMPRA EN VISTA MODAL-->
      <?php require_once("modal/detalle_Batida_modal.php"); ?>


      <div class="row">
        <div class="col-xs-12">

          <div class="table-responsive">
            <div class="box-header">
              <h3 class="box-title">Lista produccion por fecha</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="Batida_fecha_data" class="table table-bordered table-striped">
                <thead>

                  <tr style="background-color:#A9D0F5">
                    <th>Ver Detalle</th>
                    <th>Fecha Batida</th>
                    <th>N??mero Batida</th>
                    <th>N??mero Formula</th>
                    <th>Producto</th>
                    <th>Categoria</th>
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
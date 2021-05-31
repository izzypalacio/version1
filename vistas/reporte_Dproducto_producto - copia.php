<?php



require_once("../config/conexion.php");

if (isset($_SESSION["id_usuario"])) {

  require_once("../modelos/producto.php");

  $pro = new producto();

  $producto = $pro->get_producto();


?>


  <!-- INICIO DEL HEADER - LIBRERIAS -->
  <?php require_once("header.php"); ?>

  <!-- FIN DEL HEADER - LIBRERIAS -->


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">


    <h2 class="reporte_Dproducto_general container-fluid bg-red text-white col-lg-12 text-center mh-50">

      REPORTE DE FORMULAS POR PRODUCTOS
    </h2>



    <div class="panel panel-default">

      <div class="panel-body">

        <div class="row  col-sm-5 col-sm-offset-3">

          <div class="">

            <form action="reporte_Dproducto_producto_pdf.php" method="post">


              <div class="form-group">
                <label for="staticEmail">Fecha Inicial</label>

                <input type="text" class="form-control" id="datepicker" name="datepicker" placeholder="Fecha Inicial">

              </div>

              <div class="form-group">
                <label for="inputPassword">Fecha Final</label>

                <input type="text" class="form-control" id="datepicker2" name="datepicker2" placeholder="Fecha Final">

              </div>


              <div class="form-group">

                <label for="inputPassword" class="col-sm-2 col-form-label">PRODUCTOS</label>

                <select name="categoria" class="form-control">

                  <option value="0">SELECCIONE</option>


                  <?php

                  for ($i = 0; $i < sizeof($producto); $i++) {

                  ?>

                    <option value="<?php echo $producto[$i]["categoria"] ?>"><?php echo $producto[$i]["producto
                         "] ?></option>

                  <?php


                  }


                  ?>



                </select>
              </div>

              <button type="submit" class="btn btn-primary">CONSULTAR</button>


            </form>

          </div>
        </div>

      </div>
    </div>




  </div>
  <!-- /.content-wrapper -->


  <?php require_once("footer.php"); ?>



<?php

} else {

  header("Location:" . Conectar::ruta() . "vistas/index.php");
}

?>
<?php

require_once("../modelos/conexion.php");

if (isset($_SESSION["id_usuario"])) {

  require_once("../modelos/Dproducto.php");

  $Dproducto = new Dproducto();

?>


  <!-- INICIO DEL HEADER - LIBRERIAS -->
  <?php require_once("header.php"); ?>

  <!-- FIN DEL HEADER - LIBRERIAS -->

  <?php if ($_SESSION["Dproducto"] == 1) {?>


 


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">


      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1 align="center">
          Actualizar Formulas

        </h1>

      </section>

      <!-- Main content -->
      <section class="content">

        <section class="formulario-Dproducto">

          <form class="form-horizontal" id="form_Dproducto">

            <!--FILA PROVEEDOR - COMPROBANTE DE PAGO-->
            <div class="row">


              <div class="col-lg-8">

                <div class="box">

                  <div class="box-body">

                    <div class="form-group">

                      <!--IMPORTANTE PONER EL ID de data-target="#modalProveedor" debe ser DIFERENTE AL DE ventas.php ya que eran iguales y ocurra un error, es importante que el id sea unico y diferente en todas las ventanas modales-->
                      <div class="col-lg-6 col-lg-offset-3">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalformula"><i class="fa fa-search" aria-hidden="true"></i>Buscar Formula</button>
                      </div>

                    </div>


                    <div class="form-group">
                      <label for="" class="col-lg-3 control-label">Número Formula</label>

                      <div class="col-lg-9">
                        <input type="text" class="form-control" id="numero_Dproducto" name="numero_Dproducto"   placeholder="Numero de Formula" readonly>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="" class="col-lg-3 control-label">Producto</label>

                      <div class="col-lg-9">
                        <input type="text" class="form-control" id="productoc" name="productoc" placeholder="producto" readonly>
                      </div>
                    </div>




                    <div class="form-group">
                      <label for="" class="col-lg-3 control-label">Categoria</label>

                      <div class="col-lg-9">
                        <input type="text" class="form-control" id="categoria" name="categoria" placeholder="categoria" readonly>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="" class="col-lg-3 control-label">Rendimiento</label>

                      <div class="col-lg-9">
                        <input type="text" class="form-control" id="rinde" name="rinde" placeholder="Rendimiento" readonly>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="" class="col-lg-3 control-label">CIF</label>

                      <div class="col-lg-9">
                        <input type="text" class="form-control" id="costo" name="costo" placeholder="costo" readonly>
                      </div>
                    </div>




                  </div>
                  <!-- /.box-body -->

                  <!--</form>-->
                </div>
                <!-- /.box -->

              </div>
              <!--fin col-lg-12-->


            </div>
            <!--fin row-->

            <!--FILA CATEGORIA - PRODUCTO-->
            <div class="row">

              <div class="col-sm-12">

                <div class="box">

                  <div class="box-body">

                    <div class="row">


                      <div class="col-lg-3">
                        <div class="col-lg-5 text-center">
                          <button type="button" id="#" class="btn btn-primary" data-toggle="modal" data-target="#lista_actualizarModal"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Costo de Fabricacion</button>
                        </div>
                      </div>



                    </div>
                    <!--fin row-->


                  </div>
                  <!-- /.box-body -->


                </div>
                <!-- /.box -->

              </div>
              <!--fin col-sm-6-->


            </div>
            <!--fin row-->


            <div class="container box">

              <div class="row">

                <div class="col-lg-12">

                  <div class="table-responsive">

                    <!--<div class="box">-->
                    <div class="box-header">
                      <h3 align="center">Lista de Costos de Fabricacion</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <table id="detalles" class="table table-striped">
                        <thead>
                          <tr class="bg-success">


                            <th class="all">Item</th>
                            <th class="all">Costo de Fabricacion</th>
                            <th class="all">Unidad de medida</th>
                            <th class="all">Precio</th>
                            
                            <th class="all">Cantidad</th>
                            <th class="min-desktop">subtotal</th>
                            <th class="min-desktop">Acciones</th>

                          </tr>
                        </thead>

                        <tbody id="listformula">

                        </tbody>


                      </table>
                    </div>
                    <!-- /.box-body -->

                  </div>
                  <!-- /.table responsive -->
                </div>
                <!-- /.col -->

              </div>
              <!-- /row -->
            </div>


            <!-- /container -->

            <!--TABLA SUBTOTAL - TOTAL -->

            <div class="row">
              <div class="col-xs-12">

                <div class="table-responsive">

                  <div class="box-body">
                    <table id="resultados_footer" class="table table-striped">

                      <tr class="">



                        <input type="hidden" name="grabar" value="si">
                        <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $_SESSION["id_usuario"]; ?>" />

                        <input type="hidden" name="id_producto" id="id_producto" />


                      </tr>
                      </tbody>


                    </table>

                    <div class="boton_registrar">
                      <button type="button" onClick="registrarformula()" class="btn btn-primary col-lg-offset-10 col-xs-offset-3" id="btn"><i class="fa fa-save" aria-hidden="true"></i> Registrar Formulas</button>

                    </div>

                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->


          </form>
          <!--formulario-pedido-->

        </section>
        <!--section formulario - pedido -->

      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!--FIN DE CONTENIDO-->

    <!--VISTA MODAL PARA AGREGAR PROVEEDOR-->
    <?php require_once("modal/lista_formula_modal.php"); ?>
    <?php require_once("modal/lista_actualizar_modal.php"); ?>
    <!--VISTA MODAL PARA AGREGAR PROVEEDOR-->




  <?php  } else {

    require("noacceso.php");
  }


  ?>
  <!--CIERRE DE SESSION DE PERMISO -->

  <?php require_once("footer.php"); ?>



  <!--AJAX PROVEEDORES-->
  <script type="text/javascript" src="js/formula.js"></script>
  

  <!--AJAX PRODUCTOS-->


<?php

} else {

  header("Location:" . Conectar::ruta() . "vistas/index.php");
}



?>
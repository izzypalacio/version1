  <?php

  require_once("../modelos/conexion.php");

  if (isset($_SESSION["id_usuario"])) {


  ?>



    <?php

    require_once("header.php");

    ?>


    <?php if ($_SESSION["Mprima"] == 1) {

    ?>


      <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">

          <div id="resultados_ajax"></div>

          <h2 align="center">Lista de Costos de Fabricacion</h2>

          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h1 class="box-title">
                    <button class="btn btn-primary btn-lg" id="add_button" onclick="limpiar()" data-toggle="modal" data-target="#MprimaModal"><i class="fa fa-plus" aria-hidden="true"></i>Agregar Costo de Fabricacion</button>
                  </h1>
                  <div class="box-tools pull-right">
                  </div>
                </div>
                <!-- /.box-header -->
                <!-- centro -->
                <div class="panel-body table-responsive">

                  <table id="Mprima_data" class="table table-bordered table-striped">

                    <thead>

                      <tr style="background-color:#A9D0F5">

                        <th>Costos de Fabricacion</th>
                        <th>Unidad de Medida</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Estado</th>
                        <th>Editar</th>
                        <th>Eliminar</th>



                      </tr>
                    </thead>

                    <tbody>


                    </tbody>


                  </table>

                </div>

                <!--Fin centro -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->
      <!--Fin-Contenido-->

      <!--FORMULARIO VENTANA MODAL-->
      <div id="MprimaModal" class="modal fade">
        <div class="modal-dialog">
          <form method="post" id="Mprima_form">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4>Agregar Costos de Fabricacion</h4>
              </div>
              <div class="modal-body">

                <label>Costos de fabricacion</label>
                <input type="text" name="materiales" id="materiales" class="form-control" placeholder="Costos" />
                <!-- <input type="text" name="categoria" id="categoria" class="form-control" placeholder="Categoria" required pattern="^[a-zA-Z_áéíóúñ]{0,150}$"/> -->
                <br />

                <label>Unidad de medida</label>
                <select class="form-control" id="unidadm" name="unidadm" required>
                  <option value="">-- Selecciona unidad de medida --</option>
                  <option value="0" selected>Bidon</option>
                  <option value="1">Bolsa</option>
                  <option value="2" selected>Tiempo</option>
                  <option value="3">Caja</option>
                  <option value="4" selected>Paquete</option>
                  <option value="5">Fardo</option>
                  <option value="6" selected>Galon</option>
                  <option value="7">Lata</option>
                  <option value="8" selected>Libra</option>
                  <option value="9">Litro</option>
                  <option value="10" selected>Saco</option>
                  <option value="11">Unidad</option>
                  <option value="12" selected>Termo</option>
                  <option value="13">Onza</option>
                  <option value="14" selected>Gramo</option>
                </select>

                <label>Precio</label>

                <select class="selectpicker form-control" id="moneda" name="moneda" required>
                  <option value="">-- Seleccione moneda --</option>
                  <option value="USD$">USD$</option>

                </select>
                <input type="float" name="precio" id="precio" class="form-control" placeholder="precio" />
                <!-- <input type="text" name="categoria" id="categoria" class="form-control" placeholder="Categoria" required pattern="^[a-zA-Z_áéíóúñ]{0,150}$"/> -->
                <br />

                <div class="form-group">
                  <label for="" class="col-lg-1 control-label">Stock</label>

                  <div class="col-lg-9 col-lg-offset-1">

                    <input type="text" class="form-control" id="stock" name="stock" disabled>

                  </div>
                </div>

                <label>Estado</label>
                <select class="form-control" id="estado" name="estado" required>
                  <option value="">-- Selecciona estado --</option>
                  <option value="1" selected>Activo</option>
                  <option value="0">Inactivo</option>
                </select>

              </div>
              <div class="modal-footer">
                <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $_SESSION["id_usuario"]; ?>" />

                <input type="hidden" name="id_Mprima" id="id_Mprima" />


                <button type="submit" name="action" id="btnGuardar" class="btn btn-success pull-left" value="Add"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>

                <button type="button" onclick="limpiar()" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Cerrar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <!--FIN FORMULARIO VENTANA MODAL-->



    <?php  } else {

      require("noacceso.php");
    }

    ?>
    <!--CIERRE DE SESSION DE PERMISO -->

    <?php

    require_once("footer.php");
    ?>

    <script type="text/javascript" src="js/Mprima.js"></script>



  <?php

  } else {

    header("Location:" . Conectar::ruta() . "index.php");
  }



  ?>
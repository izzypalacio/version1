  <?php

  require_once("../modelos/conexion.php");

  if (isset($_SESSION["id_usuario"])) {


  ?>



    <?php

    require_once("header.php");

    ?>


    <?php if ($_SESSION["Cfabricacion"] == 1) {

    ?>


      <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">

          <div id="resultados_ajax"></div>

          <h2 align="center">Lista de Servicios</h2>

          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h1 class="box-title">
                    <button class="btn btn-primary btn-lg" id="add_button" onclick="limpiar()" data-toggle="modal" data-target="#CfabricacionModal"><i class="fa fa-plus" aria-hidden="true"></i>Agregar Servicio</button>
                  </h1>
                  <div class="box-tools pull-right">
                  </div>
                </div>
                <!-- /.box-header -->
                <!-- centro -->
                <div class="panel-body table-responsive">

                  <table id="Cfabricacion_data" class="table table-bordered table-striped">

                    <thead>

                      <tr style="background-color:#A9D0F5">

                        <th>servicios</th>
                        <th>Unidad de medida</th>
                        <th>tiempo</th>
                        <th>porcentaje</th>
                        <th>costos</th>
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
      <div id="CfabricacionModal" class="modal fade">
        <div class="modal-dialog">
          <form method="post" id="Cfabricacion_form">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Agregar Costos de fabricacion</h4>
              </div>
              <div class="modal-body">

                <label>Servicios</label>
                <input type="text" name="servicios" id="servicios" class="form-control" placeholder="servicios" required pattern="^[a-zA-Z_áéíóúñ\s]{0,150}$" />
                <!-- <input type="text" name="categoria" id="categoria" class="form-control" placeholder="Categoria" required pattern="^[a-zA-Z_áéíóúñ]{0,150}$"/> -->
                <br />

                <label>Unidad de medida</label>
                <select class="form-control" id="unidadm" name="unidadm" required>
                  <option value="">-- Selecciona estado --</option>
                  <option value="1" selected>Tiempo</option>
                  <option value="0" selected>Porcentaje</option>
                </select>

                <label>Tiempo</label>
                <input type="time" name="tiempo" id="tiempo" class="form-control" placeholder="tiempo" />

                <label>Porcentaje</label>
                <input type="float" name="porcentaje" id="porcentaje" class="form-control" placeholder="porcentaje" />

                <label>Costos</label>
                <input type="float" name="costos" id="costos" class="form-control" placeholder="costos" />
                <!-- <input type="text" name="categoria" id="categoria" class="form-control" placeholder="Categoria" required pattern="^[a-zA-Z_áéíóúñ]{0,150}$"/> -->


                <br />


                <label>Estado</label>
                <select class="form-control" id="estado" name="estado" required>
                  <option value="">-- Selecciona estado --</option>
                  <option value="1" selected>Activo</option>
                  <option value="0">Inactivo</option>
                </select>

              </div>
              <div class="modal-footer">
                <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $_SESSION["id_usuario"]; ?>" />

                <input type="hidden" name="id_Cfabricacion" id="id_Cfabricacion" />


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

    <script type="text/javascript" src="js/Cfabricacion.js"></script>



  <?php

  } else {

    header("Location:" . Conectar::ruta() . "index.php");
  }



  ?>
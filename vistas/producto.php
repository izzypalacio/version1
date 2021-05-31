  <?php

  require_once("../modelos/conexion.php");

  if (isset($_SESSION["id_usuario"])) {

    require_once("../modelos/Categorias.php");
    require_once("../modelos/cif.php");

    $categorias = new Categoria();

    $cat = $categorias->get_categorias();

    $cif = new cif();

    $ciff = $cif->get_cif();


  ?>



    <?php

    require_once("header.php");

    ?>


    <?php if ($_SESSION["producto"] == 1) {

    ?>


      <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">

          <div id="resultados_ajax"></div>

          <h2 align="center">Listado de Productos</h2>

          <div class="row">
            <div class="col-md-12">
              <div class="box">
                <div class="box-header with-border">
                  <h1 class="box-title">
                    <button class="btn btn-primary btn-lg" id="add_button" onclick="limpiar()" data-toggle="modal" data-target="#productoModal"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo Producto</button>
                  </h1>
                  <div class="box-tools pull-right">
                  </div>
                </div>
                <!-- /.box-header -->
                <!-- centro -->
                <div class="panel-body table-responsive">

                  <table id="producto_data" class="table table-bordered table-striped">

                    <thead>

                      <tr style="background-color:#A9D0F5">

                        <th width="8%">producto</th>
                        <th width="8%">Rendimiento</th>
                        <th width="5%">categoria</th>
                        <th width="5%">costos</th>
                        <th width="5%">
                          Fecha</th>
                        <th width="10%">Estado</th>
                        <th width="5%">Editar</th>
                        <th width="5%">Eliminar</th>



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
      <div id="productoModal" class="modal fade">
        <div class="modal-dialog">
          <form method="post" id="producto_form">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Agregar producto</h4>
              </div>
              <div class="modal-body">

                <label>Producto</label>
                <input type="text" name="productoc" id="productoc" class="form-control" placeholder="Producto" />
                <label>Rendimiento</label>
                <input type="text" name="rinde" id="rinde" class="form-control" placeholder="Rendimiento" />
                <!-- <input type="text" name="categoria" id="categoria" class="form-control" placeholder="Categoria" required pattern="^[a-zA-Z_áéíóúñ]{0,150}$"/> -->
                <br />

                <label>Categoría</label>
                <select class="form-control" name="categoria" id="categoria">

                  <option value="0">Seleccione</option>

                  <?php

                  for ($i = 0; $i < sizeof($cat); $i++) {

                  ?>
                    <option value="<?php echo $cat[$i]["id_categoria"] ?>"><?php echo $cat[$i]["categoria"]; ?></option>
                  <?php
                  }
                  ?>

                </select>

                <label>CIF</label>
                <select class="form-control" name="planta" id="planta">

                  <option value="0">Seleccione</option>

                  <?php

                  for ($i = 0; $i < sizeof($ciff); $i++) {

                  ?>
                    <option value="<?php echo $ciff[$i]["id_cif"] ?>"><?php echo $ciff[$i]["planta"]; ?></option>
                  <?php
                  }
                  ?>

                </select>


                <label>Estado</label>
                <select class="form-control" id="estado" name="estado" required>
                  <option value="">-- Selecciona estado --</option>
                  <option value="1" selected>Activo</option>
                  <option value="0">Inactivo</option>
                </select>

              </div>
              <div class="modal-footer">
                <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $_SESSION["id_usuario"]; ?>" />

                <input type="hidden" name="id_producto" id="id_producto" />


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

    <script type="text/javascript" src="js/producto.js"></script>



  <?php

  } else {

    header("Location:" . Conectar::ruta() . "index.php");
  }



  ?>
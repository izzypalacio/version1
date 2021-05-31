<?php

require_once("../modelos/conexion.php");

if (isset($_SESSION["id_usuario"])) {

  require_once("../modelos/Batida.php");

  require_once("../modelos/Dproducto.php");

  $Dproducto = new Dproducto();

  $Dpro = $Dproducto->get_Dproducto();

  $Batida = new Batida();

?>

  <?php require_once("header.php"); ?>

  <?php if ($_SESSION["Batida"] == 1) {

  ?>

    <div class="content-wrapper">
      <section class="content-header">
        <h1 align="center">
          Produccion
        </h1>
      </section>

      <section class="content">
        <section class="formulario-Batida">
          <form class="form-horizontal" id="form_Batida">
            <div class="row">
              <div class="col-lg-12">
                <div class="box">
                  <div class="box-body">
                    <div class="form-group">
                      <br>
                      <br>
                      <div class="col-lg-9">
                        <label for="" class="col-lg-3 control-label">Número Batida</label>
                        <input type="text" id="numero_Batida" name="numero_Batida" value="<?php $codigo = $Batida->numero_Batida(); ?>" readonly>
                        <br>
                      </div>
                      <br>
                      <br>
                      <br>

                      <div class="col-lg-3">
                        <div class="col-lg-6 col-lg-offset-3">
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalDproducto"><i class="fa fa-search" aria-hidden="true"></i> Agregar formula</button>
                        </div>

                      </div>
                    </div>

                  </div>

                </div>


              </div>

            </div>

            <div class="container box">

              <div class="row">

                <div class="col-lg-12">

                  <div class="table-responsive">

                    <div class="box-header">
                      <h3 class="text-center mt-4">Lista de Costos de Fabricacion</h3>
                    </div>

                    <div class="box-body">
                      <table id="detalles" class="table table-striped">
                        <thead>
                          <tr class="bg-success">
                            <th class="all">Item</th>
                            <th class="all">Costo de Fabricacion</th>
                            <th class="all">Unidad de medida</th>
                            <th class="all">Precio Unidad</th>
                            <th class="all">Cantidad</th>
                            <th class="min-desktop">subtotal</th>
                          </tr>
                        </thead>
                        <tbody id="listMpriBatida">
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            </tbody>
            <div class="row">
              <div class="col-xs-12">

                <div class="box">

                  <div class="box-body">
                    <table class="table table-striped">
                      <thead>
                        <tr class="bg-success">
                          <th class="col-lg-4"></th>
                          <th class="col-lg-4"></th>
                          <th class="col-lg-4">SUBTOTAL</th>
                          <th class="col-lg-4">TOTAL</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr class="bg-gray">
                          <td class="col-lg-4">
                            <h4 class="valor_moneda"></h4><input type="text" name="subtotal" id="subtotal" disabled class="totales">
                          </td>
                          <td class="col-lg-4">
                            <h4 class="valor_moneda"></h4><input type="text" name="iva" id="iva" disabled class="totales">
                          </td>
                          <td class="col-lg-4">
                            <h4 class="valor_moneda"></h4><input type="text" name="percepcion" id="percepcion" disabled class="totales">
                          </td>
                          <td class="col-lg-4">
                            <h4 class="valor_moneda"></h4><input type="text" name="total" id="total" disabled class="totales">
                          </td>
                        </tr>
                        <tr>
                          <input type="hidden" name="grabar" value="si">
                          <input type="hidden" name="id_usuario" id="id_usuario" value="<?php echo $_SESSION["id_usuario"]; ?>" />
                          <input type="hidden" name="id_producto" id="id_producto" />
                        </tr>
                      </tbody>
                    </table>
                    </table>
                    <div class="boton_registrar">
                      <button type="button" onClick="registrarBatida()" class="btn btn-primary col-lg-offset-10 col-xs-offset-3" id="btn"><i class="fa fa-save" aria-hidden="true"></i> Registrar Batidas</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </form>

        </section>

      </section>
    </div>

    <?php require_once("modal/lista_Dproducto_modal.php"); ?>

  <?php  } else {

    require("noacceso.php");
  }

  ?>
  <?php require_once("footer.php"); ?>


  <script type="text/javascript" src="js/Dproducto.js"></script>

<?php

} else {

  header("Location:" . Conectar::ruta() . "vistas/index.php");
}

?>
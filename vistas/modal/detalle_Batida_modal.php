


   <div class="modal fade" id="detalle_Batida">
          <div class="modal-dialog tamanoModal">
           <!--antes tenia un class="modal-content" y lo cambié por bg-warning para que tuviera fondo blanco, deberia haber sido un color naranja claro pero me salió un color blanco de casualidad--> 
            <div class="bg-warning">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-user-circle" aria-hidden="true"></i> DETALLE DE PRODUCCION</h4>
              </div>
              <div class="modal-body">

                 <div class="container box">
        
        <!--column-12 -->
        <div class="table-responsive">
         
             <div class="box-body">

               
                        <table id="detalle_Batida" class="table table-striped table-bordered table-condensed table-hover">

                          <thead style="background-color:#A9D0F5">
                            <tr>
                              <th>PRODUCTO</th>
                              <th>NUMERO BATIDA</th>
                              <th>NUMERO FORMULA</th>
                              <th>CATEGORIA</th>
                              
                              <th>FECHA FORMULA</th>
                            </tr>
                          </thead>

                          <tbody>
                            
                            <td><h4 id="productoc"></h4><input type="hidden" name="productoc" id="productoc"></td>

                            <td><h4 id="numero_Batida"></h4><input type="hidden" name="numero_Batida" id="numero_Batida"></td>

                            <td><h4 id="numero_Dproducto"></h4><input type="hidden" name="numero_Dproducto" id="numero_Dproducto"></td>

                            <td><h4 id="categoria"></h4><input type="hidden" name="categoria" id="categoria"></td>
                            
                            

                            <td><h4 id="fecha_Batida"></h4><input type="hidden" name="fecha_Batida" id="fecha_Batida"></td>

                          </tbody>

                        </table>


                          <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                            <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                              <thead style="background-color:#A9D0F5">
                                    <th>Cantidad</th>
                                    <th>Materia Prima</th>
                                    <th>Unidad de medida</th>
                                    <th>Subtotal</th>
                                    <th>Total</th>
                                </thead>
                              
                                           
                            </table>
                          </div>

                         
            </div>
            <!-- /.box-body -->

              <!--BOTON CERRAR DE LA VENTANA MODAL-->
             <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Cerrar</button>
                
              </div>
              <!--modal-footer-->
          <!--</div>-->
          <!-- /.box -->

        </div>
        <!--/.col (12) -->
      </div>
      <!-- /.row -->
       
     
              </div>
              <!--modal body-->
              </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

     

    

        
  


   <div class="modal fade" id="modalproducto">
          <div class="modal-dialog ">
           <!--antes tenia un class="modal-content" y lo cambié por bg-warning para que tuviera fondo blanco, deberia haber sido un color naranja claro pero me salió un color blanco de casualidad--> 
            <div class="bg-warning">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-user-circle" aria-hidden="true"></i> Producto</h4>
              </div>
              
              <div class="modal-body">


                 <div class="container box">
        
        <!--column-12 -->
        <div class="">
       
       <!--IMPORTANTE: no poner la clase table responsive sino no se muestra el boton del data table en responsive-->
        <div class="table-responsive">
             
             
             <table id="lista_producto_data" class="table table-bordered table-striped">
               
                <thead>
                  <tr>
                  <!--pongo la clase all para que se vea en cualquier tamaño-->
                    <th class="all" width="50%">PRODUCTO</th>
                    <th class="all" width="20%">RENDIMIENTO</th>
                    <th class="all" width="20%">CATEGORIA</th>
                    <th class="all" width="20%">CIF</th>


                    <!--<th>Dirección</th>-->
                    <th class="not-mobile desktop tablet-p tablet-l" width="10%">FECHA</th>
                 
                    
                    <!--con esas clases el boton se esconde en mobile-->

                    <th class="not-mobile desktop tablet-p tablet-l" width="10%">ESTADO</th>

                 

                    <th class="not-mobile desktop tablet-p tablet-l" width="10%">ACCION</th>
                   
                  
                  </tr>
                </thead>

               
              </table>
           <!-- </div>-->
            <!-- /.box-body -->

              <!--BOTON CERRAR DE LA VENTANA MODAL-->
             <div class="modal-footer">
                <button type="button" class="btn btn-danger pull-right" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i> Cerrar</button>
                
              </div>
              <!--modal-footer-->
          <!--</div>-->
          <!-- /.box -->

        </div><!--table responsive-->

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

       
 
        
  

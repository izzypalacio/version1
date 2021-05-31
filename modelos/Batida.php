<?php


  
     //conexion a la base de datos
     require_once("../modelos/conexion.php");

   
      class Batida extends Conectar{


             public function get_filas_Batida(){

             $conectar= parent::conexion();
           
             $sql="select * from Batida";
             
             $sql=$conectar->prepare($sql);

             $sql->execute();

             $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

             return $sql->rowCount();
        
        }


      	     public function get_Batida(){

             $conectar= parent::conexion();
           
             $sql="select * from Batida";
             
             $sql=$conectar->prepare($sql);

             $sql->execute();

             return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);
        
        }

        public function get_Batida_por_id($id_Batida){

             $conectar= parent::conexion();

           
             $sql="select * from Batida where id_Batida=?";
             
             $sql=$conectar->prepare($sql);
             $sql->bindValue(1,$id_Batida);
             $sql->execute();

             return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

    
    }

             
            public function numero_Batida(){

		    $conectar=parent::conexion();
		    parent::set_names();

		 
		    $sql="select numero_Batida from detalle_Batida;";

		    $sql=$conectar->prepare($sql);

		    $sql->execute();
		    $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

		       //aqui selecciono solo un campo del array y lo recorro que es el campo numero_compra
		       foreach($resultado as $k=>$v){

		                 $numero_Batida["numero"]=$v["numero_Batida"];
		                 
		             }
		          //luego despues de tener seleccionado el numero_compra digo que si el campo numero_compra està vacio entonces se le asigna un F000001 de lo contrario ira sumando

		        

		                   if(empty($numero_Batida["numero"]))
		                {
		                  echo 'B00001';
		                }else
		          
		                  {
		                    $num     = substr($numero_Batida["numero"] , 1);
		                    $dig     = $num + 1;
		                    $fact = str_pad($dig, 5, "0", STR_PAD_LEFT);
		                    echo 'B'.$fact;
		                    
		                  } 

		  }



		   /*metodo para agregar la compra */
  	  public function agrega_detalle_Batida(){

       
	//echo json_encode($_POST['arrayCompra']);
	$str = '';
	$detalles = array();
	$detalles = json_decode($_POST['arrayBatida']);

	

	/*IMPORTANTE:Esas variables NO las puedes usar fuera del foreach
Por que se crean dentro. con cada producto para el INSERT, 

hay dos formas de hacer esto:
1,. Es la más fácil, que es dentro del bucle 
2..- La más difícil, que es fuera del bucle
Cuando es dentro, lo que vas a hacer es un insert por cada producto
Imagina que son 10 productos los que seleccionaste, entonces dentro del bucle , tendrías 1 insert por esos 10, es decir en total harías 10 inserts
Por que le envías producto por producto
En cambio cuando es fuera del bucle, haces 1 solo insert pero le envías TODO los 10 productos.

-con las variables del proveedor no hay problema, las puedes usar directo
Si no estan en el arreglo, las puedes usar directo, se haria $proveedor = $_POST["debe ir el nombre que le has asignado en el ajax"], Y luego en la consulta INSERT pones la variable que has creado $proveedor 

- cuando armo un insert lo hago en el mismo orden que he creado las columnas de la tabla de la bd


- en esas variables ($cantidad, $codProd, $producto etc) ya están la información de cada producto seleccionado en el formulario


- //IMPORTANTE SOBRE IMPRIMIR EL SQL PARTE 1:hay que considerar que esta prueba lo hice sin haber creado la funcion agrega_detalle_compra(), se hizo desde registrar_compra.php, pero tambien se puede hacer desde comprasModulo.php y funciona igual, ya se hizo la prueba
 

         */
   
	 $conectar=parent::conexion();


	foreach ($detalles as $k => $v) {
	
		//IMPORTANTE:estas variables son del array detalles
  
		$cantidad = $v->cantidad;
		$codDpro = $v->codDpro;
		$materiales = $v->materiales;
    $unidadm = $v->unidadm;
		$moneda = $v->moneda;
		$precio = $v->precio; 
		$importe = $v->importe;
		//$total = $v->total;
		$estado = $v->estado;

    $Nbatida = $v->Nbatida;
    
    $rinde = $v->rinde;
    $costo = $v->costo;
    $numero_Dproducto = $v->numero_Dproducto;

    $productoc = $v->productoc;
    $categoria = $v->categoria;
    $cod = $v->cod;
    $codDD = $v->codDD;

		//echo "***************";
		//echo "Cant: ".$cantidad." codProd: ".$codProd. " Producto: ". $producto. " moneda: ".$moneda. " precio: ".$precio. " descuento: ".$dscto. " estado: ".$estado;

		   
       
       $numero_Batida = $_POST["numero_Batida"];
       
       $margenu = $_POST["margenu"];
		   $total = $_POST["total"];
       $margenreal = $_POST["margenreal"];
       $totalpro = $_POST["totalpro"];
       $preciou = $_POST["preciou"];
       $preciout = $_POST["preciout"];
       $id_usuario = $_POST["id_usuario"];
       

		   /*IMPORTANTE: no me imprimia porque tenia estas variables que no usaba*/

		   //$subtotal_compra = $_POST["subtotal_compra"];
		   //$total_compra = $_POST["total_compra"];

        
       

        /*$sql="insert into detalle_compra
        values(null,'".$numero_compra."','".$producto."','".$precio."','".$cantidad."','".$dscto."','".$dui_proveedor."','".$fecha_compra."','".$estado."');";

        echo $sql;*/

         //fecha 

          //$fecha_compra= date("d/m/Y");

         //estado 
           //si estado es igual a 1 entonces la compra esta pagada
         //$estado = 1;

        

        $sql7="insert into detalle_Batida
        values(null,?,?,?,?,?,?,?,?,?,?,?,now(),?,?,?,?,?);";


        $sql7=$conectar->prepare($sql7);

        //echo $sql;

        /*importante:se ingresó el id_producto=$codProd ya que se necesita para relacionar las tablas compras con detalle_compras para cuando se vaya a hacer la consulta de la existencia del producto y del stock para cuando se elimine un detalle compra y se reintegre la cantidad de producto*/

        $sql7->bindValue(1,$numero_Batida);
        $sql7->bindValue(2,$numero_Dproducto);
        $sql7->bindValue(3,$productoc);
        $sql7->bindValue(4,$codDpro);  //es materia prima
        $sql7->bindValue(5,$materiales);
        $sql7->bindValue(6,$unidadm);
        $sql7->bindValue(7,$moneda);
        $sql7->bindValue(8,$precio);
        $sql7->bindValue(9,$Nbatida);
        $sql7->bindValue(10,$cantidad);
        $sql7->bindValue(11,$importe);
        $sql7->bindValue(12,$id_usuario);
        $sql7->bindValue(13,$id_producto);
        $sql7->bindValue(14,$cod);
        $sql7->bindValue(15,$codDD);
        $sql7->bindValue(16,$estado);
       
        $sql7->execute();

        //print_r($_POST);
         
         /*IMPORTANTE:esta linea $resultado=$sql->fetch(PDO::ASSOC); debe comentarse sino se insertaria una sola fila

         Esta linea "$resultado=$sql->fetch(PDO::ASSOC);" se utliza cuando la consulta devuelva algún valor(osea si quieres imprimir un campo de la tabla de la bd) Pero la sentencia insert no deuelve nada
         Y esperar que devuelva despues del insert es un error en el codigo por eso es que solo ejecuta 1 producto y no el resto, por lo tanto se comenta dicha linea  */

        //$resultado=$sql->fetch(PDO::ASSOC);


          /*$sql2="insert into compras 
           values(null,'".$fecha_compra."','".$numero_compra."','".$proveedor."','".$dui_proveedor."','".$total."');";*/
      

          //si existe el producto entonces actualiza la cantidad, en caso contrario no lo inserta


             $sql3="select * from Mprima where id_Mprima=?;";

             //echo $sql3;
             
             $sql3=$conectar->prepare($sql3);

             $sql3->bindValue(1,$codDpro);
             $sql3->execute();

             $resultado = $sql3->fetchAll(PDO::FETCH_ASSOC);

                  foreach($resultado as $b=>$row){

                  	$re["existencia"] = $row["stock"];

                  }

                //la cantidad total es la suma de la cantidad más la cantidad actual
                $cantidad_total = $cantidad + $row["stock"];

             
               //si existe el producto entonces actualiza el stock en producto
              
               if(is_array($resultado)==true and count($resultado)>0) {
                     
                  //actualiza el stock en la tabla producto

             	   $sql4 = "update Mprima set 
                      
                      stock=?
                      where 
                      id_Mprima=?
             	   ";


             	  $sql4 = $conectar->prepare($sql4);
             	  $sql4->bindValue(1,$cantidad_total);
             	  $sql4->bindValue(2,$codDpro);
             	  $sql4->execute();

               } //cierre la condicional


	     }//cierre del foreach

	     /*IMPORTANTE: hice el procedimiento de imprimir la consulta y me di cuenta a traves del mensaje alerta que la variable total no estaba definida y tube que agregarla en el arreglo y funcionó*/


	     //SUMO EL TOTAL DE IMPORTE SEGUN EL CODIGO DE DETALLES DE COMPRA

         $sql5="select sum(importe) as total from detalle_Batida where numero_Batida=?";
      
         $sql5=$conectar->prepare($sql5);

         $sql5->bindValue(1,$numero_Batida);

         $sql5->execute();

         $resultado2 = $sql5->fetchAll();

             foreach($resultado2 as $c=>$d){

                $row["total"]=$d["total"];
                $row["margenreal"]=$q["margenreal"];
                $row["totalpro"]=$w["totalpro"];
                $row["preciou"]=$e["preciou"];
                $row["preciout"]=$r["preciout"];
               
             }

             $subtotal=$d["total"];

             $total=$q["margenreal"];
             $totalw=$w["totalpro"];
             $totale=$e["preciou"];
             $totalet=$r["preciout"];
             

              //REALIZO EL CALCULO A REGISTRAR
	
		     // $iva= 13/100;
		      //$total_iv=$subtotal*$iva;
		      //$total_iva=round($total_iv);
		      //$tot=$subtotal+$total_iva;
		      //$total=round($tot);

		      //$total_iva=round($total_iv);
		      $tot=$subtotal+$costo;
		      $total=$tot;

          $margen=$total*$margenu;
          $margenreal=$margen;

          $totalp=$total+$margenreal;
          $totalpro=$totalp;


         

          $totalet=$totalpro/$rinde*0.13;
          $preciou=$totalet;

          $totale=$totalpro/$rinde+$preciou;
          $preciout=$totale;

          $iva= 13/100;
          $total_iv=$preciout*$iva;
          $total_iva=$total_iv;





//*****************************************//

        //IMPORTANTE: hay que sacar la consulta INSERT INTO COMPRAS fuera del foreach sino se repetiria el registro en la tabla compras

	      //fecha 

       
          //estado 
           //si estado es igual a 1 entonces la compra esta pagada
			//$estado = 1;

	    
		   //la fecha no se puede formatear por es un objeto date, solo se formatea en el select, cuando se va a obtener una fecha, por lo tanto la fecha queda en el formato y/m/d en la tabla de la bd	

           $sql2="insert into Batida 
           values(null,now(),?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";


           $sql2=$conectar->prepare($sql2);
           
      
          
           $sql2->bindValue(1,$numero_Batida);
           $sql2->bindValue(2,$numero_Dproducto);
           $sql2->bindValue(3,$productoc);
           $sql2->bindValue(4,$rinde);
           $sql2->bindValue(5,$costo);
           $sql2->bindValue(6,$margenu);
           $sql2->bindValue(7,$margenreal);
           $sql2->bindValue(8,$totalpro);
           $sql2->bindValue(9,$preciou);
           $sql2->bindValue(10,$preciout);
           $sql2->bindValue(11,$categoria);
           $sql2->bindValue(12,$moneda);
           $sql2->bindValue(13,$subtotal);
           $sql2->bindValue(14,$total);
           $sql2->bindValue(15,$estado);
           $sql2->bindValue(16,$id_producto);
           $sql2->bindValue(17,$codDD);
           $sql2->bindValue(18,$id_usuario);
          
           $sql2->execute();



  	  }

  	   //metodo para ver el detalle del proveedor en una compra en esta parte agrege sin saber la categoria
       public function get_detalle_Dproducto($numero_Batida){

          $conectar=parent::conexion();
           parent::set_names();

          $sql="select c.fecha_Batida,c.numero_Batida,c.numero_Dproducto, c.productoc,c.categoria,c.total,p.id_producto,p.productoc,p.id_categoria,p.estado
          from Batida as c, producto as p
          where 
          
          c.productoc=p.productoc
          and
          c.numero_Batida=?
          
          ;";

          //echo $sql; exit();

          $sql=$conectar->prepare($sql);
              

          $sql->bindValue(1,$numero_Batida);
          $sql->execute();
          return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

       
            
       }



       public function get_detalle_Batida_Dproducto($numero_Batida){

       $conectar=parent::conexion();
           parent::set_names();

          $sql="select d.numero_Batida,d.materiales,d.unidadm, d.moneda, d.precio,d.Nbatida,d.cantidad,d.importe, d.fecha_Batida,c.numero_Batida,c.rinde,c.costo, c.moneda, c.subtotal,c.total,c.margenu,c.margenreal,c.totalpro,c.preciout
          from detalle_Batida as d, Batida as c
          where 
          
          d.numero_Batida
          =c.numero_Batida
          
          and
          
          d.numero_Batida=?
          
          ;";

          //echo $sql; exit();

          $sql=$conectar->prepare($sql);
              

              $sql->bindValue(1,$numero_Batida);
          $sql->execute();
          $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

       
              $html= "

              <thead style='background-color:#A9D0F5'>

                                    <th>Batidas</th>
                                    <th>Costo de Fabricacion</th>
                                    <th>Unidad de Medida</th>
                                    <th>Cantidad</th>
                                    <th>Precio unidad</th>
                                    <th>Importe</th>
                                   
                                </thead>


                              ";

           

              foreach($resultado as $row)
        {


          $unidad = '';
          
         

        $uni = "btn btn-success btn-md unidadm";
        if($row["unidadm"] == 0){
          $unidadm = 'Bidon';
          $uni = "btn btn-success btn-md unidadm";
        }
        
        $uni = "btn btn-success btn-md unidadm";
        if($row["unidadm"] == 1){
          $unidadm = 'Bolsa';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if($row["unidadm"] == 2){
          $unidadm = 'Tiempo';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if($row["unidadm"] == 3){
          $unidadm = 'Caja';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if($row["unidadm"] == 4){
          $unidadm = 'Paquete';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if($row["unidadm"] == 5){
          $unidadm = 'Fardo';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if($row["unidadm"] == 6){
          $unidadm = 'Galon';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if($row["unidadm"] == 7){
          $unidadm = 'Lata';
          $uni = "btn btn-success btn-md unidadm";
        }
         $uni = "btn btn-success btn-md unidadm";
        if($row["unidadm"] == 8){
          $unidadm = 'Libra';
          $uni = "btn btn-success btn-md unidadm";
        }
        
        $uni = "btn btn-success btn-md unidadm";
        if($row["unidadm"] == 9){
          $unidadm = 'Litro';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if($row["unidadm"] == 10){
          $unidadm = 'Saco';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if($row["unidadm"] == 11){
          $unidadm = 'unidad';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if($row["unidadm"] == 12){
          $unidadm = 'Termo';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if($row["unidadm"] == 13){
          $unidadm = 'Onza';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if($row["unidadm"] == 14){
          $unidadm = 'Gramo';
          $uni = "btn btn-success btn-md unidadm";
        }

         
        $html.="<tr class='filas'><td>".$row['Nbatida']."</td><td>".$row['materiales']."</td> <td>".$unidadm."</td><td>".$row['cantidad']."</td><td>".$row["moneda"]." ".$row['precio']."</td> <td>".$row["moneda"]." ".$row['importe']."</td></tr>";
                   
                   $rinde= $row["rinde"];
                   $margenu= $row["margenu"]*100;
                   $costo= $row["moneda"]." " .$row["costo"];
                   $subtotal= $row["moneda"]." ".$row["subtotal"];
                   $total= $row["moneda"]." ".$row["total"];
                   $margenreal= $row["moneda"]." ".$row["margenreal"];

                   $totalpro= $row["moneda"]." ".$row["totalpro"];
                   $preciout= $row["moneda"]." ".$row["preciout"];
        }

         $html .= "<tfoot>
                                    <th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>
                                    <br>

                                    <p>UNIDADES (BOLSA)</p>
                                    <p>MARGEN DE UTILIDAD</p>
                                    <br>
                                    <br>
                                     <p>CIF</p>
                                     <p>TOTAL FORMULA</p>
                                    
                                     <p class='total'>SUB TOTAL</p>
                                     <p class='margen_total'>MARGEN DE UTILIDAD</p>
                                     <p class='total'>TOTAL</p>
                                     <p class='total'>PRECIO CON IVA</p>
                                     
                                    </th>
                                    <th>
                                    <br>

                                    <p><strong>".$rinde."</strong></p>
                                    <p><strong>".$margenu."%</strong></p>
                                    <br>
                                    <br>

                                    <p><strong>".$costo."</strong></p>

                                    <p><strong>".$subtotal."</strong></p>

                                     <p><strong>".$total."</strong></p>

                                     <p><strong>".$margenreal."</strong></p>
                                     <p><strong>".$totalpro."</strong></p>

                                     <p><strong>".$preciout."</strong></p>

                                    </th> 

                                    <tr>
                            
                        </tr> 
                                </tfoot>";
      
      echo $html;

       }


         /*cambiar estado de la compra, solo se cambia si se quiere eliminar una compra y se revertería la cantidad de compra al stock*/

    public function cambiar_estado($id_Batida, $numero_Batida, $est){

      $conectar=parent::conexion();
      parent::set_names();
            
            //si estado es igual a 0 entonces lo cambia a 1
      $estado = 0;
      //el parametro est se envia por via ajax, viene del $est:est
      /*si el estado es ==0 cambiaria a PAGADO Y SE EJECUTARIA TODO LO QUE ESTA ABAJO*/
    if($_POST["est"] == 0){
        $estado = 1;
      

      //declaro $numero_compra, viene via ajax

      $numero_Batida=$_POST["numero_Batida"];


      $sql="update Batida set 
            
            estado=?
            where 
            id_Batida=?
           
              ";

            // echo $sql; 

            $sql=$conectar->prepare($sql);

            $sql->bindValue(1,$estado);
            $sql->bindValue(2,$_POST["id_Batida"]);
            $sql->execute();

            $resultado= $sql->fetch(PDO::FETCH_ASSOC);


      $sql_detalle= "update detalle_Batida set

          estado=?
          where 
          numero_Batida=?
          ";

            $sql_detalle=$conectar->prepare($sql_detalle);

            $sql_detalle->bindValue(1,$estado);
            $sql_detalle->bindValue(2,$numero_Batida);
            $sql_detalle->execute();

            $resultado= $sql_detalle->fetch(PDO::FETCH_ASSOC);


            /*una vez se cambie de estado a ACTIVO entonces actualizamos la cantidad de stock en productos*/


            //INICIO LA CAAAAAAAANTIDAD ESTA DETALLADA ACA

          $sql2="select * from detalle_Batida where numero_Batida=?";

          $sql2=$conectar->prepare($sql2);

         
            $sql2->bindValue(1,$numero_Batida);
            $sql2->execute();

            $resultado=$sql2->fetchAll();

              foreach($resultado as $row){

                 $id_Mprima=$output["id_Mprima"]=$row["id_Mprima"];
                //selecciona la cantidad comprada
                $cantidad=$output["cantidad"]=$row["cantidad"];



                
                 //si el id_producto existe entonces que consulte si la cantidad de productos existe en la tabla producto

                  if(isset($id_Mprima)==true and count($id_Mprima)>0){
                      
                      $sql3="select * from Mprima where id_Mprima=?";

                      $sql3=$conectar->prepare($sql3);

                      $sql3->bindValue(1, $id_Mprima);
                      $sql3->execute();

                      $resultado=$sql3->fetchAll();

                         foreach($resultado as $row2){
                           
                           //este es la cantidad de stock para cada producto
                           $stock=$output2["stock"]=$row2["stock"];
                           
                           //esta debe estar dentro del foreach para que recorra el $stock de los productos, ya que es mas de un producto que está asociado a la compra
                           //cuando das click a estado pasa a PAGADO Y SUMA la cantidad de stock con la cantidad de compra
                           $cantidad_actual= $stock + $cantidad;

                         }
                  }

               
                //LE ACTUALIZO LA CANTIDAD DEL PRODUCTO 

               $sql6="update Mprima set 
               stock=?
               where

               id_Mprima=?

               ";
               
               $sql6=$conectar->prepare($sql6);   
               
               $sql6->bindValue(1,$cantidad_actual);
               $sql6->bindValue(2,$id_Mprima);

               $sql6->execute();


              }//cierre del foreach

          }//cierre del if del estado

          else {

              /*si el estado es igual a 1, entonces pasaria a ANULADO y restaria la cantidad de productos al stock*/

              if($_POST["est"] == 1){
              $estado = 0;

      //declaro $numero_compra, viene via ajax

      $numero_Batida=$_POST["numero_Batida"];


      $sql="update Batida set 
            
            estado=?
            where 
            id_Batida=?
           
              ";

            // echo $sql; 

            $sql=$conectar->prepare($sql);

            $sql->bindValue(1,$estado);
            $sql->bindValue(2,$_POST["id_Batida"]);
            $sql->execute();

            $resultado= $sql->fetch(PDO::FETCH_ASSOC);


      $sql_detalle= "update detalle_Batida set

          estado=?
          where 
          numero_Batida=?
          ";

            $sql_detalle=$conectar->prepare($sql_detalle);

            $sql_detalle->bindValue(1,$estado);
            $sql_detalle->bindValue(2,$numero_Batida);
            $sql_detalle->execute();

            $resultado= $sql_detalle->fetch(PDO::FETCH_ASSOC);



            /*una vez se cambie de estado a ACTIVO entonces actualizamos la cantidad de stock en productos*/


            //INICIO ACTUALIZAR LA CANTIDAD DE PRODUCTOS COMPRADOS EN EL STOCK

          $sql2="select * from detalle_Batida where numero_Batida=?";

          $sql2=$conectar->prepare($sql2);

         
            $sql2->bindValue(1,$numero_Batida);
            $sql2->execute();

            $resultado=$sql2->fetchAll();

              foreach($resultado as $row){

                 $id_Mprima=$output["id_Mprima"]=$row["id_Mprima"];
                //selecciona la cantidad comprada
                $cantidad=$output["cantidad"]=$row["cantidad"];



                
                 //si el id_producto existe entonces que consulte si la cantidad de productos existe en la tabla producto

                  if(isset($id_Mprima)==true and count($id_Mprima)>0){
                      
                      $sql3="select * from Mprima where id_Mprima=?";

                      $sql3=$conectar->prepare($sql3);

                      $sql3->bindValue(1, $id_Mprima);
                      $sql3->execute();

                      $resultado=$sql3->fetchAll();

                         foreach($resultado as $row2){
                           
                           //este es la cantidad de stock para cada producto
                           $stock=$output2["stock"]=$row2["stock"];
                           
                           //esta debe estar dentro del foreach para que recorra el $stock de los productos, ya que es mas de un producto que está asociado a la compra
                      //cuando le da click al estado pasa de PAGADO A ANULADO y resta la cantidad de stock en productos con la cantidad de compra de detalle_compras, disminuyendo de esta manera la cantidad actual de productos en el stock de productos
                           $cantidad_actual= $stock - $cantidad;

                         }
                  }

               
                //LE ACTUALIZO LA CANTIDAD DEL PRODUCTO 

               $sql6="update Mprima set 
               stock=?
               where

               id_Mprima=?

               ";
               
               $sql6=$conectar->prepare($sql6);   
               
               $sql6->bindValue(1,$cantidad_actual);
               $sql6->bindValue(2,$id_Mprima);

               $sql6->execute();

             

              }//cierre del foreach



         }//cierre del if del estado del else


          }


       }//CIERRE DEL METODO



         //BUSCA REGISTROS COMPRAS-FECHA

  public function lista_busca_registros_fecha($fecha_inicial, $fecha_final){

            $conectar= parent::conexion();

            
            $date_inicial = $_POST["fecha_inicial"];
            $date = str_replace('/', '-', $date_inicial);
            $fecha_inicial = date("Y-m-d", strtotime($date));
         
            $date_final = $_POST["fecha_final"];
            $date = str_replace('/', '-', $date_final);
            $fecha_final = date("Y-m-d", strtotime($date));

           
             
            $sql= "SELECT * FROM Batida WHERE fecha_Batida>=? and fecha_Batida<=? ";



            $sql = $conectar->prepare($sql);
            $sql->bindValue(1,$fecha_inicial);
            $sql->bindValue(2,$fecha_final);
            $sql->execute();
            return $result = $sql->fetchAll(PDO::FETCH_ASSOC);

       }


       
        //BUSCA REGISTROS COMPRAS-FECHA-MES

        public function lista_busca_registros_fecha_mes($mes, $ano){

          $conectar= parent::conexion();


          //variables que vienen por POST VIA AJAX
             $mes=$_POST["mes"];
             $ano=$_POST["ano"];
            
      
            
           $fecha= ($ano."-".$mes."%");

           //la consulta debe hacerse asi para seleccionar el mes/ano

           /*importante: explicacion de cuando se pone el like y % en una consulta: like sirve para buscar una palabra en especifica dentro de la columna, por ejemplo buscar 09 dentro de 2017-09-04. Los %% se ocupan para indicar en que parte se quiere buscar, si se pone like '%queBusco' significa que lo buscas al final de una cadena, si pones 'queBusco%' significa que se busca al principio de la cadena y si pones '%queBusco%' significa que lo busca en medio, asi la imprimo la consulta en phpmyadmin SELECT * FROM compras WHERE fecha_compra like '2017-09%'*/

      
          $sql= "SELECT * FROM Batida WHERE fecha_Batida like ? ";

            $sql = $conectar->prepare($sql);
            $sql->bindValue(1,$fecha);
            $sql->execute();
            return $result = $sql->fetchAll(PDO::FETCH_ASSOC);


        }


        public function get_Batida_por_id_producto($id_producto){

      $conectar= parent::conexion();

     
      $sql="select * from Batida where id_producto=?";

            $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $id_producto);
            $sql->execute();

            return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);


    }

     public function get_detalle_Batida_por_id_producto($id_producto){

      $conectar= parent::conexion();

     
      $sql="select * from detalle_Batida where id_producto=?";

            $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $id_producto);
            $sql->execute();

            return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);


    }

         public function get_Batida_por_id_usuario($id_usuario){

        $conectar= parent::conexion();

       
        $sql="select * from Batida where id_usuario=?";

              $sql=$conectar->prepare($sql);

              $sql->bindValue(1, $id_usuario);
              $sql->execute();

              return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);


      }


       public function get_detalle_Batida_por_id_usuario($id_usuario){

           $conectar= parent::conexion();

     
           $sql="select * from detalle_Batida where id_usuario=?";

            $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $id_usuario);
            $sql->execute();

            return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);


         }



        /*REPORTES COMPRAS*/


      public function get_Batido_reporte_general(){

       $conectar=parent::conexion();
       parent::set_names();


       //hacer la consulta que seleccione la fecha de mayor a menos


      $sql="SELECT MONTHname(fecha_compra) as mes, MONTH(fecha_compra) as numero_mes, YEAR(fecha_compra) as ano, SUM(total) as total_compra, moneda
        FROM compras where estado='1' GROUP BY YEAR(fecha_compra) desc, month(fecha_compra) desc";

      
         $sql=$conectar->prepare($sql);

         $sql->execute();
         return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

     }
     
     //suma el total de compras por año

     public function suma_Dproducto_total_ano(){

      $conectar=parent::conexion();


       $sql="SELECT YEAR(fecha_compra) as ano,SUM(total) as total_compra_ano, moneda FROM compras where estado='1' GROUP BY YEAR(fecha_compra) desc";
           
           $sql=$conectar->prepare($sql);
           $sql->execute();

           return $resultado= $sql->fetchAll();


     }
     
     //recorro el array para traerme la lista de una en vez de traerlo con el return, y hago el formato para la grafica
     //suma total por año 
     public function suma_Dproducto_total_grafica(){

      $conectar=parent::conexion();


       $sql="SELECT YEAR(fecha_compra) as ano,SUM(total) as total_compra_ano FROM compras where estado='1' GROUP BY YEAR(fecha_compra) desc";
           
           $sql=$conectar->prepare($sql);
           $sql->execute();

           $resultado= $sql->fetchAll();
             
             //recorro el array y lo imprimo
           foreach($resultado as $row){

                 $ano= $output["ano"]=$row["ano"];
                 $p = $output["total_compra_ano"]=$row["total_compra_ano"];

         echo $grafica= "{name:'".$ano."', y:".$p."},";

           }


     }

      public function suma_compras_canceladas_total_grafica(){

      $conectar=parent::conexion();


       $sql="SELECT YEAR(fecha_compra) as ano,SUM(total) as total_compra_ano FROM compras where estado='0' GROUP BY YEAR(fecha_compra) desc";
           
           $sql=$conectar->prepare($sql);
           $sql->execute();

           $resultado= $sql->fetchAll();
             
             //recorro el array y lo imprimo
           foreach($resultado as $row){

                 $ano= $output["ano"]=$row["ano"];
                 $p = $output["total_compra_ano"]=$row["total_compra_ano"];

         echo $grafica= "{name:'".$ano."', y:".$p."},";

           }


       }


       /*REPORTE DE COMPRAS MENSUAL*/

     public function suma_Batida_anio_mes_grafica($fecha){

      $conectar=parent::conexion();
      parent::set_names();
         
         //se usa para traducir el mes en la grafica
       //imprime la fecha por separado ejemplo: dia, mes y año
          $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");

         

       //SI EXISTE EL ENVIO POST ENTONCES SE MUESTRA LA FECHA SELECCIONADA
        if(isset($_POST["year"])){

          $fecha=$_POST["year"];

       $sql="SELECT YEAR(fecha_Batida) as ano, MONTHname(fecha_Batida) as mes, SUM(total) as total_Batida_mes FROM Batida WHERE YEAR(fecha_Batida)=? and estado='1' GROUP BY MONTHname(fecha_Batida) desc";
           
           $sql=$conectar->prepare($sql);
           $sql->bindValue(1,$fecha);
           $sql->execute();

           $resultado= $sql->fetchAll();
             
             //recorro el array y lo imprimo
           foreach($resultado as $row){


                 $ano= $output["mes"]=$meses[date("n", strtotime($row["mes"]))-1];
                 $p = $output["total_Batida_mes"]=$row["total_Batida_mes"];

         echo $grafica= "{name:'".$ano."', y:".$p."},";

           }


         } else {


//sino se envia el POST, entonces se mostraria los datos del año actual cuando se abra la pagina por primera vez

          $fecha_inicial=date("Y");


   $sql="SELECT YEAR(fecha_Batida) as ano, MONTHname(fecha_Batida) as mes, SUM(total) as total_Batida_mes FROM Batida WHERE YEAR(fecha_Batida)=? and estado='1' GROUP BY MONTHname(fecha_Batida) desc";
           
           $sql=$conectar->prepare($sql);
           $sql->bindValue(1,$fecha_inicial);
           $sql->execute();

           $resultado= $sql->fetchAll();
             
             //recorro el array y lo imprimo
           foreach($resultado as $row){

                 $ano= $output["mes"]=$meses[date("n", strtotime($row["mes"]))-1];
                 $p = $output["total_Batida_mes"]=$row["total_Batido_mes"];

         echo $grafica= "{name:'".$ano."', y:".$p."},";

           }//cierre del foreach


         }//cierre del else


     }


     public function get_year_Batida(){

        $conectar=parent::conexion();

          $sql="select year(fecha_Batida) as fecha from Batida group by year(fecha_Batida) asc";
          

          $sql=$conectar->prepare($sql);
          $sql->execute();
          return $resultado= $sql->fetchAll();


     }


     public function get_Batida_mensual($fecha){


        $conectar=parent::conexion();
       

      if(isset($_POST["year"])){

          $fecha=$_POST["year"];

        $sql="select MONTHname(fecha_Batida) as mes, MONTH(fecha_Batida) as numero_mes, YEAR(fecha_Batida) as ano, SUM(total) as total_Batida, moneda
        from Batida where YEAR(fecha_Batida)=? and estado='1' group by MONTHname(fecha_Batida) asc";
          

            $sql=$conectar->prepare($sql);
            $sql->bindValue(1,$fecha);
            $sql->execute();
            return $resultado= $sql->fetchAll();



            } else {

              //sino se envia el POST, entonces se mostraria los datos del año actual cuando se abra la pagina por primera vez

              $fecha_inicial=date("Y");

                 $sql="select MONTHname(fecha_Batida) as mes, MONTH(fecha_Batida) as numero_mes, YEAR(fecha_Batida) as ano, SUM(total) as total_Batida, moneda
            from Batida where YEAR(fecha_Batida)=? and estado='1' group by MONTHname(fecha_Batida) asc";
              

                $sql=$conectar->prepare($sql);
                $sql->bindValue(1,$fecha_inicial);
                $sql->execute();
                return $resultado= $sql->fetchAll();



            }//cierre del else
        
        }



         /*REPORTE POR RANGO DE FECHA Y PROVEEDOR No se si se pueden usar aun_________________ revisa luego
         */


       public function get_pedido_por_fecha($dui,$fecha_inicial,$fecha_final){

            $conectar=parent::conexion();
            parent::set_names();
                
          
            $date_inicial = $_POST["datepicker"];
            $date = str_replace('/', '-', $date_inicial);
            $fecha_inicial = date("Y-m-d", strtotime($date));

          
            $date_final = $_POST["datepicker2"];
            $date = str_replace('/', '-', $date_final);
            $fecha_final = date("Y-m-d", strtotime($date));


            $sql="select * from detalle_compras where dui_proveedor=? and fecha_compra>=? and fecha_compra<=? and estado='1';";

    
              $sql=$conectar->prepare($sql);

              $sql->bindValue(1,$dui);
              $sql->bindValue(2,$fecha_inicial);
              $sql->bindValue(3,$fecha_final);
              $sql->execute();

              return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
             

         }



           public function get_cant_productos_por_fecha($dui,$fecha_inicial,$fecha_final){

            $conectar=parent::conexion();
            parent::set_names();

            $date_inicial = $_POST["datepicker"];
            $date = str_replace('/', '-', $date_inicial);
            $fecha_inicial = date("Y-m-d", strtotime($date));

          
            $date_final = $_POST["datepicker2"];
            $date = str_replace('/', '-', $date_final);
            $fecha_final = date("Y-m-d", strtotime($date));


           $sql="select sum(cantidad_compra) as total from detalle_compras where dui_proveedor=? and fecha_compra >=? and fecha_compra <=? and estado = '1';";

        
            $sql=$conectar->prepare($sql);

            $sql->bindValue(1,$dui);
            $sql->bindValue(2,$fecha_inicial);
            $sql->bindValue(3,$fecha_final);
            $sql->execute();

            return $resultado=$sql->fetch(PDO::FETCH_ASSOC);
           
        } 



        public function get_compras_anio_actual(){

            $conectar=parent::conexion();
            parent::set_names();

            $sql="SELECT YEAR(fecha_compra) as ano, MONTHname(fecha_compra) as mes, SUM(total) as total_compra_mes, moneda FROM compras WHERE YEAR(fecha_compra)=YEAR(CURDATE()) and estado='1' GROUP BY MONTHname(fecha_compra) desc";

            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();

        }


          public function get_compras_anio_actual_grafica(){

           $conectar=parent::conexion();
           parent::set_names();

            $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
           
           $sql="SELECT  MONTHname(fecha_compra) as mes, SUM(total) as total_compra_mes FROM compras WHERE YEAR(fecha_compra)=YEAR(CURDATE()) and estado='1' GROUP BY MONTHname(fecha_compra) desc";
               
               $sql=$conectar->prepare($sql);
               $sql->execute();

               $resultado= $sql->fetchAll();
                 
                 //recorro el array y lo imprimo
               foreach($resultado as $row){


              $mes= $output["mes"]=$meses[date("n", strtotime($row["mes"]))-1];
              $p = $output["total_compra_mes"]=$row["total_compra_mes"];

             echo $grafica= "{name:'".$mes."', y:".$p."},";

               }
     
        }
       

    }

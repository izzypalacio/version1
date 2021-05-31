<?php

  require_once("../modelos/conexion.php");

   class producto extends Conectar{
    

        public function get_filas_producto(){

       $conectar= parent::conexion();
         
           $sql="select * from producto";
           
           $sql=$conectar->prepare($sql);

           $sql->execute();

           $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

           return $sql->rowCount();
      
      }


       //método para seleccionar registros

   	   public function get_producto(){

   	   	  $conectar=parent::conexion();
   	   	  parent::set_names();

   	   	  $sql= "select p.id_producto,p.productoc,p.rinde,p.id_categoria,f.planta,f.costo,p.fecha,p.estado,c.categoria as categoria, f.planta as cif

          from producto p

          INNER JOIN categoria c ON p.id_categoria=c.id_categoria
          INNER JOIN cif f ON p.id_cif=f.id_cif;
          ";

   	   	  $sql=$conectar->prepare($sql);
   	   	  $sql->execute();

   	   	  return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
   	   }

   	    //método para mostrar los datos de un registro a modificar
        public function gett_producto_por_id($id_producto){

            
            $conectar= parent::conexion();
            parent::set_names();

            $sql="select * from producto where id_producto=?";

            $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $id_producto);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        } 


      public function get_producto_por_id_estado($id_producto,$estado){

         $conectar= parent::conexion();

         //declaramos que el estado esté activo, igual a 1

         $estado=1;

          
        $sql="select p.id_producto,p.productoc,p.rinde,p.id_categoria,f.planta,f.costo,p.fecha,p.estado,c.categoria as categoria, f.planta as cif

          from producto p

          INNER JOIN categoria c ON p.id_categoria=c.id_categoria
          INNER JOIN cif f ON p.id_cif=f.id_cif

          where p.id_producto=? and f.estado=?



          ";

              $sql=$conectar->prepare($sql);

              $sql->bindValue(1, $id_producto);
               $sql->bindValue(2, $estado);
              $sql->execute();

              return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);


         }  


        //método para insertar registros

        public function registrar_producto($productoc,$rinde,$id_categoria,$planta,$estado,$id_usuario){


           $conectar= parent::conexion();
           parent::set_names();

           $sql="insert into producto
           values(null,?,?,?,?,now(),?,?);";

           //echo $sql;

           $sql=$conectar->prepare($sql);

		      $sql->bindValue(1,$_POST["productoc"]);
          $sql->bindValue(2,$_POST["rinde"]);
          $sql->bindValue(3,$_POST["categoria"]);
          $sql->bindValue(4,$_POST["planta"]);
		      $sql->bindValue(5,$_POST["estado"]);
		      $sql->bindValue(6,$_POST["id_usuario"]);
		      $sql->execute();
      
          //print_r($_POST);

        }

        public function get_producto_por_productoc($productoc){

            
            $conectar= parent::conexion();
            parent::set_names();

            $sql="select * from producto where productoc=?";

            $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $productoc);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function editar_producto($id_producto,$productoc,$rinde,$id_categoria,$planta,$estado,$id_usuario){

        	$conectar=parent::conexion();
        	parent::set_names();

        	require_once("producto.php");

          $producto= new producto();

          //verifica si el id_categoria tiene registro asociado a compras
         $producto_Dproducto=$producto->get_producto_por_id_Dproducto($_POST["id_producto"]);


            //si el id_categoria NO tiene registros asociados en las tablas detalle_compras entonces se puede editar todos los campos de la categoria
          if(is_array($producto_Dproducto)==true and count($producto_Dproducto)==0){

                $sql="update producto set 

                  productoc=?,
                  rinde=?,
                  id_categoria=?,
                  id_cif=?,
                  estado=?,
                  id_usuario=?
                  where 
                  id_producto=?

                ";
                  
                 //echo $sql; exit();

                   $sql=$conectar->prepare($sql);

                    $sql->bindValue(1,$_POST["productoc"]);
                    $sql->bindValue(2,$_POST["rinde"]);
                    $sql->bindValue(3,$_POST["categoria"]);
                    $sql->bindValue(4,$_POST["planta"]);
                    $sql->bindValue(5,$_POST["estado"]);
                    $sql->bindValue(6,$_POST["id_usuario"]);
                    $sql->bindValue(7,$_POST["id_producto"]);
                    $sql->execute();
       
            }else {


                 //si la categoria tiene registros asociados en compras y detalle_compras entonces no se edita la categoria

                 $sql="update producto set 

                  rinde=?,
                  id_categoria=?,
                  id_cif=?,
                  estado=?,
                  id_usuario=?
                  where 
                  id_producto=?

                ";
                  
                 //echo $sql; exit();

                    $sql=$conectar->prepare($sql);

                    $sql->bindValue(1,$_POST["rinde"]);
                    $sql->bindValue(2,$_POST["categoria"]);
                    $sql->bindValue(3,$_POST["planta"]);
                    $sql->bindValue(4,$_POST["estado"]);
                    $sql->bindValue(5,$_POST["id_usuario"]);
                    $sql->bindValue(6,$_POST["id_producto"]);
                    $sql->execute();
       

            }

 
            
        }



        public function get_datos_producto($productoc,$categoria){

           $conectar=parent::conexion();

          $sql="select * from producto where productoc=? or categoria=?";

           //echo $sql; exit();

           $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $productoc);
            $sql->bindValue(2, $categoria);
            $sql->execute();

           //print_r($email); exit();

           return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }


         //método para activar Y/0 desactivar el estado de la categoria

        public function editar_estado($id_producto,$estado){

        	 $conectar=parent::conexion();

        	 //si el estado es igual a 0 entonces el estado cambia a 1
        	 //el parametro est se envia por via ajax
        	 if($_POST["est"]=="0"){

        	   $estado=1;

        	 } else {

        	 	 $estado=0;
        	 }

        	 $sql="update producto set 
              
              estado=?
              where 
              id_producto=?

        	 ";

        	 $sql=$conectar->prepare($sql);

        	 $sql->bindValue(1,$estado);
        	 $sql->bindValue(2,$id_producto);
        	 $sql->execute();
        }


        //método si la categoria existe en la base de datos

        public function get_nombre_producto($productoc){

           $conectar=parent::conexion();

          $sql="select * from producto where productoc=?";

           //echo $sql; exit();

           $sql=$conectar->prepare($sql);

           $sql->bindValue(1,$productoc);
           $sql->execute();

           //print_r($email); exit();

           return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }

         //metodo para consultar si la tabla productos tiene registros asociados con categorias
         public function get_prod_por_id_cate($id_categoria){

      $conectar= parent::conexion();

      //$output = array();

      $sql="select * from producto where id_categoria=?";

            $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $id_categoria);
            $sql->execute();

            return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);


          }

          //metodo para consultar si la tabla productos tiene registros asociados con categorias
         public function get_prod_por_id_Dproducto($id_Dproducto){

      $conectar= parent::conexion();

      //$output = array();

      $sql="select * from producto where id_Dproducto=?";

            $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $id_Dproducto);
            $sql->execute();

            return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);


          }

          public function get_prod_por_id_Mprima($id_Mprima){

      $conectar= parent::conexion();

      //$output = array();

      $sql="select * from producto where id_Mprima=?";

            $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $id_Mprima);
            $sql->execute();

            return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);


          }

          public function get_prod_por_id_Cfabricacion($id_Cfabricacion){

      $conectar= parent::conexion();

      //$output = array();

      $sql="select * from producto where id_Cfabricacion=?";

            $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $id_Cfabricacion);
            $sql->execute();

            return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);


          }

public function get_prod_por_id_producto($id_producto){

      $conectar= parent::conexion();

      //$output = array();

      $sql="select * from productos where id_producto=?";

            $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $id_producto);
            $sql->execute();

            return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);


          }
       

        //método para eliminar un registro
        public function eliminar_producto($id_producto){

           $conectar=parent::conexion();
         

           $sql="delete from producto where id_producto=?";

           $sql=$conectar->prepare($sql);
           $sql->bindValue(1,$id_producto);
           $sql->execute();

           return $resultado=$sql->fetch();
        }


         public function get_producto_por_id_usuario($id_usuario){

          $conectar= parent::conexion();

           $sql="select * from producto where id_usuario=?";

              $sql=$conectar->prepare($sql);

              $sql->bindValue(1, $id_usuario);
              $sql->execute();

              return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);


      }


             //consulta si el id_categoria tiene una compra asociada
       public function get_producto_por_id_Dproducto($id_producto){

             
             $conectar=parent::conexion();
             parent::set_names();


          $sql="select c.id_producto,comp.id_producto
                 
           from producto c 
              
              INNER JOIN Dproducto comp ON c.id_producto=comp.id_producto


              where c.id_producto=?

              ";

             $sql=$conectar->prepare($sql);
             $sql->bindValue(1, $id_producto);
             $sql->execute();

             return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

    }

      
      //consulta si el id_categoria tiene un detalle_compra asociado
      public function get_producto_por_id_detalle_Dproducto($id_producto){

            $conectar=parent::conexion();
             parent::set_names();


           $sql="select c.id_producto,d.id_producto
           from producto c 
              
              INNER JOIN detalle_Dproducto d ON c.id_producto=d.id_producto


              where c.id_producto=?

              ";

             $sql=$conectar->prepare($sql);
             $sql->bindValue(1,$id_producto);
             $sql->execute();

             return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
       
       }

       



   }

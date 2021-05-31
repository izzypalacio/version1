<?php

  require_once("../modelos/conexion.php");

   class Mprima extends Conectar{
    

        public function get_filas_Mprima(){

       $conectar= parent::conexion();
         
           $sql="select * from Mprima";
           
           $sql=$conectar->prepare($sql);

           $sql->execute();

           $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

           return $sql->rowCount();
      
      }


       //método para seleccionar registros

   	   public function get_Mprima(){

   	   	  $conectar=parent::conexion();
   	   	  parent::set_names();

   	   	  $sql="select * from Mprima";

   	   	  $sql=$conectar->prepare($sql);
   	   	  $sql->execute();

   	   	  return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
   	   }

   	    //método para mostrar los datos de un registro a modificar
        public function get_Mprima_por_id($id_Mprima){

          //solucion error de la otra 


            $conectar= parent::conexion();
            parent::set_names();

            $sql="select * from Mprima where id_Mprima=?";

            $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $id_Mprima);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        } 

        public function get_Mprima_en_Dproducto(){

           $conectar= parent::conexion();

          $sql= "select * from Mprima";

           $sql=$conectar->prepare($sql);

           $sql->execute();

           return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);


         }


        //método para insertar registros

        public function registrar_Mprima($materiales,$unidadm,$moneda,$precio,$stock,$estado,$id_usuario){


           $conectar= parent::conexion();
           parent::set_names();

           $stock = "";

               if($stock==""){

                $stocker=0;

               } else {

                  $stocker = $_POST["stock"];
               }


           $sql="insert into Mprima
           values(null,?,?,?,?,?,?,?);";

           //echo $sql;

           $sql=$conectar->prepare($sql);

		      $sql->bindValue(1,$_POST["materiales"]);
          $sql->bindValue(2,$_POST["unidadm"]);
          $sql->bindValue(3,$_POST["moneda"]);
          $sql->bindValue(4,$_POST["precio"]);
          $sql->bindValue(5, $stocker);
		      $sql->bindValue(6,$_POST["estado"]);
		      $sql->bindValue(7,$_POST["id_usuario"]);
		      $sql->execute();
      
          //print_r($_POST);

        }

        public function get_Mprima_por_id_estado($id_Mprima,$estado){

           $conectar= parent::conexion();

           //declaramos que el estado esté activo, igual a 1

            $estado=1;


            $sql="select * from Mprima where id_Mprima=? and estado=?";

            $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $id_Mprima);
            $sql->bindValue(2, $estado);
            $sql->execute();

            return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);


    }

        public function editar_Mprima($id_Mprima,$materiales,$unidadm,$moneda,$precio,$stock,$estado,$id_usuario){

        	$conectar=parent::conexion();
        	parent::set_names();

          $stock = "";

         if($stock==""){

           $stocker=0;

         } else {

            $stocker = $_POST["stock"];
         }

        	require_once("Mprima.php");
           require_once("Dproducto.php");

          $Mprima= new Mprima();
          $Dproducto= new Dproducto();

          //verifica si el id_categoria tiene registro asociado a compras
         $Mprima_precio=$Mprima->get_precio_por_id_detalle_Dproducto($_POST["id_Mprima"]);


          //verifica si el id_categoria tiene registro asociado a detalle_compras
         $Mprima_detalle_Dproducto=$Mprima->get_Mprima_por_id_detalle_Dproducto($_POST["id_Mprima"]);


            //si el id_categoria NO tiene registros asociados en las tablas detalle_compras entonces se puede editar todos los campos de la categoria
          if(is_array($Mprima_precio)==true and count($Mprima_precio)==0){

            $sqlMprima = "
            update Mprima
               set materiales = ?,
               unidadm = ?,
               moneda = ?,
               precio = ?,
               stock = ?,
               estado = ?,
               id_usuario = ?
             where id_Mprima = ?   
            ";
            
            $sqlDetalle = "
            update detalle_Dproducto
               set precio = ?
              
             where id_Mprima= ?
            ";
            
            $qMprima = $conectar->prepare($sqlMprima);
            $qDetalle = $conectar->prepare($sqlDetalle);
            
            $qDetalle->bindValue(1, $_POST["precio"]);
            $qDetalle->bindValue(2, $_POST["id_Mprima"]);
            $qMprima->bindValue(1, $_POST["materiales"]);
            $qMprima->bindValue(2, $_POST["unidadm"]);
            $qMprima->bindValue(3, $_POST["moneda"]);
            $qMprima->bindValue(4, $_POST["precio"]);
            $qMprima->bindValue(5, $stocker);
            $qMprima->bindValue(6, $_POST["estado"]);
            $qMprima->bindValue(7, $_POST["id_usuario"]);
            $qMprima->bindValue(8, $_POST["id_Mprima"]);
            
            $qMprima->execute();
            $qDetalle->execute();
       
            }else {


                 //si la categoria tiene registros asociados en compras y detalle_compras entonces no se edita la categoria

                 $sqlMprima = "
            update Mprima
               set materiales = ?,
               unidadm = ?,
               moneda = ?,
               precio = ?,
               stock = ?,
               estado = ?,
               id_usuario = ?
             where id_Mprima = ?   
            ";
            
            $sqlDetalle = "
            update detalle_Dproducto
            set precio = ?
              
             where id_detalle_Dproducto
            ";
            
            $qMprima = $conectar->prepare($sqlMprima);
            $qDetalle = $conectar->prepare($sqlDetalle);
            
            $qDetalle->bindValue(1, $_POST["precio"]);
            $qDetalle->bindValue(2, $_POST["id_detalle_Dproducto"]);
            $qMprima->bindValue(1, $_POST["materiales"]);
            $qMprima->bindValue(2, $_POST["unidadm"]);
            $qMprima->bindValue(3, $_POST["moneda"]);
            $qMprima->bindValue(4, $_POST["precio"]);
            $qMprima->bindValue(5, $stocker);
            $qMprima->bindValue(6, $_POST["estado"]);
            $qMprima->bindValue(7, $_POST["id_usuario"]);
            $qMprima->bindValue(8, $_POST["id_Mprima"]);
            
            $qMprima->execute();
            $qDetalle->execute();
       

            }

 
            
        }


         //método para activar Y/0 desactivar el estado de la categoria

        public function editar_estado($id_Mprima,$estado){

        	 $conectar=parent::conexion();

        	 //si el estado es igual a 0 entonces el estado cambia a 1
        	 //el parametro est se envia por via ajax
        	 if($_POST["est"]=="0"){

        	   $estado=1;

        	 } else {

        	 	 $estado=0;
        	 }

        	 $sql="update Mprima set 
              
              estado=?
              where 
              id_Mprima=?

        	 ";

        	 $sql=$conectar->prepare($sql);

        	 $sql->bindValue(1,$estado);
        	 $sql->bindValue(2,$id_Mprima);
        	 $sql->execute();
        }


        


        //método si la categoria existe en la base de datos

        public function get_nombre_Mprima($Mprima){

           $conectar=parent::conexion();

          $sql="select * from Mprima where materiales=?";

           //echo $sql; exit();

           $sql=$conectar->prepare($sql);

           $sql->bindValue(1,$Mprima);
           $sql->execute();

           //print_r($email); exit();

           return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }
       

        //método para eliminar un registro
        public function eliminar_Mprima($id_Mprima)
        {

           $conectar=parent::conexion();
         

           $sql="delete from Mprima where id_Mprima=?";

           $sql=$conectar->prepare($sql);
           $sql->bindValue(1,$id_Mprima);
           $sql->execute();

           return $resultado=$sql->fetch();
        }


         public function get_Mprima_por_id_usuario($id_usuario){

          $conectar= parent::conexion();

           $sql="select * from Mprima where id_usuario=?";

              $sql=$conectar->prepare($sql);

              $sql->bindValue(1, $id_usuario);
              $sql->execute();

              return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);


      }

      public function get_Mprima_por_id_detalle_Dproducto($id_Mprima){


             $conectar=parent::conexion();
             parent::set_names();


      $sql="select p.id_Mprima,p.materiales,p.unidadm,c.id_Mprima, c.materiales, c.unidadm as Mprima_Dproducto

           from Mprima p

              INNER JOIN detalle_Dproducto c ON p.id_Mprima=c.id_Mprima


              where p.id_Mprima=?

              ";

             $sql=$conectar->prepare($sql);
             $sql->bindValue(1,$id_Mprima);
             $sql->execute();

             return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

      }

      public function get_precio_por_id_detalle_Dproducto($id_Mprima){


         $conectar=parent::conexion();
         parent::set_names();
         
         $sql = "
         update detalle_Dproducto
         set precio = ?
           
          where id_Mprima = ? 
         ";

         $sql=$conectar->prepare($sql);
         $sql->bindValue(1,$id_Mprima);
         $sql->execute();

         return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

  }


// hice un cambio de variable pára poder cambiar la direccion de el modulo de categoria de

             //consulta si el id_categoria tiene una compra asociada
      
       public function get_Mprima_por_id_compras($id_Mprima){

             
             $conectar=parent::conexion();
             parent::set_names();


          $sql="select c.id_Mprima,comp.id_Mprima
                 
           from Mprima c 
              
              INNER JOIN compras comp ON c.id_Mprima=comp.id_Mprima


              where c.id_Mprima=?

              ";

             $sql=$conectar->prepare($sql);
             $sql->bindValue(1,$id_Mprima);
             $sql->execute();

             return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

    }

      
      //consulta si el id_categoria tiene un detalle_compra asociado
   



   }

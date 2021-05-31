<?php

  require_once("../modelos/conexion.php");

   class Cfabricacion extends Conectar{
    

        public function get_filas_Cfabricacion(){

       $conectar= parent::conexion();
         
           $sql="select * from Cfabricacion";
           
           $sql=$conectar->prepare($sql);

           $sql->execute();

           $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

           return $sql->rowCount();
      
      }


       //método para seleccionar registros

   	   public function get_Cfabricacion(){

   	   	  $conectar=parent::conexion();
   	   	  parent::set_names();

   	   	  $sql="select * from Cfabricacion";

   	   	  $sql=$conectar->prepare($sql);
   	   	  $sql->execute();

   	   	  return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
   	   }

   	    //método para mostrar los datos de un registro a modificar
        public function get_Cfabricacion_por_id($id_Cfabricacion){

          //solucion error de la otra 


            $conectar= parent::conexion();
            parent::set_names();

            $sql="select * from Cfabricacion where id_Cfabricacion=?";

            $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $id_Cfabricacion);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        } 


        //método para insertar registros

        public function registrar_Cfabricacion($servicios,$unidadm,$tiempo,$porcentaje,$costos,$estado,$id_usuario){


           $conectar= parent::conexion();
           parent::set_names();

           $sql="insert into Cfabricacion
           values(null,?,?,?,?,?,?,?);";

           //echo $sql;

           $sql=$conectar->prepare($sql);

		      $sql->bindValue(1,$_POST["servicios"]);
          $sql->bindValue(2,$_POST["unidadm"]);
          $sql->bindValue(3,$_POST["tiempo"]);
          $sql->bindValue(4,$_POST["porcentaje"]);
          $sql->bindValue(5,$_POST["costos"]);
		      $sql->bindValue(6,$_POST["estado"]);
		      $sql->bindValue(7,$_POST["id_usuario"]);
		      $sql->execute();
      
          //print_r($_POST);

        }

        public function editar_Cfabricacion($id_Cfabricacion,$servicios,$unidadm,$tiempo,$porcentaje,$costos,$estado,$id_usuario){

        	$conectar=parent::conexion();
        	parent::set_names();

        	require_once("Cfabricacion.php");

          $Cfabricacion= new Cfabricacion();

          //verifica si el id_categoria tiene registro asociado a compras
         $Cfabricacion_compras=$Cfabricacion->get_Cfabricacion_por_id_compras($_POST["id_Cfabricacion"]);


          //verifica si el id_categoria tiene registro asociado a detalle_compras
         $Cfabricacion_detalle_compras=$Cfabricacion->get_Cfabricacion_por_id_detalle_compras($_POST["id_Cfabricacion"]);


            //si el id_categoria NO tiene registros asociados en las tablas detalle_compras entonces se puede editar todos los campos de la categoria
          if(is_array($Cfabricacion_compras)==true and count($Cfabricacion_compras)==0 and is_array($Cfabricacion_detalle_compras)==true and count($Cfabricacion_detalle_compras)==0){

                $sql="update Cfabricacion set 

                  servicios=?,
                  unidadm=?,
                  tiempo=?,
                  porcentaje=?,
                  costos=?,
                  estado=?,
                  id_usuario=?
                  where 
                  id_Cfabricacion?

                ";
                  
                 //echo $sql; exit();

                   $sql=$conectar->prepare($sql);

                    $sql->bindValue(1,$_POST["servicios"]);
                    $sql->bindValue(2,$_POST["unidadm"]);
                    $sql->bindValue(3,$_POST["tiempo"]);
                    $sql->bindValue(4,$_POST["porcentaje"]);
                    $sql->bindValue(5,$_POST["costos"]);
                    $sql->bindValue(6,$_POST["estado"]);
                    $sql->bindValue(7,$_POST["id_usuario"]);
                    $sql->bindValue(8,$_POST["id_Cfabricacion"]);
                    $sql->execute();
       
            }else {


                 //si la categoria tiene registros asociados en compras y detalle_compras entonces no se edita la categoria

                 $sql="update Cfabricacion set

                  unidadm=?,
                  tiempo=?,
                  porcentaje=?,
                  costos=?,
                  estado=?,
                  id_usuario=?
                  where 
                  id_Cfabricacion=?

                ";
                  
                 //echo $sql; exit();

                    $sql=$conectar->prepare($sql);

                    $sql->bindValue(1,$_POST["unidadm"]);
                    $sql->bindValue(2,$_POST["tiempo"]);
                    $sql->bindValue(3,$_POST["porcentaje"]);
                    $sql->bindValue(4,$_POST["costos"]);
                    $sql->bindValue(5,$_POST["estado"]);
                    $sql->bindValue(6,$_POST["id_usuario"]);
                    $sql->bindValue(7,$_POST["id_Cfabricacion"]);
                    $sql->execute();
       

            }

 
            
        }


         //método para activar Y/0 desactivar el estado de la categoria

        public function editar_estado($id_Cfabricacion,$estado){

        	 $conectar=parent::conexion();

        	 //si el estado es igual a 0 entonces el estado cambia a 1
        	 //el parametro est se envia por via ajax
        	 if($_POST["est"]=="0"){

        	   $estado=1;

        	 } else {

        	 	 $estado=0;
        	 }

        	 $sql="update Cfabricacion set 
              
              estado=?
              where 
              id_Cfabricacion=?

        	 ";

        	 $sql=$conectar->prepare($sql);

        	 $sql->bindValue(1,$estado);
        	 $sql->bindValue(2,$id_Cfabricacion);
        	 $sql->execute();
        }


        //método si la categoria existe en la base de datos

        public function get_nombre_Cfabricacion($Cfabricacion){

           $conectar=parent::conexion();

          $sql="select * from servicios where Cfabricacion=?";

           //echo $sql; exit();

           $sql=$conectar->prepare($sql);

           $sql->bindValue(1,$Cfabricacion);
           $sql->execute();

           //print_r($email); exit();

           return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }
       

        //método para eliminar un registro
        public function eliminar_Cfabricacion($id_Cfabricacion)
        {

           $conectar=parent::conexion();
         

           $sql="delete from Cfabricacion where id_Cfabricacion=?";

           $sql=$conectar->prepare($sql);
           $sql->bindValue(1,$id_Cfabricacion);
           $sql->execute();

           return $resultado=$sql->fetch();
        }


         public function get_Cfabricacion_por_id_usuario($id_usuario){

          $conectar= parent::conexion();

           $sql="select * from Cfabricacion where id_usuario=?";

              $sql=$conectar->prepare($sql);

              $sql->bindValue(1, $id_usuario);
              $sql->execute();

              return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);


      }


// hice un cambio de variable pára poder cambiar la direccion de el modulo de categoria de

             //consulta si el id_categoria tiene una compra asociada
      
       public function get_Cfabricacion_por_id_compras($id_Cfabricacion){

             
             $conectar=parent::conexion();
             parent::set_names();


          $sql="select c.id_Cfabricacion,comp.id_Cfabricacion
                 
           from Cfabricacion c 
              
              INNER JOIN compras comp ON c.id_Cfabricacion=comp.id_Cfabricacion


              where c.id_Cfabricacion=?

              ";

             $sql=$conectar->prepare($sql);
             $sql->bindValue(1,$id_Cfabricacion);
             $sql->execute();

             return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);

    }

      
      //consulta si el id_categoria tiene un detalle_compra asociado
      public function get_Cfabricacion_por_id_detalle_compras($id_Cfabricacion){

            $conectar=parent::conexion();
             parent::set_names();


           $sql="select c.id_Cfabricacion,d.id_Cfabricacion
           from Cfabricacion c 
              
              INNER JOIN detalle_compras d ON c.id_Cfabricacion=d.id_Cfabricacion


              where c.id_Cfabricacion=?

              ";

             $sql=$conectar->prepare($sql);
             $sql->bindValue(1,$id_Cfabricacion);
             $sql->execute();

             return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
       
       }



   }

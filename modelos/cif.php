<?php

  require_once("../modelos/conexion.php");

   class cif extends Conectar{
    

        public function get_filas_cif(){

       $conectar= parent::conexion();
         
           $sql="select * from cif";
           
           $sql=$conectar->prepare($sql);

           $sql->execute();

           $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);

           return $sql->rowCount();
      
      }


       //método para seleccionar registros

   	   public function get_cif(){

   	   	  $conectar=parent::conexion();
   	   	  parent::set_names();

   	   	  $sql="select * from cif";

   	   	  $sql=$conectar->prepare($sql);
   	   	  $sql->execute();

   	   	  return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
   	   }

   	    //método para mostrar los datos de un registro a modificar
        public function get_cif_por_id($id_cif){

            
            $conectar= parent::conexion();
            parent::set_names();

            $sql="select * from cif where id_cif=?";

            $sql=$conectar->prepare($sql);

            $sql->bindValue(1, $id_cif);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        } 


        //método para insertar registros

        public function registrar_cif($planta,$costo,$estado,$id_usuario){


           $conectar= parent::conexion();
           parent::set_names();

           $sql="insert into cif
           values(null,?,?,?,?);";

           //echo $sql;

           $sql=$conectar->prepare($sql);

		      $sql->bindValue(1,$_POST["planta"]);
          $sql->bindValue(2,$_POST["costo"]);
		      $sql->bindValue(3,$_POST["estado"]);
		      $sql->bindValue(4,$_POST["id_usuario"]);
		      $sql->execute();
      
          //print_r($_POST);

        }

        public function editar_cif($id_cif,$planta,$costo,$estado,$id_usuario){

        	$conectar=parent::conexion();
        	parent::set_names();

        	require_once("cif.php");

          $cif = new cif();

            //si el id_categoria NO tiene registros asociados en las tablas detalle_compras entonces se puede editar todos los campos de la categoria
          if(is_array($cif)==true and count($cif)==0){

                $sql="update cif set 

                  planta=?,
                  costo=?,
                  estado=?,
                  id_usuario=?
                  where 
                  id_cif=?

                ";
                  
                 //echo $sql; exit();

                   $sql=$conectar->prepare($sql);

                    $sql->bindValue(1,$_POST["planta"]);
                    $sql->bindValue(2,$_POST["costo"]);
                    $sql->bindValue(3,$_POST["estado"]);
                    $sql->bindValue(4,$_POST["id_usuario"]);
                    $sql->bindValue(5,$_POST["id_cif"]);
                    $sql->execute();
       
            }else {


                 //si la categoria tiene registros asociados en compras y detalle_compras entonces no se edita la categoria

                 $sql="update cif set


                  planta=?,
                  costo=?,
                  estado=?,
                  id_usuario=?
                  where 
                  id_cif=?

                ";
                  
                 //echo $sql; exit();

                    $sql=$conectar->prepare($sql);

                     $sql->bindValue(1,$_POST["planta"]);
                    $sql->bindValue(2,$_POST["costo"]);
                    $sql->bindValue(3,$_POST["estado"]);
                    $sql->bindValue(4,$_POST["id_usuario"]);
                    $sql->bindValue(5,$_POST["id_cif"]);
                    $sql->execute();
       

            }

 
            
        }


         //método para activar Y/0 desactivar el estado de la categoria

        public function editar_estado($id_cif,$estado){

        	 $conectar=parent::conexion();

        	 //si el estado es igual a 0 entonces el estado cambia a 1
        	 //el parametro est se envia por via ajax
        	 if($_POST["est"]=="0"){

        	   $estado=1;

        	 } else {

        	 	 $estado=0;
        	 }

        	 $sql="update cif set 
              
              estado=?
              where 
              id_cif=?

        	 ";

        	 $sql=$conectar->prepare($sql);

        	 $sql->bindValue(1,$estado);
        	 $sql->bindValue(2,$id_cif);
        	 $sql->execute();
        }


        //método si la categoria existe en la base de datos

        public function get_nombre_cif($planta){

           $conectar=parent::conexion();

          $sql="select * from cif where planta=?";

           //echo $sql; exit();

           $sql=$conectar->prepare($sql);

           $sql->bindValue(1,$planta);
           $sql->execute();

           //print_r($email); exit();

           return $resultado=$sql->fetchAll(PDO::FETCH_ASSOC);
        }
       

        //método para eliminar un registro
        public function eliminar_cif($id_cif){

           $conectar=parent::conexion();
         

           $sql="delete from cif where id_cif=?";

           $sql=$conectar->prepare($sql);
           $sql->bindValue(1,$id_cif);
           $sql->execute();

           return $resultado=$sql->fetch();
        }


         public function get_cif_por_id_usuario($id_usuario){

          $conectar= parent::conexion();

           $sql="select * from cif where id_usuario=?";

              $sql=$conectar->prepare($sql);

              $sql->bindValue(1, $id_usuario);
              $sql->execute();

              return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);


      }


             //consulta si el id_categoria tiene una compra asociada
       

      
      //consulta si el id_categoria tiene un detalle_compra asociado
      



   }

<?php


//llamo a la conexion de la base de datos 
require_once("../modelos/conexion.php");
//llamo al modelo Categorías
require_once("../modelos/Mprima.php");

//llamo al modelo Producto
require_once("../modelos/producto.php");

$producto = new producto();

$Mprima = new Mprima();


//declaramos las variables de los valores que se envian por el formulario y que recibimos por ajax y decimos que si existe el parametro que estamos recibiendo

//los valores vienen del atributo name de los campos del formulario
/*el valor id_usuario y id_categoria se carga en el campo hidden cuando se edita un registro*/
//se copian los campos de la tabla categoria
$id_Mprima = isset($_POST["id_Mprima"]);
$id_usuario = isset($_POST["id_usuario"]);
$materiales = isset($_POST["materiales"]);
$unidadm = isset($_POST["unidadm"]);
$moneda = isset($_POST["moneda"]);
$precio = isset($_POST["precio"]);
$stock = isset($_POST["stock"]);
$estado = isset($_POST["estado"]);


switch ($_GET["op"]) {


  case "guardaryeditar":


    /*si el id no existe entonces lo registra
	           importante: se debe poner el $_POST sino no funciona*/
    if (empty($_POST["id_Mprima"])) {

      /*verificamos si existe la categoria en la base de datos, si ya existe un registro con la categoria entonces no se registra*/

      //importante: se debe poner el $_POST sino no funciona
      $datos = $Mprima->get_nombre_Mprima($_POST["materiales"]);

      if (is_array($datos) == true and count($datos) == 0) {

        //no existe la categoria por lo tanto hacemos el registros

        $Mprima->registrar_Mprima($materiales, $unidadm, $moneda, $precio, $stock, $estado, $id_usuario);



        $messages[] = ".";
      } //cierre de validacion de $datos 


      /*si ya existes la categoria entonces aparece el mensaje*/ else {

        $errors[] = "Costo de Fabricacion ya existe";
      }
    } //cierre de empty

    else {


      /*si ya existe entonces editamos la categoria*/


      $Mprima->editar_Mprima($id_Mprima, $materiales, $unidadm, $moneda, $precio, $stock, $estado, $id_usuario);


      $messages[] = "Costo de Fabricacion Correcto";
    }



    //mensaje success
    if (isset($messages)) {

?>
      <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Registro Correcto</strong>
        <?php
        foreach ($messages as $message) {
          echo $message;
        }
        ?>
      </div>
    <?php
    }
    //fin success

    //mensaje error
    if (isset($errors)) {

    ?>
      <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Error!</strong>
        <?php
        foreach ($errors as $error) {
          echo $error;
        }
        ?>
      </div>
    <?php

    }

    //fin mensaje error


    break;


  case 'mostrar':

    //selecciona el id de la categoria

    //el parametro id_categoria se envia por AJAX cuando se edita la categoria
    $datos = $Mprima->get_Mprima_por_id($_POST["id_Mprima"]);


    //verifica si el id_categoria tiene registro asociado a compras
    $Mprima_detalle_Dproducto = $Mprima->get_Mprima_por_id_detalle_Dproducto($_POST["id_Mprima"]);

    //valida si el id_categoria  tiene registros asociados en la tabla compras y detalle_compras
    if (is_array($Mprima_detalle_Dproducto) == true and count($Mprima_detalle_Dproducto) == 0) {


      foreach ($datos as $row) {
        $output["materiales"] = $row["materiales"];
        $output["unidadm"] = $row["unidadm"];
        $output["moneda"] = $row["moneda"];
        $output["precio"] = $row["precio"];
        $output["stock"] = $row["stock"];
        $output["estado"] = $row["estado"];
        $output["id_usuario"] = $row["id_usuario"];
      }
    } else {

      //si el id_categoria tiene relacion con la tabla compras y detalle_compras entonces se deshabilita la categoria


      foreach ($datos as $row) {

        $output["Mprima_id"] = $row["id_Mprima"];
        $output["materiales"] = $row["materiales"];
        $output["unidadm"] = $row["unidadm"];
        $output["moneda"] = $row["moneda"];
        $output["precio"] = $row["precio"];
        $output["stock"] = $row["stock"];
        $output["estado"] = $row["estado"];
        $output["id_usuario"] = $row["id_usuario"];
      }
    } //cierre el else

    echo json_encode($output);


    break;

  case "activarydesactivar":

    //los parametros id_categoria y est vienen por via ajax
    $datos = $Mprima->get_Mprima_por_id($_POST["id_Mprima"]);

    // si existe el id de la categoria entonces recorre el array
    if (is_array($datos) == true and count($datos) > 0) {

      //edita el estado de la categoria
      $Mprima->editar_estado($_POST["id_Mprima"], $_POST["est"]);

      //edita el estado del producto

      $productos->editar_estado_producto_por_Mprima($_POST["id_Mprima"], $_POST["est"]);
    }

    break;


  case "listar":

    $datos = $Mprima->get_Mprima();

    //Vamos a declarar un array
    $data = array();

    foreach ($datos as $row) {
      $sub_array = array();

      //ESTADO
      $est = '';

      $atrib = "btn btn-success btn-md estado";
      if ($row["estado"] == 0) {
        $est = 'INACTIVO';
        $atrib = "btn btn-warning btn-md estado";
      } else {
        if ($row["estado"] == 1) {
          $est = 'ACTIVO';
        }
      }

      $stock = "";

      if ($row["stock"] <= 10) {

        $stock = $row["stock"];
        $atributo = "badge bg-red-active";
      } else {

        $stock = $row["stock"];
        $atributo = "badge bg-green";
      }


      //moneda

      $moneda = $row["moneda"];



      $unidad = '';

      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 0) {
        $unidadm = 'Bidon';
        $uni = "btn btn-success btn-md unidadm";
      }

      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 1) {
        $unidadm = 'Bolsa';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 2) {
        $unidadm = 'Tiempo';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 3) {
        $unidadm = 'Caja';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 4) {
        $unidadm = 'Paquete';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 5) {
        $unidadm = 'Fardo';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 6) {
        $unidadm = 'Galon';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 7) {
        $unidadm = 'Lata';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 8) {
        $unidadm = 'Libra';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 9) {
        $unidadm = 'Litro';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 10) {
        $unidadm = 'Saco';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 11) {
        $unidadm = 'unidad';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 12) {
        $unidadm = 'Termo';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 13) {
        $unidadm = 'Onza';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 14) {
        $unidadm = 'Gramo';
        $uni = "btn btn-success btn-md unidadm";
      }

      $sub_array[] = $row["materiales"];

      $sub_array[] = '' . $unidadm . '';

      $sub_array[] = $moneda . " " . $row["precio"];

      $sub_array[] = '<span class="' . $atributo . '">' . $row["stock"] . '
                  </span>';

      $sub_array[] = '<button type="button" onClick="cambiarEstado(' . $row["id_Mprima"] . ',' . $row["estado"] . ');" name="estado" id="' . $row["id_Mprima"] . '" class="' . $atrib . '">' . $est . '</button>';

      $sub_array[] = '<button type="button" onClick="mostrar(' . $row["id_Mprima"] . ');"  id="' . $row["id_Mprima"] . '" class="btn btn-warning btn-md update"><i class="glyphicon glyphicon-edit"></i> Editar</button>';

      $sub_array[] = '<button type="button" onClick="eliminar(' . $row["id_Mprima"] . ');"  id="' . $row["id_Mprima"] . '" class="btn btn-danger btn-md"><i class="glyphicon glyphicon-edit"></i> Eliminar</button>';

      $data[] = $sub_array;
    }

    $results = array(
      "sEcho" => 1, //Información para el datatables AOR A SI NO SE COMO ACTUar jej jejejs y si me viene a revisar no se que hare
      "iTotalRecords" => count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords" => count($data), //enviamos el total registros a visualizar
      "aaData" => $data
    );
    echo json_encode($results);


    break;



  case "listar_en_Dproducto":

    $datos = $Mprima->get_Mprima();

    //Vamos a declarar un array
    $data = array();

    foreach ($datos as $row) {
      $sub_array = array();

      //ESTADO
      $est = '';

      $atrib = "btn btn-success btn-md estado";
      if ($row["estado"] == 0) {
        $est = 'INACTIVO';
        $atrib = "btn btn-warning btn-md estado";
      } else {
        if ($row["estado"] == 1) {
          $est = 'ACTIVO';
        }
      }

      $stock = "";

      if ($row["stock"] <= 5) {

        $stock = $row["stock"];
        $atributo = "badge bg-red-active";
      } else {

        $stock = $row["stock"];
        $atributo = "badge bg-green";
      }

      $moneda = $row["moneda"];



      $unidad = '';

      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 0) {
        $unidadm = 'Bidon';
        $uni = "btn btn-success btn-md unidadm";
      }

      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 1) {
        $unidadm = 'Bolsa';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 2) {
        $unidadm = 'Tiempo';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 3) {
        $unidadm = 'Caja';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 4) {
        $unidadm = 'Paquete';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 5) {
        $unidadm = 'Fardo';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 6) {
        $unidadm = 'Galon';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 7) {
        $unidadm = 'Lata';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 8) {
        $unidadm = 'Libra';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 9) {
        $unidadm = 'Litro';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 10) {
        $unidadm = 'Saco';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 11) {
        $unidadm = 'unidad';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 12) {
        $unidadm = 'Termo';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 13) {
        $unidadm = 'Onza';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 14) {
        $unidadm = 'Gramo';
        $uni = "btn btn-success btn-md unidadm";
      }

      $sub_array[] = $row["materiales"];

      $sub_array[] = '' . $unidadm . '';

      $sub_array[] = $moneda . " " . $row["precio"];

      $sub_array[] = '<span class="' . $atributo . '">' . $row["stock"] . '
                  </span>';

      $sub_array[] = '<button type="button"  name="estado" id="' . $row["id_Mprima"] . '" class="' . $atrib . '">' . $est . '</button>';

      $sub_array[] = '<button type="button" name="" id="' . $row["id_Mprima"] . '" class="btn btn-primary btn-md " onClick="agregarDetalle(' . $row["id_Mprima"] . ',\'' . $row["materiales"] . '\',' . $row["estado"] . ')"><i class="fa fa-plus"></i> Agregar</button>';

      $data[] = $sub_array;
    }

    $results = array(
      "sEcho" => 1, //Información para el datatables 
      "iTotalRecords" => count($data), //enviamos el total registros al datatable
      "iTotalDisplayRecords" => count($data), //enviamos el total registros a visualizar
      "aaData" => $data
    );
    echo json_encode($results);


    break;

  case "buscar_Mprima";

    $datos = $Mprima->get_Mprima_por_id_estado($_POST["id_Mprima"], $_POST["estado"]);

    /*comprobamos que el producto esté activo, de lo contrario no lo agrega*/
    if (is_array($datos) == true and count($datos) > 0) {

      foreach ($datos as $row) {

        $unidad = '';

        $uni = "btn btn-success btn-md unidadm";
        if ($row["unidadm"] == 0) {
          $unidadm = 'Bidon';
          $uni = "btn btn-success btn-md unidadm";
        }

        $uni = "btn btn-success btn-md unidadm";
        if ($row["unidadm"] == 1) {
          $unidadm = 'Bolsa';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if ($row["unidadm"] == 2) {
          $unidadm = 'Tiempo';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if ($row["unidadm"] == 3) {
          $unidadm = 'Caja';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if ($row["unidadm"] == 4) {
          $unidadm = 'Paquete';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if ($row["unidadm"] == 5) {
          $unidadm = 'Fardo';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if ($row["unidadm"] == 6) {
          $unidadm = 'Galon';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if ($row["unidadm"] == 7) {
          $unidadm = 'Lata';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if ($row["unidadm"] == 8) {
          $unidadm = 'Libra';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if ($row["unidadm"] == 9) {
          $unidadm = 'Litro';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if ($row["unidadm"] == 10) {
          $unidadm = 'Saco';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if ($row["unidadm"] == 11) {
          $unidadm = 'unidad';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if ($row["unidadm"] == 12) {
          $unidadm = 'Termo';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if ($row["unidadm"] == 13) {
          $unidadm = 'Onza';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if ($row["unidadm"] == 14) {
          $unidadm = 'Gramo';
          $uni = "btn btn-success btn-md unidadm";
        }

        $output["id_Mprima"] = $row["id_Mprima"];
        $output["materiales"] = $row["materiales"];
        $output["unidadm"] = $row["unidadm"];
        $output["moneda"] = $row["moneda"];
        $output["precio"] = $row["precio"];
        $output["stock"] = $row["stock"];
        $output["estado"] = $row["estado"];
      }


      //echo json_encode($output);


    } else {

      //si no existe el registro entonces no recorre el array
      $output["error"] = "Costo de Fabricacion seleccionado está inactivo, intenta con otro";
    }

    echo json_encode($output);

    break;

  case "registrar_Dproducto";

    //se llama al modelo Compras.php

    require_once('../modelos/Dproducto.php');

    $Dproducto = new Dproducto();

    $Dproducto->agrega_detalle_Dproducto();



    break;

    //TODO: COMIENZO DE INGRESO DE DE MATERIA PRIMA A LA PARTE DE ACTUALIZAR

    case "listar_en_actualizar":

      $datos = $Mprima->get_Mprima();
  
      //Vamos a declarar un array
      $data = array();
  
      foreach ($datos as $row) {
        $sub_array = array();
  
        //ESTADO
        $est = '';
  
        $atrib = "btn btn-success btn-md estado";
        if ($row["estado"] == 0) {
          $est = 'INACTIVO';
          $atrib = "btn btn-warning btn-md estado";
        } else {
          if ($row["estado"] == 1) {
            $est = 'ACTIVO';
          }
        }
  
        $stock = "";
  
        if ($row["stock"] <= 5) {
  
          $stock = $row["stock"];
          $atributo = "badge bg-red-active";
        } else {
  
          $stock = $row["stock"];
          $atributo = "badge bg-green";
        }
  
        $moneda = $row["moneda"];
  
  
  
        $unidad = '';
  
        $uni = "btn btn-success btn-md unidadm";
        if ($row["unidadm"] == 0) {
          $unidadm = 'Bidon';
          $uni = "btn btn-success btn-md unidadm";
        }
  
        $uni = "btn btn-success btn-md unidadm";
        if ($row["unidadm"] == 1) {
          $unidadm = 'Bolsa';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if ($row["unidadm"] == 2) {
          $unidadm = 'Tiempo';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if ($row["unidadm"] == 3) {
          $unidadm = 'Caja';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if ($row["unidadm"] == 4) {
          $unidadm = 'Paquete';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if ($row["unidadm"] == 5) {
          $unidadm = 'Fardo';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if ($row["unidadm"] == 6) {
          $unidadm = 'Galon';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if ($row["unidadm"] == 7) {
          $unidadm = 'Lata';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if ($row["unidadm"] == 8) {
          $unidadm = 'Libra';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if ($row["unidadm"] == 9) {
          $unidadm = 'Litro';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if ($row["unidadm"] == 10) {
          $unidadm = 'Saco';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if ($row["unidadm"] == 11) {
          $unidadm = 'unidad';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if ($row["unidadm"] == 12) {
          $unidadm = 'Termo';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if ($row["unidadm"] == 13) {
          $unidadm = 'Onza';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if ($row["unidadm"] == 14) {
          $unidadm = 'Gramo';
          $uni = "btn btn-success btn-md unidadm";
        }
  
        $sub_array[] = $row["materiales"];
  
        $sub_array[] = '' . $unidadm . '';
  
        $sub_array[] = $moneda . " " . $row["precio"];
  
        $sub_array[] = '<span class="' . $atributo . '">' . $row["stock"] . '
                    </span>';
  
        $sub_array[] = '<button type="button"  name="estado" id="' . $row["id_Mprima"] . '" class="' . $atrib . '">' . $est . '</button>';
  
        $sub_array[] = '<button type="button" name="" id="' . $row["id_Mprima"] . '" class="btn btn-primary btn-md " onClick="agregaractualizar(' . $row["id_Mprima"] . ',\'' . $row["materiales"] . '\',' . $row["estado"] . ')"><i class="fa fa-plus"></i> Agregar</button>';
  
        $data[] = $sub_array;
      }
  
      $results = array(
        "sEcho" => 1, //Información para el datatables 
        "iTotalRecords" => count($data), //enviamos el total registros al datatable
        "iTotalDisplayRecords" => count($data), //enviamos el total registros a visualizar
        "aaData" => $data
      );
      echo json_encode($results);
  
  
      break;
  
    case "buscar_actualizar";
  
      $datos = $Mprima->get_Mprima_por_id_estado($_POST["id_Mprima"], $_POST["estado"]);
  
      /*comprobamos que el producto esté activo, de lo contrario no lo agrega*/
      if (is_array($datos) == true and count($datos) > 0) {
  
        foreach ($datos as $row) {
  
          $unidad = '';
  
          $uni = "btn btn-success btn-md unidadm";
          if ($row["unidadm"] == 0) {
            $unidadm = 'Bidon';
            $uni = "btn btn-success btn-md unidadm";
          }
  
          $uni = "btn btn-success btn-md unidadm";
          if ($row["unidadm"] == 1) {
            $unidadm = 'Bolsa';
            $uni = "btn btn-success btn-md unidadm";
          }
          $uni = "btn btn-success btn-md unidadm";
          if ($row["unidadm"] == 2) {
            $unidadm = 'Tiempo';
            $uni = "btn btn-success btn-md unidadm";
          }
          $uni = "btn btn-success btn-md unidadm";
          if ($row["unidadm"] == 3) {
            $unidadm = 'Caja';
            $uni = "btn btn-success btn-md unidadm";
          }
          $uni = "btn btn-success btn-md unidadm";
          if ($row["unidadm"] == 4) {
            $unidadm = 'Paquete';
            $uni = "btn btn-success btn-md unidadm";
          }
          $uni = "btn btn-success btn-md unidadm";
          if ($row["unidadm"] == 5) {
            $unidadm = 'Fardo';
            $uni = "btn btn-success btn-md unidadm";
          }
          $uni = "btn btn-success btn-md unidadm";
          if ($row["unidadm"] == 6) {
            $unidadm = 'Galon';
            $uni = "btn btn-success btn-md unidadm";
          }
          $uni = "btn btn-success btn-md unidadm";
          if ($row["unidadm"] == 7) {
            $unidadm = 'Lata';
            $uni = "btn btn-success btn-md unidadm";
          }
          $uni = "btn btn-success btn-md unidadm";
          if ($row["unidadm"] == 8) {
            $unidadm = 'Libra';
            $uni = "btn btn-success btn-md unidadm";
          }
          $uni = "btn btn-success btn-md unidadm";
          if ($row["unidadm"] == 9) {
            $unidadm = 'Litro';
            $uni = "btn btn-success btn-md unidadm";
          }
          $uni = "btn btn-success btn-md unidadm";
          if ($row["unidadm"] == 10) {
            $unidadm = 'Saco';
            $uni = "btn btn-success btn-md unidadm";
          }
          $uni = "btn btn-success btn-md unidadm";
          if ($row["unidadm"] == 11) {
            $unidadm = 'unidad';
            $uni = "btn btn-success btn-md unidadm";
          }
          $uni = "btn btn-success btn-md unidadm";
          if ($row["unidadm"] == 12) {
            $unidadm = 'Termo';
            $uni = "btn btn-success btn-md unidadm";
          }
          $uni = "btn btn-success btn-md unidadm";
          if ($row["unidadm"] == 13) {
            $unidadm = 'Onza';
            $uni = "btn btn-success btn-md unidadm";
          }
          $uni = "btn btn-success btn-md unidadm";
          if ($row["unidadm"] == 14) {
            $unidadm = 'Gramo';
            $uni = "btn btn-success btn-md unidadm";
          }
  
          $output["id_Mprima"] = $row["id_Mprima"];
          $output["materiales"] = $row["materiales"];
          $output["unidadm"] = $row["unidadm"];
          $output["moneda"] = $row["moneda"];
          $output["precio"] = $row["precio"];
         
          $output["estado"] = $row["estado"];
        }
  
  
        //echo json_encode($output);
  
  
      } else {
  
        //si no existe el registro entonces no recorre el array
        $output["error"] = "Costo de Fabricacion seleccionado está inactivo, intenta con otro";
      }
  
      echo json_encode($output);
  
      break;

  case "eliminar_Mprima":

    $datos = $Mprima->get_Mprima_por_id($_POST["id_Mprima"]);


    if (is_array($datos) == true and count($datos) > 0) {

      $Mprima->eliminar_Mprima($_POST["id_Mprima"]);

      $messages[] = "Costo de Fabricacion se elimino con exito";
    }





    //prueba mensaje de success


    if (isset($messages)) {

    ?>
      <div class="alert alert-success" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>¡Bien hecho!</strong>
        <?php
        foreach ($messages as $message) {
          echo $message;
        }
        ?>
      </div>
    <?php
    }


    //fin mensaje success


    //inicio de mensaje de error

    if (isset($errors)) {

    ?>
      <div class="alert alert-danger" role="alert">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Error!</strong>
        <?php
        foreach ($errors as $error) {
          echo $error;
        }
        ?>
      </div>
<?php
    }

    //fin de mensaje de error

    break;
}




//wilbert palacios 

?>
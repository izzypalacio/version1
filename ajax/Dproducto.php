<?php

//llamo a la conexion de la base de datos 
require_once("../modelos/conexion.php");
//llamo al modelo Compras
require_once("../modelos/Dproducto.php");


$Dproducto = new Dproducto();






//declaramos las variables de los valores que se envian por el formulario y que recibimos por ajax y decimos que si existe el parametro que estamos recibiendo

//los valores vienen del atributo name de los campos del formulario
/*el valor id_usuario y id_categoria se carga en el campo hidden cuando se edita un registro*/
//se copian los campos de la tabla categoria



switch ($_GET["op"]) {


  case "ver_detalle_producto_Dproducto":


    $datos = $Dproducto->get_detalle_producto($_POST["numero_Dproducto"]);

    // si existe el proveedor entonces recorre el array
    if (is_array($datos) == true and count($datos) > 0) {

      foreach ($datos as $row) {
        $output["numero_Dproducto"] = $row["numero_Dproducto"];
        $output["productoc"] = $row["productoc"];
        $output["categoria"] = $row["categoria"];
        $output["rinde"] = $row["rinde"];
        $output["fecha_Dproducto"] = date("d-m-Y", strtotime($row["fecha_Dproducto"]));
      }


      echo json_encode($output);
    } else {

      //si no existe el registro entonces no recorre el array
      $errors[] = "no existe";
    }


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

  case "ver_detalle_Dproducto":

    $datos = $Dproducto->get_detalle_Dproducto_producto($_POST["numero_Dproducto"]);

    break;

  case "ver_detalle_Dproducto":

    $datos = $Dproducto->get_detalle($_POST["numero_Dproducto"]);


    break;


  case "buscar_Dproducto":

    $datos = $Dproducto->get_Dproducto();

    //Vamos a declarar un array
    $data = array();

    foreach ($datos as $row) {
      $sub_array = array();

      $est = '';

      $atrib = "btn btn-danger btn-md estado";
      if ($row["estado"] == 1) {
        $est = 'ACTIVO';
        $atrib = "btn btn-success btn-md estado";
      } else {
        if ($row["estado"] == 0) {
          $est = 'INACTIVO';
        }
      }



      $sub_array[] = '<button class="btn btn-warning detalle"  id="' . $row["numero_Dproducto"] . '"  data-toggle="modal" data-target="#detalle_Dproducto"><i class="fa fa-eye"></i></button>';
      $sub_array[] = date("d-m-Y", strtotime($row["fecha_Dproducto"]));
      $sub_array[] = $row["numero_Dproducto"];
      $sub_array[] = $row["productoc"];
      $sub_array[] = $row["categoria"];
      $sub_array[] = $row["moneda"] . " " . $row["subtotal"];


      /*IMPORTANTE: poner \' cuando no sea numero, sino no imprime*/
      $sub_array[] = '<button type="button" onClick="cambiarEstado(' . $row["id_Dproducto"] . ',\'' . $row["numero_Dproducto"] . '\',' . $row["estado"] . ');" name="estado" id="' . $row["id_Dproducto"] . '" class="' . $atrib . '">' . $est . '</button>';

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

  case "cambiar_estado_Dproducto":


    $datos = $Dproducto->get_Dproducto_por_id($_POST["id_Dproducto"]);

    // si existe el id de la compra entonces se edita el estado del detalle de la compra
    if (is_array($datos) == true and count($datos) > 0) {

      //cambia el estado de la compra
      $Dproducto->cambiar_estado($_POST["id_Dproducto"], $_POST["numero_Dproducto"], $_POST["est"]);
    }


    break;

  case "buscar_Dproducto_fecha":

    $datos = $Dproducto->lista_busca_registros_fecha($_POST["fecha_inicial"], $_POST["fecha_final"]);

    //Vamos a declarar un array
    $data = array();

    foreach ($datos as $row) {
      $sub_array = array();

      $est = '';

      $atrib = "btn btn-danger btn-md estado";
      if ($row["estado"] == 1) {
        $est = 'ACTIVO';
        $atrib = "btn btn-success btn-md estado";
      } else {
        if ($row["estado"] == 0) {
          $est = 'INACTIVO';
        }
      }



      $sub_array[] = '<button class="btn btn-warning detalle" id="' . $row["numero_Dproducto"] . '"  data-toggle="modal" data-target="#detalle_Dproducto"><i class="fa fa-eye"></i></button>';



      $sub_array[] = date("d-m-Y", strtotime($row["fecha_Dproducto"]));
      $sub_array[] = $row["numero_Dproducto"];
      $sub_array[] = $row["productoc"];
      $sub_array[] = $row["categoria"];
      $sub_array[] = $row["moneda"] . " " . $row["total"];


      /*IMPORTANTE: poner \' cuando no sea numero, sino no imprime*/
      $sub_array[] = '<button type="button" onClick="cambiarEstado(' . $row["id_Dproducto"] . ',\'' . $row["numero_Dproducto"] . '\',' . $row["estado"] . ');" name="estado" id="' . $row["id_Dproducto"] . '" class="' . $atrib . '">' . $est . '</button>';

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


  case "buscar_Dproducto_fecha_mes":


    $datos = $Dproducto->lista_busca_registros_fecha_mes($_POST["mes"], $_POST["ano"]);


    //Vamos a declarar un array
    $data = array();

    foreach ($datos as $row) {
      $sub_array = array();

      $est = '';
      //$atrib = 'activo';
      $atrib = "btn btn-danger btn-md estado";
      if ($row["estado"] == 1) {
        $est = 'ACTIVO';
        $atrib = "btn btn-success btn-md estado";
      } else {
        if ($row["estado"] == 0) {
          $est = 'INACTIVO';
          //$atrib = '';
        }
      }



      $sub_array[] = '<button class="btn btn-warning detalle" id="' . $row["numero_Dproducto"] . '"  data-toggle="modal" data-target="#detalle_Dproducto"><i class="fa fa-eye"></i></button>';

      $sub_array[] = date("d-m-Y", strtotime($row["fecha_Dproducto"]));

      $sub_array[] = $row["numero_Dproducto"];
      $sub_array[] = $row["productoc"];
      $sub_array[] = $row["categoria"];
      $sub_array[] = $row["moneda"] . " " . $row["total"];


      /*IMPORTANTE: poner \' cuando no sea numero, sino no imprime*/
      $sub_array[] = '<button type="button" onClick="cambiarEstado(' . $row["id_Dproducto"] . ',\'' . $row["numero_Dproducto"] . '\',' . $row["estado"] . ');" name="estado" id="' . $row["id_Dproducto"] . '" class="' . $atrib . '">' . $est . '</button>';

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

    //TODO: desde aca es la parte de el modal de la tabla de dproducto


  case "lista_Dproducto":

    $datos = $Dproducto->get_DproductoB();

    //Vamos a declarar un array
    $data = array();

    foreach ($datos as $row) {
      $sub_array = array();

      $est = '';

      $atrib = "btn btn-danger btn-md estado";
      if ($row["estado"] == 1) {
        $est = 'ACTIVO';
        $atrib = "btn btn-success btn-md estado";
      } else {
        if ($row["estado"] == 0) {
          $est = 'INACTIVO';
        }
      }





      $sub_array[] = $row["numero_Dproducto"];
      $sub_array[] = $row["productoc"];

      $sub_array[] = '<input type="number" name="Nbatida" id="Nbatida" onchange="javascript: GNbatida=this.value" class="form-control"  />';

      $sub_array[] = '<input value="0.35" type="number" name="margenu" id="margenu" class="form-control"  />';
      /*$sub_array[] = date("d-m-Y", strtotime($row["fecha_Dproducto"]));
         $sub_array[] = $row["categoria"];*/
      /*$sub_array[] = $row["moneda"]." ".$row["total"];*/
      /*$sub_array[] = '<button class="btn btn-warning detalle"  id="'.$row["numero_Dproducto"].'"  data-toggle="modal" data-target="#detalle_Dproducto"><i class="fa fa-eye"></i></button>';*/


      /*IMPORTANTE: poner \' cuando no sea numero, sino no imprime*/
      $sub_array[] = '<button type="button" onClick="cambiarEstado(' . $row["id_Dproducto"] . ',\'' . $row["numero_Dproducto"] . '\',' . $row["estado"] . ');" name="estado" id="' . $row["id_Dproducto"] . '" class="' . $atrib . '">' . $est . '</button>';




      $sub_array[] = '<button type="button" name="" id="' . $row["numero_Dproducto"] . '" class="btn btn-primary btn-md "onClick="agregarDetalleB(' . $row["id_Dproducto"] . ',\'' . $row["materiales"] . '\',' . $row["estado"] . ')"><i class="fa fa-plus"></i> Agregar</button>';



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

  case "buscar_DproductoB";
    // Define un arreglo para devolver correctamente la información
    $data = ['error' => '', 'datos' => []];
    // Actualiza la propiedad "datos"
    $data['datos'] = $Dproducto->get_DproductoP($_POST["id_Dproducto"], $_POST["estado"]);
    // Si no hay resultados, marcar como error
    if (!is_array($data['datos']) || count($data['datos']) == 0) {
      $data["error"] = 'La formula está inactiva, intenta con otro';
    }
    // Devuelve un objeto con dos propiedades:
    // error = cadena vacía o mensaje de error
    // datos = arreglo vacío o datos obtenidos de la consulta
    echo json_encode($data);

    break;



  case "registrar_Batida";

    //se llama al modelo Compras.php

    require_once('../modelos/Batida.php');

    $Batida = new Batida();

    $Batida->agrega_detalle_Batida();

    break;

//TODO: update a formulas 

  case "lista_formula":

    $datos = $Dproducto->get_DproductoB();

    //Vamos a declarar un array
    $data = array();

    foreach ($datos as $row) {
      $sub_array = array();

      $est = '';

      $atrib = "btn btn-danger btn-md estado";
      if ($row["estado"] == 1) {
        $est = 'ACTIVO';
        $atrib = "btn btn-success btn-md estado";
      } else {
        if ($row["estado"] == 0) {
          $est = 'INACTIVO';
        }
      }

      $sub_array[] = $row["numero_Dproducto"];
      $sub_array[] = $row["productoc"];
      //:TODO: BOTON EXTRA QUITAR CUANDO SE UNAN LAS DOS FUNCIONES
      $sub_array[] = '<button type="button" onClick="agregarformulaf(' . $row["id_Dproducto"] . ',' . $row["estado"] . ');" id="' . $row["id_Dproducto"] . '" class="btn btn-primary btn-md"><i class="fa fa-plus" aria-hidden="true"></i> Agregar</button>';
    
      $sub_array[] = '<button type="button" name="" id="' . $row["numero_Dproducto"] . '" class="btn btn-primary btn-md "onClick="agregarformula(' . $row["id_Dproducto"] . ',\'' . $row["materiales"] . '\',' . $row["estado"] . ')"><i class="fa fa-plus"></i> Agregar</button>';
      
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

  case "buscar_formula";
    // Define un arreglo para devolver correctamente la información
    $data = ['error' => '', 'datos' => []];
    // Actualiza la propiedad "datos"
    $data['datos'] = $Dproducto->get_formula($_POST["id_Dproducto"], $_POST["estado"]);
    // Si no hay resultados, marcar como error
    if (!is_array($data['datos']) || count($data['datos']) == 0) {
      $data["error"] = 'La formula está inactiva, intenta con otro';
    }
    // Devuelve un objeto con dos propiedades:
    // error = cadena vacía o mensaje de error
    // datos = arreglo vacío o datos obtenidos de la consulta
    echo json_encode($data);

    break;

    case "buscar_fproducto";


		$datos = $Dproducto->get_formula_por_id_estado($_POST["id_Dproducto"], $_POST["est"]);


		// comprobamos que el proveedor esté activo, de lo contrario no lo agrega
		if (is_array($datos) == true and count($datos) > 0) {

			foreach ($datos as $row) {
        $output["numero_Dproducto"] = $row["numero_Dproducto"];
				$output["productoc"] = $row["productoc"];
				$output["rinde"] = $row["rinde"];
				$output["categoria"] = $row["categoria"];
				$output["costo"] = $row["costo"];
				$output["estado"] = $row["estado"];
			}
		} else {

			//si no existe el registro entonces no recorre el array

			$output["error"] = "El producto seleccionado está inactivo, intenta con otro";
		}

		echo json_encode($output);

		break;



  case "update_formula";

    //se llama al modelo Compras.php

    require_once('../modelos/Dproducto.php');

    $Dproducto = new Dproducto();

    $Dproducto->agrega_formula();
}
//wilbert palacios 

?>
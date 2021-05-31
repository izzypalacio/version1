<?php

//llamo a la conexion de la base de datos 
require_once("../modelos/conexion.php");
//llamo al modelo Compras
require_once("../modelos/formula.php");


$Dproducto = new Dproducto();

switch ($_GET["op"]) {

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
				$output["categoria"] = $row["id_categoria"];
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
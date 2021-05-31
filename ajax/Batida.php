<?php

//llamo a la conexion de la base de datos 
require_once("../modelos/conexion.php");
//llamo al modelo Compras
require_once("../modelos/Batida.php");


$Batida = new Batida();




//declaramos las variables de los valores que se envian por el formulario y que recibimos por ajax y decimos que si existe el parametro que estamos recibiendo

//los valores vienen del atributo name de los campos del formulario
/*el valor id_usuario y id_categoria se carga en el campo hidden cuando se edita un registro*/
//se copian los campos de la tabla categoria



switch ($_GET["op"]) {


	case "ver_detalle_Dproducto_Batida":


		$datos = $Batida->get_detalle_Dproducto($_POST["numero_Batida"]);

		// si existe el proveedor entonces recorre el array
		if (is_array($datos) == true and count($datos) > 0) {

			foreach ($datos as $row) {


				$output["productoc"] = $row["productoc"];
				$output["numero_Batida"] = $row["numero_Batida"];
				$output["numero_Dproducto"] = $row["numero_Dproducto"];
				$output["categoria"] = $row["categoria"];
				$output["fecha_Batida"] = date("d-m-Y", strtotime($row["fecha_Batida"]));
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

	case "ver_detalle_Batida":

		$datos = $Batida->get_detalle_Batida_Dproducto($_POST["numero_Batida"]);


		break;


	case "buscar_Batida":

		$datos = $Batida->get_Batida();

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



			$sub_array[] = '<button class="btn btn-warning detalle"  id="' . $row["numero_Batida"] . '"  data-toggle="modal" data-target="#detalle_Batida"><i class="fa fa-eye"></i></button>';
			$sub_array[] = date("d-m-Y", strtotime($row["fecha_Batida"]));
			$sub_array[] = $row["numero_Batida"];
			$sub_array[] = $row["productoc"];
			$sub_array[] = $row["moneda"] . " " . $row["totalpro"];


			/*IMPORTANTE: poner \' cuando no sea numero, sino no imprime*/
			$sub_array[] = '<button type="button" onClick="cambiarEstado(' . $row["id_Batida"] . ',\'' . $row["numero_Batida"] . '\',' . $row["estado"] . ');" name="estado" id="' . $row["id_Batida"] . '" class="' . $atrib . '">' . $est . '</button>';

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

	case "cambiar_estado_Batida":


		$datos = $Batida->get_Batida_por_id($_POST["id_Batida"]);

		// si existe el id de la compra entonces se edita el estado del detalle de la compra
		if (is_array($datos) == true and count($datos) > 0) {

			//cambia el estado de la compra
			$Batida->cambiar_estado($_POST["id_Batida"], $_POST["numero_Batida"], $_POST["est"]);
		}


		break;

	case "buscar_Batida_fecha":

		$datos = $Batida->lista_busca_registros_fecha($_POST["fecha_inicial"], $_POST["fecha_final"]);

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



			$sub_array[] = '<button class="btn btn-warning detalle" id="' . $row["numero_Batida"] . '"  data-toggle="modal" data-target="#detalle_Batida"><i class="fa fa-eye"></i></button>';



			$sub_array[] = date("d-m-Y", strtotime($row["fecha_Batida"]));
			$sub_array[] = $row["numero_Batida"];
			$sub_array[] = $row["numero_Dproducto"];
			$sub_array[] = $row["productoc"];
			$sub_array[] = $row["categoria"];
			$sub_array[] = $row["moneda"] . " " . $row["total"];


			/*IMPORTANTE: poner \' cuando no sea numero, sino no imprime*/
			$sub_array[] = '<button type="button" onClick="cambiarEstado(' . $row["id_Batida"] . ',\'' . $row["numero_Batida"] . '\',' . $row["estado"] . ');" name="estado" id="' . $row["id_Batida"] . '" class="' . $atrib . '">' . $est . '</button>';

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


	case "buscar_Batida_fecha_mes":


		$datos = $Batida->lista_busca_registros_fecha_mes($_POST["mes"], $_POST["ano"]);


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



			$sub_array[] = '<button class="btn btn-warning detalle" id="' . $row["numero_Batida"] . '"  data-toggle="modal" data-target="#detalle_Batida"><i class="fa fa-eye"></i></button>';

			$sub_array[] = date("d-m-Y", strtotime($row["fecha_Batida"]));

			$sub_array[] = $row["numero_Batida"];
			$sub_array[] = $row["numero_Dproducto"];
			$sub_array[] = $row["productoc"];
			$sub_array[] = $row["categoria"];
			$sub_array[] = $row["moneda"] . " " . $row["total"];


			/*IMPORTANTE: poner \' cuando no sea numero, sino no imprime*/
			$sub_array[] = '<button type="button" onClick="cambiarEstado(' . $row["id_Batida"] . ',\'' . $row["numero_Batida"] . '\',' . $row["estado"] . ');" name="estado" id="' . $row["id_Batida"] . '" class="' . $atrib . '">' . $est . '</button>';

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
}



//wilbert palacios 
?>

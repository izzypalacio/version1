<?php


//llamo a la conexion de la base de datos 
require_once("../modelos/conexion.php");
//llamo al modelo Categorías
require_once("../modelos/cif.php");

//llamo al modelo Producto
require_once("../modelos/producto.php");

require_once("../modelos/Dproducto.php");


$producto = new producto();

$cif = new cif();

$Dproducto = new Dproducto();



//declaramos las variables de los valores que se envian por el formulario y que recibimos por ajax y decimos que si existe el parametro que estamos recibiendo

//los valores vienen del atributo name de los campos del formulario
/*el valor id_usuario y id_categoria se carga en el campo hidden cuando se edita un registro*/
//se copian los campos de la tabla categoria
$id_cif = isset($_POST["id_cif"]);
$id_usuario = isset($_POST["id_usuario"]);
$planta = isset($_POST["planta"]);
$costo = isset($_POST["costo"]);
$estado = isset($_POST["estado"]);


switch ($_GET["op"]) {


	case "guardaryeditar":


		/*si el id no existe entonces lo registra
	           importante: se debe poner el $_POST sino no funciona*/
		if (empty($_POST["id_cif"])) {

			/*verificamos si existe la categoria en la base de datos, si ya existe un registro con la categoria entonces no se registra*/

			//importante: se debe poner el $_POST sino no funciona
			$datos = $cif->get_nombre_cif($_POST["planta"]);

			if (is_array($datos) == true and count($datos) == 0) {

				//no existe la categoria por lo tanto hacemos el registros

				$cif->registrar_cif($planta, $costo, $estado, $id_usuario);



				$messages[] = ".";
			} //cierre de validacion de $datos 


			/*si ya existes la categoria entonces aparece el mensaje*/ else {

				$errors[] = "La categoría ya existe";
			}
		} //cierre de empty

		else {


			/*si ya existe entonces editamos la categoria*/


			$cif->editar_cif($id_cif, $planta, $costo, $estado, $id_usuario);


			$messages[] = "Cif Correcta";
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
		$datos = $cif->get_cif_por_id($_POST["id_cif"]);


		//verifica si el id_categoria tiene registro asociado a compras



		//valida si el id_categoria  tiene registros asociados en la tabla compras y detalle_compras
		if (is_array($cif) == true and count($cif) == 0) {


			foreach ($datos as $row) {


				$output["planta"] = $row["planta"];
				$output["costo"] = $row["costo"];
				$output["estado"] = $row["estado"];
				$output["id_usuario"] = $row["id_usuario"];
			}
		} else {

			//si el id_categoria tiene relacion con la tabla compras y detalle_compras entonces se deshabilita la categoria


			foreach ($datos as $row) {

				$output["cif_id"] = $row["id_cif"];
				$output["planta"] = $row["planta"];
				$output["costo"] = $row["costo"];
				$output["estado"] = $row["estado"];
				$output["id_usuario"] = $row["id_usuario"];
			}
		} //cierre el else

		echo json_encode($output);


		break;

	case "activarydesactivar":

		//los parametros id_categoria y est vienen por via ajax
		$datos = $cif->get_cif_por_id($_POST["id_cif"]);

		// si existe el id de la categoria entonces recorre el array
		if (is_array($datos) == true and count($datos) > 0) {

			//edita el estado de la categoria
			$cif->editar_estado($_POST["id_cif"], $_POST["est"]);

			//edita el estado del producto

			$producto->editar_estado_producto_por_cif($_POST["id_cif"], $_POST["est"]);
		}

		break;


	case "listar":

		$datos = $cif->get_cif();

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


			$sub_array[] = $row["planta"];
			$sub_array[] = $row["costo"];



			$sub_array[] = '<button type="button" onClick="cambiarEstado(' . $row["id_cif"] . ',' . $row["estado"] . ');" name="estado" id="' . $row["id_cif"] . '" class="' . $atrib . '">' . $est . '</button>';




			$sub_array[] = '<button type="button" onClick="mostrar(' . $row["id_cif"] . ');"  id="' . $row["id_cif"] . '" class="btn btn-warning btn-md update"><i class="glyphicon glyphicon-edit"></i> Editar</button>';

			$sub_array[] = '<button type="button" onClick="eliminar(' . $row["id_cif"] . ');"  id="' . $row["id_cif"] . '" class="btn btn-danger btn-md"><i class="glyphicon glyphicon-edit"></i> Eliminar</button>';

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

	case "eliminar_cif":


		$datos = $cif->get_cif_por_id($_POST["id_cif"]);


		if (is_array($datos) == true and count($datos) > 0) {

			$cif->eliminar_cif($_POST["id_cif"]);

			$messages[] = "CIF se eliminó exitosamente";
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
<?php


//llamo a la conexion de la base de datos 
require_once("../modelos/conexion.php");

//llamo al modelo Producto
require_once("../modelos/producto.php");

require_once("../modelos/Dproducto.php");


$producto = new producto();


//declaramos las variables de los valores que se envian por el formulario y que recibimos por ajax y decimos que si existe el parametro que estamos recibiendo

//los valores vienen del atributo name de los campos del formulario
/*el valor id_usuario y id_categoria se carga en el campo hidden cuando se edita un registro*/
//se copian los campos de la tabla categoria
$id_producto = isset($_POST["id_producto"]);
$id_categoria = isset($_POST["categoria"]);
$id_cif = isset($_POST["planta"]);
$id_usuario = isset($_POST["id_usuario"]);
$productoc = isset($_POST["productoc"]);
$rinde = isset($_POST["rinde"]);
$estado = isset($_POST["estado"]);


switch ($_GET["op"]) {


	case "guardaryeditar":


		/*si el id no existe entonces lo registra
	           importante: se debe poner el $_POST sino no funciona*/
		if (empty($_POST["id_producto"])) {

			/*verificamos si existe la categoria en la base de datos, si ya existe un registro con la categoria entonces no se registra*/

			//importante: se debe poner el $_POST sino no funciona
			$datos = $producto->get_nombre_producto($_POST["productoc"]);

			if (is_array($datos) == true and count($datos) == 0) {

				//no existe la categoria por lo tanto hacemos el registros

				$producto->registrar_producto($productoc, $rinde, $id_categoria, $id_cif, $estado, $id_usuario);



				$messages[] = ".";
			} //cierre de validacion de $datos 


			/*si ya existes la categoria entonces aparece el mensaje*/ else {

				$errors[] = "El producto ya existe";
			}
		} //cierre de empty

		else {


			/*si ya existe entonces editamos la categoria*/


			$producto->editar_producto($id_producto, $productoc, $rinde, $id_categoria, $id_cif, $estado, $id_usuario);


			$messages[] = "Producto Correcto";
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
		$datos = $producto->gett_producto_por_id($_POST["id_producto"]);


		//verifica si el id_categoria tiene registro asociado a compras
		$producto_Dproducto = $producto->get_producto_por_id_Dproducto($_POST["id_producto"]);


		//valida si el id_categoria  tiene registros asociados en la tabla compras y detalle_compras
		if (is_array($producto_Dproducto) == true and count($producto_Dproducto) == 0) {


			foreach ($datos as $row) {

				$output["productoc"] = $row["productoc"];
				$output["rinde"] = $row["rinde"];
				$output["categoria"] = $row["id_categoria"];
				$output["planta"] = $row["id_cif"];
				$output["estado"] = $row["estado"];
				$output["id_usuario"] = $row["id_usuario"];
			}
		} else {

			//si el id_categoria tiene relacion con la tabla compras y detalle_compras entonces se deshabilita la categoria


			foreach ($datos as $row) {

				$output["producto_id"] = $row["id_producto"];
				$output["productoc"] = $row["productoc"];
				$output["rinde"] = $row["rinde"];
				$output["categoria"] = $row["id_categoria"];
				$output["planta"] = $row["id_cif"];
				$output["estado"] = $row["estado"];
				$output["id_usuario"] = $row["id_usuario"];
			}
		} //cierre el else

		echo json_encode($output);


		break;

	case "activarydesactivar":

		//los parametros id_categoria y est vienen por via ajax
		$datos = $producto->gett_producto_por_id($_POST["id_producto"]);

		// si existe el id de la categoria entonces recorre el array
		if (is_array($datos) == true and count($datos) > 0) {

			//edita el estado de la categoria
			$producto->editar_estado($_POST["id_producto"], $_POST["est"]);
		}

		break;


	case "listar":

		$datos = $producto->get_producto();

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


			$sub_array[] = $row["productoc"];
			$sub_array[] = $row["rinde"];
			$sub_array[] = $row["categoria"];
			$sub_array[] = $row["planta"];
			$sub_array[] = date("d-m-Y", strtotime($row["fecha"]));



			$sub_array[] = '<button type="button" onClick="cambiarEstado(' . $row["id_producto"] . ',' . $row["id_categoria"] . ',' . $row["estado"] . ');" name="estado" id="' . $row["id_producto"] . '" class="' . $atrib . '">' . $est . '</button>';




			$sub_array[] = '<button type="button" onClick="mostrar(' . $row["id_producto"] . ');"  id="' . $row["id_producto"] . '" class="btn btn-warning btn-md update"><i class="glyphicon glyphicon-edit"></i> Editar</button>';

			$sub_array[] = '<button type="button" onClick="eliminar(' . $row["id_producto"] . ');"  id="' . $row["id_producto"] . '" class="btn btn-danger btn-md"><i class="glyphicon glyphicon-edit"></i> Eliminar</button>';

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

	case "listar_en_Dproducto":

		$datos = $producto->get_producto();

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


			$sub_array[] = $row["productoc"];
			$sub_array[] = $row["rinde"];
			$sub_array[] = $row["categoria"];
			$sub_array[] = $row["costo"];
			$sub_array[] = date("d-m-Y", strtotime($row["fecha"]));

			$sub_array[] = '<button type="button"  name="estado" id="' . $row["id_producto"] . '" class="' . $atrib . '">' . $est . '</button>';



			$sub_array[] = '<button type="button" onClick="agregar_registro(' . $row["id_producto"] . ',' . $row["estado"] . ');" id="' . $row["id_producto"] . '" class="btn btn-primary btn-md"><i class="fa fa-plus" aria-hidden="true"></i> Agregar</button>';



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

	case "buscar_producto";


		$datos = $producto->get_producto_por_id_estado($_POST["id_producto"], $_POST["est"]);


		// comprobamos que el proveedor esté activo, de lo contrario no lo agrega
		if (is_array($datos) == true and count($datos) > 0) {

			foreach ($datos as $row) {
				$output["productoc"] = $row["productoc"];
				$output["rinde"] = $row["rinde"];
				$output["categoria"] = $row["id_categoria"];
				$output["costo"] = $row["costo"];
				$output["fecha"] = $row["fecha"];
				$output["estado"] = $row["estado"];
			}
		} else {

			//si no existe el registro entonces no recorre el array

			$output["error"] = "El producto seleccionado está inactivo, intenta con otro";
		}

		echo json_encode($output);

		break;





	case "eliminar_producto":


		$datos = $producto->gett_producto_por_id($_POST["id_producto"]);


		if (is_array($datos) == true and count($datos) > 0) {

			$producto->eliminar_producto($_POST["id_producto"]);

			$messages[] = "El producto se elimino exitosamente";
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
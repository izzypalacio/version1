 <?php


	//llamo a la conexion de la base de datos 
	require_once("../modelos/conexion.php");
	//llamo al modelo Categorías
	require_once("../modelos/Cfabricacion.php");

	//llamo al modelo Producto
	require_once("../modelos/producto.php");

	$producto = new producto();

	$Cfabricacion = new Cfabricacion();





	//declaramos las variables de los valores que se envian por el formulario y que recibimos por ajax y decimos que si existe el parametro que estamos recibiendo

	//los valores vienen del atributo name de los campos del formulario
	/*el valor id_usuario y id_categoria se carga en el campo hidden cuando se edita un registro*/
	//se copian los campos de la tabla categoria
	$id_Cfabricacion = isset($_POST["id_Cfabricacion"]);
	$id_usuario = isset($_POST["id_usuario"]);
	$servicios = isset($_POST["servicios"]);
	$unidadm = isset($_POST["unidadm"]);
	$tiempo = isset($_POST["tiempo"]);
	$porcentaje = isset($_POST["porcentaje"]);
	$costos = isset($_POST["costos"]);
	$estado = isset($_POST["estado"]);


	switch ($_GET["op"]) {


		case "guardaryeditar":


			/*si el id no existe entonces lo registra
	           importante: se debe poner el $_POST sino no funciona*/
			if (empty($_POST["id_Cfabricacion"])) {

				/*verificamos si existe la categoria en la base de datos, si ya existe un registro con la categoria entonces no se registra*/

				//importante: se debe poner el $_POST sino no funciona
				$datos = $Cfabricacion->get_nombre_Cfabricacion($_POST["servicios"]);

				if (is_array($datos) == true and count($datos) == 0) {

					//no existe la categoria por lo tanto hacemos el registros

					$Cfabricacion->registrar_Cfabricacion($servicios, $unidadm, $tiempo, $porcentaje, $costos, $estado, $id_usuario);



					$messages[] = ".";
				} //cierre de validacion de $datos 


				/*si ya existes la categoria entonces aparece el mensaje*/ else {

					$errors[] = "Los Costos de fabricacion ya existe";
				}
			} //cierre de empty

			else {


				/*si ya existe entonces editamos la categoria*/


				$Cfabricacion->editar_Cfabricacion($id_Cfabricacion, $servicios, $unidadm, $tiempo, $porcentaje, $costos, $estado, $id_usuario);


				$messages[] = "Costos de fabricacion Correctos";
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
			$datos = $Cfabricacion->get_Cfabricacion_por_id($_POST["id_Cfabricacion"]);


			//verifica si el id_categoria tiene registro asociado a compras
			$Cfabricacion_compras = $Cfabricacion->get_Cfabricacion_por_id_compras($_POST["id_Cfabricacion"]);


			//verifica si el id_categoria tiene registro asociado a detalle_compras
			$Cfabricacion_detalle_compras = $Cfabricacion->get_Cfabricacion_por_id_detalle_compras($_POST["id_Cfabricacion"]);


			//valida si el id_categoria  tiene registros asociados en la tabla compras y detalle_compras
			if (is_array($Cfabricacion_compras) == true and count($Cfabricacion_compras) == 0 and is_array($Cfabricacion_detalle_compras) == true and count($Cfabricacion_detalle_compras) == 0) {


				foreach ($datos as $row) {
					$output["servicios"] = $row["servicios"];
					$output["unidadm"] = $row["unidadm"];
					$output["tiempo"] = $row["tiempo"];
					$output["porcentaje"] = $row["porcentaje"];
					$output["costos"] = $row["costos"];
					$output["estado"] = $row["estado"];
					$output["id_usuario"] = $row["id_usuario"];
				}
			} else {

				//si el id_categoria tiene relacion con la tabla compras y detalle_compras entonces se deshabilita la categoria


				foreach ($datos as $row) {

					$output["Cfabricacion_id"] = $row["id_Cfabricacion"];
					$output["servicios"] = $row["servicios"];
					$output["unidadm"] = $row["unidadm"];
					$output["tiempo"] = $row["tiempo"];
					$output["porcentaje"] = $row["porcentaje"];
					$output["costos"] = $row["costos"];
					$output["estado"] = $row["estado"];
					$output["id_usuario"] = $row["id_usuario"];
				}
			} //cierre el else

			echo json_encode($output);


			break;

		case "activarydesactivar":

			//los parametros id_categoria y est vienen por via ajax
			$datos = $Cfabricacion->get_Cfabricacion_por_id($_POST["id_Cfabricacion"]);

			// si existe el id de la categoria entonces recorre el array
			if (is_array($datos) == true and count($datos) > 0) {

				//edita el estado de la categoria
				$Cfabricacion->editar_estado($_POST["id_Cfabricacion"], $_POST["est"]);

				//edita el estado del producto

				$productos->editar_estado_producto_por_Cfabricacion($_POST["id_Cfabricacion"], $_POST["est"]);
			}

			break;


		case "listar":

			$datos = $Cfabricacion->get_Cfabricacion();

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

				$unidad = '';

				$uni = "btn btn-success btn-md unidadm";
				if ($row["unidadm"] == 0) {
					$unidadm = 'porcentaje';
					$uni = "btn btn-success btn-md unidadm";
				}

				$uni = "btn btn-success btn-md unidadm";
				if ($row["unidadm"] == 1) {
					$unidadm = 'tiempo';
					$uni = "btn btn-success btn-md unidadm";
				}


				$sub_array[] = $row["servicios"];

				$sub_array[] = '' . $unidadm . '';
				$sub_array[] = $row["tiempo"];
				$sub_array[] = $row["porcentaje"];

				$sub_array[] = $row["costos"];



				$sub_array[] = '<button type="button" onClick="cambiarEstado(' . $row["id_Cfabricacion"] . ',' . $row["estado"] . ');" name="estado" id="' . $row["id_Cfabricacion"] . '" class="' . $atrib . '">' . $est . '</button>';




				$sub_array[] = '<button type="button" onClick="mostrar(' . $row["id_Cfabricacion"] . ');"  id="' . $row["id_Cfabricacion"] . '" class="btn btn-warning btn-md update"><i class="glyphicon glyphicon-edit"></i> Editar</button>';

				$sub_array[] = '<button type="button" onClick="eliminar(' . $row["id_Cfabricacion"] . ');"  id="' . $row["id_Cfabricacion"] . '" class="btn btn-danger btn-md"><i class="glyphicon glyphicon-edit"></i> Eliminar</button>';

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

		case "eliminar_Cfabricacion":

			//verificamos si la categoria existe en la tabla producto

			$datos = $producto->get_prod_por_id_Cfabricacion($_POST["id_Cfabricacion"]);


			if (is_array($datos) == true and count($datos) > 0) {


				//si existe la categoria en productos, no lo elimina

				$errors[] = "los costos de fabricacion ya existen en otro modulo";
			} //fin

			else {

				//verificamos si la categoria existe en la base de datos en la tabla categoria, si existe entonces lo elimina

				$datos = $Cfabricacion->get_Cfabricacion_por_id($_POST["id_Cfabricacion"]);


				if (is_array($datos) == true and count($datos) > 0) {

					$Cfabricacion->eliminar_Cfabricacion($_POST["id_Cfabricacion"]);

					$messages[] = "Los costos de fabricacion se eliminaron con exito";
				}
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
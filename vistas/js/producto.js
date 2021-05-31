
var tabla;

var tabla_en_Dproducto;

//Función que se ejecuta al inicio
function init() {

	listar();

	//cuando se da click al boton submit entonces se ejecuta la funcion guardaryeditar(e);
	listar_en_Dproducto();

	$("#producto_form").on("submit", function (e) {

		guardaryeditar(e);
	})

	//cambia el titulo de la ventana modal cuando se da click al boton
	$("#add_button").click(function () {

		//habilita los campos cuando se agrega un registro nuevo ya que cuando se editaba un registro asociado entonces aparecia deshabilitado los campos
		$("#categoria").attr('disabled', false);
		$("#planta").attr('disabled', false);
		$("#producto").attr('disabled', false);

		$(".modal-title").text("Agregar producto");

	});


}


//Función limpiar
/*IMPORTANTE: no limpiar el campo oculto del id_usuario, sino no se registra
la categoria*/
function limpiar() {

	$('#productoc').val("");
	$('#rinde').val("");
	$('#categoria').val("");
	$('#planta').val("");
	$('#datepicker').val("");
	$('#estado').val("");
	$('#id_producto').val("");


}

//Función Listar
function listar() {
	tabla = $('#producto_data').dataTable(
		{
			"aProcessing": true,//Activamos el procesamiento del datatables
			"aServerSide": true,//Paginación y filtrado realizados por el servidor
			dom: 'Bfrtip',//Definimos los elementos del control de tabla
			buttons: [
				'copyHtml5',
				'excelHtml5',
				'csvHtml5',
				'pdf'
			],
			"ajax":
			{
				url: '../ajax/producto.php?op=listar',
				type: "get",
				dataType: "json",
				error: function (e) {
					console.log(e.responseText);
				}
			},
			"bDestroy": true,
			"responsive": true,
			"bInfo": true,
			"iDisplayLength": 10,//Por cada 10 registros hace una paginación
			"order": [[0, "desc"]],//Ordenar (columna,orden)

			"language": {

				"sProcessing": "Procesando...",

				"sLengthMenu": "Mostrar _MENU_ registros",

				"sZeroRecords": "No se encontraron resultados",

				"sEmptyTable": "Ningún dato disponible en esta tabla",

				"sInfo": "Mostrando un total de _TOTAL_ registros",

				"sInfoEmpty": "Mostrando un total de 0 registros",

				"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",

				"sInfoPostFix": "",

				"sSearch": "Buscar:",

				"sUrl": "",

				"sInfoThousands": ",",

				"sLoadingRecords": "Cargando...",

				"oPaginate": {

					"sFirst": "Primero",

					"sLast": "Último",

					"sNext": "Siguiente",

					"sPrevious": "Anterior"

				},

				"oAria": {

					"sSortAscending": ": Activar para ordenar la columna de manera ascendente",

					"sSortDescending": ": Activar para ordenar la columna de manera descendente"

				}

			}//cerrando language

		}).DataTable();
}

//Mostrar datos de la categoria en la ventana modal 
function mostrar(id_producto) {
	$.post("../ajax/producto.php?op=mostrar", { id_producto: id_producto }, function (data, status) {
		data = JSON.parse(data);

		//alert(data.dui);
		console.log(data);

		//si existe la categoria_id entonces tiene relacion con otras tablas
		if (data.producto_id) {

			$('#productoModal').modal('show');

			$('#productoc').val(data.productoc);

			//desactiva el campo
			$("#productoc").attr('disabled', 'disabled');

			$('#rinde').val(data.rinde);

			//desactiva el campo
			$("#rinde").attr('disabled', 'disabled');

			$('#categoria').val(data.categoria);

			$("#categoria").attr('disabled', 'disabled');

			$('#planta').val(data.planta);

			$("#planta").attr('disabled', 'disabled');
			$('#datepicker').val(data.fecha);
			$('#estado').val(data.estado);
			$('.modal-title').text("Editar producto");
			$('#id_producto').val(id_producto);




		} else {

			$('#productoModal').modal('show');

			$('#productoc').val(data.productoc);

			//desactiva el campo
			$("#productoc").attr('disabled', false);

			$('#rinde').val(data.rinde);

			//desactiva el campo
			$("#rinde").attr('disabled', false);

			$('#categoria').val(data.categoria);

			//desactiva el campo
			$("#categoria").attr('disabled', false);

			$('#planta').val(data.planta);

			//desactiva el campo
			$("#planta").attr('disabled', false);
			$('#datepicker').val(data.fecha);
			$('#estado').val(data.estado);
			$('.modal-title').text("Editar producto");
			$('#id_producto').val(id_producto);


		}



	});


}


//la funcion guardaryeditar(e); se llama cuando se da click al boton submit
function guardaryeditar(e) {
	e.preventDefault(); //No se activará la acción predeterminada del evento
	var formData = new FormData($("#producto_form")[0]);


	$.ajax({
		url: "../ajax/producto.php?op=guardaryeditar",
		type: "POST",
		data: formData,
		contentType: false,
		processData: false,

		success: function (datos) {
			/*bootbox.alert(datos);	          
			mostrarform(false);
			tabla.ajax.reload();*/

			//alert(datos);

			/*imprimir consulta en la consola debes hacer un print_r($_POST) al final del metodo 
			   y si se muestran los valores es que esta bien, y se puede imprimir la consulta desde el metodo
			   y se puede ver en la consola o desde el mensaje de alerta luego pegar la consulta en phpmyadmin*/
			console.log(datos);

			$('#producto_form')[0].reset();
			$('#productoModal').modal('hide');

			$('#resultados_ajax').html(datos);
			$('#producto_data').DataTable().ajax.reload();

			limpiar();

		}

	});

}


//EDITAR ESTADO DE LA CATEGORIA
//importante:id_categoria, est se envia por post via ajax


function cambiarEstado(id_producto, id_categoria, est) {


	bootbox.confirm("¿Está Seguro de cambiar de estado?", function (result) {
		if (result) {


			$.ajax({
				url: "../ajax/producto.php?op=activarydesactivar",
				method: "POST",
				//data:dataString,
				//toma el valor del id y del estado
				data: { id_producto: id_producto, id_categoria: id_categoria, est: est },
				//cache: false,
				//dataType:"html",
				success: function (data) {

					$('#producto_data').DataTable().ajax.reload();

				}

			});

		}

	});//bootbox



}

//Función Listar
function listar_en_Dproducto() {

	tabla_en_Dproducto = $('#lista_producto_data').dataTable(
		{
			"aProcessing": true,//Activamos el procesamiento del datatables
			"aServerSide": true,//Paginación y filtrado realizados por el servidor
			dom: 'Bfrtip',//Definimos los elementos del control de tabla
			buttons: [
				'copyHtml5',
				'excelHtml5',
				'csvHtml5',
				'pdf'
			],
			"ajax":
			{
				url: '../ajax/producto.php?op=listar_en_Dproducto',
				type: "get",
				dataType: "json",
				error: function (e) {
					console.log(e.responseText);
				}
			},
			"bDestroy": true,
			"responsive": true,
			"bInfo": true,
			"iDisplayLength": 10,//Por cada 10 registros hace una paginación
			"order": [[0, "desc"]],//Ordenar (columna,orden)

			"language": {

				"sProcessing": "Procesando...",

				"sLengthMenu": "Mostrar _MENU_ registros",

				"sZeroRecords": "No se encontraron resultados",

				"sEmptyTable": "Ningún dato disponible en esta tabla",

				"sInfo": "Mostrando un total de _TOTAL_ registros",

				"sInfoEmpty": "Mostrando un total de 0 registros",

				"sInfoFiltered": "(filtrado de un total de _MAX_ registros)",

				"sInfoPostFix": "",

				"sSearch": "Buscar:",

				"sUrl": "",

				"sInfoThousands": ",",

				"sLoadingRecords": "Cargando...",

				"oPaginate": {

					"sFirst": "Primero",

					"sLast": "Último",

					"sNext": "Siguiente",

					"sPrevious": "Anterior"

				},

				"oAria": {

					"sSortAscending": ": Activar para ordenar la columna de manera ascendente",

					"sSortDescending": ": Activar para ordenar la columna de manera descendente"

				}

			}//cerrando language

		}).DataTable();
}


//AUTOCOMPLETAR DATOS DEL PROVEEDOR EN COMPRAS


function agregar_registro(id_producto, est) {


	$.ajax({
		url: "../ajax/producto.php?op=buscar_producto",
		method: "POST",
		data: { id_producto: id_producto, est: est },
		dataType: "json",
		success: function (data) {


			/*si el proveedor esta activo entonces se ejecuta, de lo contrario 
			el formulario no se envia y aparecerá un mensaje */
			if (data.estado) {

				$('#modalproducto').modal('hide');
				$('#productoc').val(data.productoc);
				$('#rinde').val(data.rinde);
				$('#categoria').val(data.categoria);
				$('#costo').val(data.costo);
				$('#datepicker').val(data.fecha);
				$('#id_producto').val(id_producto);


			} else {

				bootbox.alert(data.error);



			} //cierre condicional error



		}
	})

}

//ELIMINAR CATEGORIA

function eliminar(id_producto) {

	//IMPORTANTE: asi se imprime el valor de una funcion

	//alert(categoria_id);


	bootbox.confirm("¿Está Seguro de eliminar el producto?", function (result) {
		if (result) {

			$.ajax({
				url: "../ajax/producto.php?op=eliminar_producto",
				method: "POST",
				data: { id_producto: id_producto },

				success: function (data) {
					//alert(data);
					$("#resultados_ajax").html(data);
					$("#producto_data").DataTable().ajax.reload();
				}
			});

		}

	});//bootbox


}



init();
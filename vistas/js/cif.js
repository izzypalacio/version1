
var tabla;

//Función que se ejecuta al inicio
function init() {

	listar();

	//cuando se da click al boton submit entonces se ejecuta la funcion guardaryeditar(e);
	$("#cif_form").on("submit", function (e) {

		guardaryeditar(e);
	})

	//cambia el titulo de la ventana modal cuando se da click al boton
	$("#add_button").click(function () {

		//habilita los campos cuando se agrega un registro nuevo ya que cuando se editaba un registro asociado entonces aparecia deshabilitado los campos
		$("#cif").attr('disabled', false);

		$(".modal-title").text("Agregar Cif");

	});


}


//Función limpiar
/*IMPORTANTE: no limpiar el campo oculto del id_usuario, sino no se registra
la categoria*/
function limpiar() {

	$('#planta').val("");
	$('#costo').val("");
	$('#estado').val("");
	$('#id_cif').val("");


}

//Función Listar
function listar() {
	tabla = $('#cif_data').dataTable(
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
				url: '../ajax/cif.php?op=listar',
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
function mostrar(id_cif) {
	$.post("../ajax/cif.php?op=mostrar", { id_cif: id_cif }, function (data, status) {
		data = JSON.parse(data);

		//alert(data.dui);


		//si existe la categoria_id entonces tiene relacion con otras tablas
		if (data.cif_id) {

			$('#cifModal').modal('show');
			$('#planta').val(data.planta);

			//desactiva el campo


			$('#costo').val(data.costo);

			//desactiva el campo


			$('#estado').val(data.estado);
			$('.modal-title').text("Editar cif");
			$('#id_cif').val(id_cif);



		} else {

			$('#cifModal').modal('show');
			$('#planta').val(data.planta);

			//desactiva el campo
			$("#planta").attr('disabled', false);

			$('#costo').val(data.costo);

			//desactiva el campo
			$("#costo").attr('disabled', false);

			$('#estado').val(data.estado);
			$('.modal-title').text("Editar cif");
			$('#id_cif').val(id_cif);


		}



	});


}


//la funcion guardaryeditar(e); se llama cuando se da click al boton submit
function guardaryeditar(e) {
	e.preventDefault(); //No se activará la acción predeterminada del evento
	var formData = new FormData($("#cif_form")[0]);


	$.ajax({
		url: "../ajax/cif.php?op=guardaryeditar",
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

			$('#cif_form')[0].reset();
			$('#cifModal').modal('hide');

			$('#resultados_ajax').html(datos);
			$('#cif_data').DataTable().ajax.reload();

			limpiar();

		}

	});

}


//EDITAR ESTADO DE LA CATEGORIA
//importante:id_categoria, est se envia por post via ajax


function cambiarEstado(id_cif, est) {


	bootbox.confirm("¿Está Seguro de cambiar de estado?", function (result) {
		if (result) {


			$.ajax({
				url: "../ajax/cif.php?op=activarydesactivar",
				method: "POST",
				//data:dataString,
				//toma el valor del id y del estado
				data: { id_cif: id_cif, est: est },
				//cache: false,
				//dataType:"html",
				success: function (data) {

					$('#cif_data').DataTable().ajax.reload();

				}

			});

		}

	});//bootbox



}

//ELIMINAR CATEGORIA

function eliminar(id_cif) {

	//IMPORTANTE: asi se imprime el valor de una funcion

	//alert(categoria_id);


	bootbox.confirm("¿Está Seguro de eliminar cif?", function (result) {
		if (result) {

			$.ajax({
				url: "../ajax/cif.php?op=eliminar_cif",
				method: "POST",
				data: { id_cif: id_cif },

				success: function (data) {
					//alert(data);
					$("#resultados_ajax").html(data);
					$("#cif_data").DataTable().ajax.reload();
				}
			});

		}

	});//bootbox


}



init();
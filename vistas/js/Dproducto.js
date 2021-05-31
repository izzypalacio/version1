var tabla;

var tabla_en_Dproducto;

var tabla_en_Batida;

var tabla_en_update;

var tabla_Dproducto_mes;

function init() {

	listar();

	listar_en_Batida();


	$("#Dproducto_form").on("submit", function (e) {

		guardaryeditar(e);
	})

	$("#add_button").click(function () {

		$("#categoria").attr('disabled', false);
		$("#producto").attr('disabled', false);
		$("#detalle_Batida").attr('disabled', false);
		$("#Mprima").attr('disabled', false);
		$("#formula").attr('disabled', false);
		$("#moneda").attr('disabled', false);
		$(".modal-title").text("Agregar Dproducto");

	});
}
//TODO: CALCULO DE NUMERO DE BATIDAS
function listar_en_Batida() {

	tabla_en_Batida = $('#lista_Dproducto_data').dataTable(
		{
			"aProcessing": true,
			"aServerSide": true,
			dom: 'Bfrtip',
			buttons: [
				'copyHtml5',
				'excelHtml5',
				'csvHtml5',
				'pdf'
			],
			"ajax":
			{
				url: '../ajax/Dproducto.php?op=lista_Dproducto',
				type: "get",
				dataType: "json",
				error: function (e) {
					console.log(e.responseText);
				}
			},
			"bDestroy": true,
			"responsive": true,
			"bInfo": true,
			"iDisplayLength": 10,
			"order": [[0, "desc"]],

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

			}

		}).DataTable();
}


// Definir arreglo
let detalles = []

// Petición AJAX
function agregarDetalleB(id_Dproducto, materiales, estado) {
	// Borrar datos anteriores, si es que los hay
	detalles = [];





	$.ajax({
		url: "../ajax/Dproducto.php?op=buscar_DproductoB",
		type: "POST",
		data: { id_Dproducto: id_Dproducto, materiales: materiales, estado: estado },
		dataType: 'json', // jQuery convertirá la respuesta en JSON
		async: true,
		success: function (data) {
			// Solo para comprobar los datos recibidos
			console.log(data);
			// Hubo error?
			if (data.error != '') {
				alert(data.error);
			} else {


				// Asignar datos recibidos a arreglo
				detalles = data.datos;
				// Crear listado
				listarDetallesB();
			}
			$('#modalDproducto').modal("hide");
		}
	});
}


function listarDetallesB() {
	$('#listMpriBatida').html('');
	var filas = "";
	var subtotal = 0;
	var total = 0;
	var subtotalFinal = 0;
	var totalFinal = 0;
	for (var i = 0; i < detalles.length; i++) {
		detalles[i].Nbatida = GNbatida;
		if (typeof detalles[i].Nbatida == 'undefined' || !detalles[i].Nbatida) {
			detalles[i].Nbatida = 1;
		}
		if (detalles[i].estado == 1) {
			var importe = detalles[i].importe = detalles[i].Nbatida * detalles[i].cantidad * detalles[i].precio;
			var cantidad = detalles[i].cantidad = detalles[i].Nbatida * detalles[i].cantidad;
			var rinde = detalles[i].rinde = detalles[i].Nbatida * detalles[i].rinde;
			var costo = detalles[i].costo = detalles[i].rinde * detalles[i].costo;

			margenreal = detalles[i].margenreal;
			margenu = detalles[i].margenu;
			costo = detalles[i].costo;
			rinde = detalles[i].rinde;
			cantidad = detalles[i].cantidad;
			importe = detalles[i].importe;
			var filas = filas + "<tr><td>" + (i + 1) +
				"</td> <td name='materiales[]'>" + detalles[i].materiales + "</td><td name='unidadm[]'>" +
				detalles[i].unidadm + "</td> <td name='precio[]' id='precio[]'>" +
				detalles[i].moneda + " " + detalles[i].precio + "</td> <td> <span name='cantidad[]' id='cantidad" + i +
				"'> " + detalles[i].cantidad + "</span> </td>  <td> <span name='importe[]' id='importe" + i +
				"'>" + detalles[i].moneda + " " + detalles[i].importe +
				"</span> </td> </tr>";
			subtotal = subtotal + importe;
			subtotalFinal = detalles[i].moneda + " " + subtotal;
			var su = subtotal;
			var or = parseFloat(su);
			var total = Math.round(or + subtotal);
			totalFinal = detalles[i].moneda + " " + total;
		}
	}
	$('#listMpriBatida').html(filas);
	$('#subtotal').html(subtotalFinal);
	$('#subtotal_Batida').html(subtotalFinal);
	$('#total').html(totalFinal);
	$('#total_Batida').html(totalFinal);
}


function setNbatida(event, obj, idx) {
	event.preventDefault();
	detalles[idx].Nbatida = parseInt(obj.value);
	recalcular(idx);
}
function recalcular(idx) {
	console.log(detalles[idx].Nbatida);
	console.log((detalles[idx].Nbatida * detalles[idx].cantidad * detalles[idx].precio));
	console.log((detalles[idx].Nbatida * detalles[idx].cantidad));
	// Define variables locales, solo las necesarias para simplificar
	let cantidad = detalles[idx].cantidad * detalles[idx].Nbatida;
	let importe = cantidad * detalles[idx].precio;

	let cantidadReal = cantidad;

	// Modifica los contenedores HTML
	$('#importe' + idx).html(detalles[idx].moneda + ' ' + importe);
	$('#cantidad' + idx).html(cantidad);

	// ¿Necesitas realmente actualizar algo en detalles?
	// Quizá solo el importe
	detalles[idx].importe = importe;

	detalles[idx].cantidadReal = cantidad;

	calcularTotales();
}
function calcularTotales() {
	let subtotal = 0;
	let total = 0;
	let subtotalFinal = 0;
	let totalFinal = 0;
	for (var i = 0; i < detalles.length; i++) {
		if (detalles[i].estado == 1) {
			// Estás sumando y restando lo mismo, no tiene sentido
			// subtotal += (detalles[i].Nbatida * detalles[i].cantidad * detalles[i].precio) - (detalles[i].Nbatida * detalles[i].cantidad * detalles[i].precio);

			// Ya deberías tener un importe en detalles[i]... ¿o no?
			subtotal += detalles[i].importe;

			// Todavía no deberías modificar, solo hasta salir del ciclo
			/*
			subtotalFinal = detalles[i].moneda+" "+subtotal;
			var su = subtotal;
			var or=parseFloat(su);
			var total = Math.round(or+subtotal);
			totalFinal = detalles[i].moneda+" "+total;
			*/
		}
	}
	$('#subtotal').html(detalles[i].moneda + ' ' + subtotal);
	$('#subtotal_Batida').html(detalles[i].moneda + ' ' + subtotal);
	totalFinal = Math.round(subtotal);
	$('#total').html(detalles[i].moneda + ' ' + totalFinal);
	$('#total_Batida').html(detalles[i].moneda + ' ' + totalFinal);
}

function eliminarBa(event, idx) {
	event.preventDefault();
	detalles[idx].estado = 0;
	listarDetallesB();
}

function registrarBatida() {

	var numero_Batida = $("#numero_Batida").val();
	var numero_Dproducto = $("#numero_Dproducto").val();
	var productoc = $("#productoc").val();
	var categoria = $("#categoria").val();
	var Nbatida = $("#Nbatida").val();
	var margenu = $("#margenu").val();
	var margenreal = $("#margenreal").val();
	var totalpro = $("#totalpro").val();
	var preciou = $("#preciou").val();
	var preciout = $("#preciout").val();
	var rinde = $("#rinde").val();
	var costo = $("#costo").val();
	var total = $("#total").html();
	var id_usuario = $("#id_usuario").val();
	var id_producto = $("#id_producto").val();

	if (productoc != "" && detalles != "") {

		console.log('Hola');

		$.ajax({
			url: "../ajax/Dproducto.php?op=registrar_Batida",
			method: "POST",
			data: {
				'arrayBatida': JSON.stringify(detalles),
				'numero_Batida': numero_Batida,
				'numero_Dproducto': numero_Dproducto,
				'productoc': productoc,
				'categoria': categoria,
				'Nbatida': Nbatida,
				'margenu': margenu,
				'margenreal': margenreal,
				'totalpro': totalpro,
				'preciou': preciou,
				'preciout': preciout,
				'rinde': rinde,
				'costo': costo,
				'total': total,
				'id_usuario': id_usuario,
				'id_producto': id_producto
			},
			cache: false,
			dataType: "html",
			error: function (x, y, z) {
				console.log(x);
				console.log(y);
				console.log(z);
			},


			success: function (data) {

				console.log(data);

				var productoc = $("#productoc").val("");
				var categoria = $("#categoria").val("");
				var Nbatida = $("#Nbatida").val("");
				var margenu = $("#margenu").val("");
				var margenreal = $("#margenreal").val("");
				var totalpro = $("#totalpro").val("");
				var preciou = $("#preciou").val("");
				var preciout = $("#preciout").val("");
				var rinde = $("#rinde").val("");
				var costo = $("#costo").val("");
				var subtotal = $("#subtotal").html("");
				var total = $("#total").html("");

				detalles = [];
				$('#listMpriBatida').html('');

				setTimeout("bootbox.alert('Se ha registrado con éxito');", 100);

				setTimeout("explode();", 2000);
			}


		});

	} else {

		bootbox.alert("VACIO");
		return false;
	}

}
function explode() {

	location.reload();
}


//TODO: LISTA DE FORMULA CON DETALLES

function listar() {
	tabla = $('#Dproducto_data').dataTable(
		{
			"aProcessing": true,
			"aServerSide": true,
			dom: 'Bfrtip',
			buttons: [
				'copyHtml5',
				'excelHtml5',
				'csvHtml5',
				'pdf'
			],
			"ajax":
			{
				url: '../ajax/Dproducto.php?op=buscar_Dproducto',
				type: "get",
				dataType: "json",
				error: function (e) {
					console.log(e.responseText);
				}
			},
			"bDestroy": true,
			"responsive": true,
			"bInfo": true,
			"iDisplayLength": 10,
			"order": [[0, "desc"]],

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

			}

		}).DataTable();
}

$(document).on('click', '.detalle', function () {

	var numero_Dproducto = $(this).attr("id");

	$.ajax({
		url: "../ajax/Dproducto.php?op=ver_detalle_producto_Dproducto",
		method: "POST",
		data: { numero_Dproducto: numero_Dproducto },
		cache: false,
		dataType: "json",
		success: function (data) {
			$("#numero_Dproducto").html(data.numero_Dproducto);
			$("#productoc").html(data.productoc);
			$("#categoria").html(data.categoria);
			$("#fecha_Dproducto").html(data.fecha_Dproducto);

		}
	})
});

$(document).on('click', '.detalle', function () {

	var numero_Dproducto = $(this).attr("id");

	$.ajax({
		url: "../ajax/Dproducto.php?op=ver_detalle_Dproducto",
		method: "POST",
		data: { numero_Dproducto: numero_Dproducto },
		cache: false,

		success: function (data) {

			$("#detalles").html(data);

		}
	})
});

function cambiarEstado(id_Dproducto, numero_Dproducto, est) {

	bootbox.confirm("¿Estas seguro que quieres anular esta formula?", function (result) {
		if (result) {

			$.ajax({
				url: "../ajax/Dproducto.php?op=cambiar_estado_Dproducto",
				method: "POST",

				data: { id_Dproducto: id_Dproducto, numero_Dproducto: numero_Dproducto, est: est },
				cache: false,

				success: function (data) {

					$('#Dproducto_data').DataTable().ajax.reload();

					$('#Dproducto_fecha_data').DataTable().ajax.reload();

					$('#Dproducto_fecha_mes_data').DataTable().ajax.reload();

				}

			});

		}

	});


}

$(document).on("click", "#btn_Dproducto_fecha", function () {

	var fecha_inicial = $("#datepicker").val();
	var fecha_final = $("#datepicker2").val();

	if (fecha_inicial != "" && fecha_final != "") {

		tabla_en_Dproducto = $('#Dproducto_fecha_data').DataTable({


			"aProcessing": true,
			"aServerSide": true,
			dom: 'Bfrtip',
			buttons: [
				'copyHtml5',
				'excelHtml5',
				'csvHtml5',
				'pdf'
			],

			"ajax": {
				url: "../ajax/Dproducto.php?op=buscar_Dproducto_fecha",
				type: "post",
				data: { fecha_inicial: fecha_inicial, fecha_final: fecha_final },
				error: function (e) {
					console.log(e.responseText);

				},

			},

			"bDestroy": true,
			"responsive": true,
			"bInfo": true,
			"iDisplayLength": 10,
			"order": [[0, "desc"]],

			"language": {

				"sProcessing": "Procesando...",

				"sLengthMenu": "Mostrar _MENU_ registros",

				"sZeroRecords": "No se encontraron resultados",

				"sEmptyTable": "Ningún dato disponible en esta tabla",

				"sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",

				"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",

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

			},

		});

	}

});

$(document).on("click", "#btn_Dproducto_fecha_mes", function () {

	var mes = $("#mes").val();
	var ano = $("#ano").val();

	if (mes != "" && ano != "") {

		var tabla_Dproducto_mes = $('#Dproducto_fecha_mes_data').DataTable({

			"aProcessing": true,
			"aServerSide": true,
			dom: 'Bfrtip',
			buttons: [
				'copyHtml5',
				'excelHtml5',
				'csvHtml5',
				'pdf'
			],

			"ajax": {
				url: "../ajax/Dproducto.php?op=buscar_Dproducto_fecha_mes",
				type: "post",
				data: { mes: mes, ano: ano },
				error: function (e) {
					console.log(e.responseText);

				},

			},

			"bDestroy": true,
			"responsive": true,
			"bInfo": true,
			"iDisplayLength": 10,
			"order": [[0, "desc"]],

			"language": {

				"sProcessing": "Procesando...",

				"sLengthMenu": "Mostrar _MENU_ registros",

				"sZeroRecords": "No se encontraron resultados",

				"sEmptyTable": "Ningún dato disponible en esta tabla",

				"sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",

				"sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",

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

			},

		});

	}

});

init();
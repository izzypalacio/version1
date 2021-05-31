var tabla_en_Dproducto;

function init() {



	listar_en_update();

	listar_en_actualizar();

	$("#Dproducto_form").on("submit", function (e) {

		guardaryeditar(e);
	})

	$("#add_button").click(function () {

		$("#categoria").attr('disabled', false);
		$("#producto").attr('disabled', false);
		$("#detalle_Batida").attr('disabled', false);
		$("#Mprima").attr('disabled', false);
		$("#detalles").attr('disabled', false);
		$("#moneda").attr('disabled', false);
		$(".modal-title").text("Agregar Dproducto");

	});
}


//TODO: UPDATE ALAS detallesS 

function listar_en_update() {

	tabla_en_update = $('#lista_formula_data').dataTable(
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
				url: '../ajax/Dproducto.php?op=lista_formula',
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

//:TODO: FUNCIONES QUE SE DEBEN UNIR EN UNA SOLA

// Definir arreglo
let detalles = []

function agregarformulaf(id_Dproducto, est) {


	$.ajax({
		url: "../ajax/Dproducto.php?op=buscar_fproducto",
		method: "POST",
		data: { id_Dproducto: id_Dproducto, est: est },
		dataType: "json",
		success: function (data) {

			console.log(data);
			/*si el proveedor esta activo entonces se ejecuta, de lo contrario 
			el formulario no se envia y aparecerá un mensaje */
			if (data.estado) {

				
				$('#numero_Dproducto').val(data.numero_Dproducto);
				$('#productoc').val(data.productoc);
				$('#rinde').val(data.rinde);
				$('#categoria').val(data.categoria);
				$('#costo').val(data.costo);
				$('#id_Dproducto').val(id_Dproducto);


			} else {

				bootbox.alert(data.error);



			} //cierre condicional error



		}
	})

}

// Petición AJAX
function agregarformula(id_Dproducto, materiales, estado) {
	// Borrar datos anteriores, si es que los hay
	detalles = [];





	$.ajax({
		url: "../ajax/Dproducto.php?op=buscar_formula",
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
				listarformula();
			}
			$('#modalformula').modal("hide");
		}
	});
}


function listarformula() {

	$('#listformula').html('');
	var filas = "";
	var subtotal = 0;
	var total = 0;
	var subtotalFinal = 0;
	var totalFinal = 0;
	var step = 0.001;

	for (var i = 0; i < detalles.length; i++) {
		if (detalles[i].estado == 1) {
			var importe = detalles[i].importe = detalles[i].cantidad * detalles[i].precio;
			importe = detalles[i].importe = detalles[i].importe;
			var filas = filas +
				"<tr><td>"+(i+1)+
				"</td><td name='materiales[]'>"+detalles[i].materiales+
				"</td>  <td name='unidadm[]'>"+detalles[i].unidadm+
				"</td><td name='precio[]' id='precio[]'>"+detalles[i].moneda+ " " +detalles[i].precio+
				
				"</td><td><input type='number' step=0.000001 class='form-control' name='cantidad[]'id='cantidad[]'onClick='setCantidad(event, this, " +(i)+ ");' onKeyUp='setCantidad(event, this," +(i)+ ");' value='"+detalles[i].cantidad+
				"'></td><td> <span name='importe[]' id='importe"+i+"'>"+detalles[i].moneda+" "+detalles[i].importe+
				"</span> </td> <td>  <button href='#' class='btn btn-danger btn-lg' role='button' onClick='eliminarMpri(event, "+
				(i)+");' aria-pressed='true'><span class='glyphicon glyphicon-trash'></span> </button></td> </tr>";

			subtotal = subtotal + importe;
			subtotalFinal = detalles[i].moneda+" "+subtotal;
			var su = subtotal;
			var or = parseFloat(su);
			var total = Math.round(or+subtotal);

			totalFinal = detalles[i].moneda+" "+total;



		}

	}

	$('#listformula').html(filas);
	//subtotal
	$('#subtotal').html(subtotalFinal);
	$('#subtotal_formula').html(subtotalFinal);
	//total
	$('#total').html(totalFinal);
	$('#total_formula').html(totalFinal);



}

function setCantidad(event, obj, idx) {
	event.preventDefault();
	detalles[idx].cantidad = parseFloat(obj.value);
	recalcular(idx);
}

function recalcular(idx) {
	console.log(detalles[idx].cantidad);
	console.log((detalles[idx].cantidad * detalles[idx].precio));

	let importe = detalles[idx].importe = detalles[idx].cantidad * detalles[idx].precio;
	importe = detalles[idx].importe = detalles[idx].importe;
	importeFinal = detalles[idx].moneda+" "+importe;
	$('#importe'+idx).html(importeFinal);
	
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
	$('#subtotal').html( subtotal);
	$('#subtotal_formula').html(subtotal);
	totalFinal = Math.round(subtotal);
	$('#total').html(totalFinal);
	$('#total_formula').html( totalFinal);
	console.log(subtotal);
}

function eliminarMpri(event, idx) {
	event.preventDefault();
	detalles[idx].estado = 0;
	listarformula();
}

function registrarformula() {

	var numero_Dproducto = $("#numero_Dproducto").val();
	var productoc = $("#productoc").val();
	var rinde = $("#rinde").val();
  var costo = $("#costo").val();
  var categoria = $("#categoria").val();
	
	var total = $("#total").html();
	var id_usuario = $("#id_usuario").val();
	var id_producto = $("#id_producto").val();
	

	if ( detalles != "") {

		console.log('Hola');
		console.log(total);

		$.ajax({
			url: "../ajax/Dproducto.php?op=update_formula",
			method: "POST",
			data: {
				'arrayformula': JSON.stringify(detalles),
				'numero_Dproducto': numero_Dproducto,
				'productoc': productoc,
				'rinde':rinde,
				'costo':costo,
				'categoria':categoria,	
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
				var rinde = $("#rinde").val("");
             var costo = $("#costo").val("");
            var categoria = $("#categoria").val("");
				var subtotal = $("#subtotal").html("");
				var total = $("#total").html("");


				detalles = [];
				$('#listformula').html('');


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

//TODO:  FUNCION PARA LISTAR ACTUALIZAR

function listar_en_actualizar(){

	tabla_en_actualizar=$('#lista_actualizar_data').dataTable(
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
	  url: '../ajax/Mprima.php?op=listar_en_actualizar',
	  type : "get",
	  dataType : "json",            
	  error: function(e){
		console.log(e.responseText);  
	  }
	},
	"bDestroy": true,
	"responsive": true,
	"bInfo":true,
  "iDisplayLength": 10,//Por cada 10 registros hace una paginación
	"order": [[ 0, "desc" ]],//Ordenar (columna,orden)
	
	"language": {
  
	  "sProcessing":     "Procesando...",
  
	  "sLengthMenu":     "Mostrar _MENU_ registros",
  
	  "sZeroRecords":    "No se encontraron resultados",
  
	  "sEmptyTable":     "Ningún dato disponible en esta tabla",
  
	  "sInfo":           "Mostrando un total de _TOTAL_ registros",
  
	  "sInfoEmpty":      "Mostrando un total de 0 registros",
  
	  "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
  
	  "sInfoPostFix":    "",
  
	  "sSearch":         "Buscar:",
  
	  "sUrl":            "",
  
	  "sInfoThousands":  ",",
  
	  "sLoadingRecords": "Cargando...",
  
	  "oPaginate": {
  
		"sFirst":    "Primero",
  
		"sLast":     "Último",
  
		"sNext":     "Siguiente",
  
		"sPrevious": "Anterior"
  
	  },
  
	  "oAria": {
  
		"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
  
		"sSortDescending": ": Activar para ordenar la columna de manera descendente"
  
	  }
  
	   }
	   
	 }).DataTable();
  }
  
  

  
  function agregaractualizar(id_Mprima,materiales, estado){
  
  //alert(estado);
  
  $.ajax({
	url:"../ajax/Mprima.php?op=buscar_actualizar",
	method:"POST",
  
	data:{id_Mprima:id_Mprima, materiales:materiales, estado:estado},
	cache: false,
	dataType:"json",
  
	success:function(data){
  
  
	 if(data.id_Mprima){
  
	  if (typeof data == "string"){
		data = $.parseJSON(data);
	  }
	  console.log(data);
			var obj = {
			  cantidad : 1,
			  id_Mprima  : id_Mprima,
			  materiales   : data.materiales,
			  unidadm : data.unidadm,
			  moneda   : data.moneda,
			  precio   : data.precio,
			  importe  : 0,
			  estado   : data.estado
			};
  
	  detalles.push(obj);
	  listarformula();
  
	  $('#lista_actualizarModal').modal("hide");
  
					 }//if validacion id_producto
  
					 else {
  
						 //si el producto está inactivo entonces se muestra una ventana modal
  
						 bootbox.alert(data.error);
					   }
  
		}//fin success    
  
	  });//fin de ajax
  
  
	}

init();
   var tabla;

   var tabla_en_Batida;

   var tabla_Batida_mes;

	//Función que se ejecuta al inicio
	function init(){
		
		listar();

		
	}

	
//Función Listar
function listar()
{
	tabla=$('#lista_Batida_data').dataTable(
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
					url: '../ajax/Batida.php?op=buscar_Batida',
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

			   }//cerrando language
	       
	}).DataTable();
}

     //VER DETALLE PROVEEDOR-COMPRA
	 $(document).on('click', '.detalle', function(){
	 	//toma el valor del id
		var numero_Batida = $(this).attr("id");

		$.ajax({
			url:"../ajax/Batida.php?op=ver_detalle_Dproducto_Batida",
			method:"POST",
			data:{numero_Batida:numero_Batida},
			cache:false,
			dataType:"json",
			success:function(data)
			{
				$("#numero_Batida").html(data.numero_Batida);
				$("#numero_Dproducto").html(data.numero_Dproducto);
				$("#productoc").html(data.productoc);
				$("#categoria").html(data.categoria);
				$("#fecha_Batida").html(data.fecha_Batida);
                 
                 //puse el alert para ver el error, sin necesidad de hacer echo en la consulta ni nada
				//alert(data);
				
			}
		})
	});


	  //VER DETALLE COMPRA
	 $(document).on('click', '.detalle', function(){
	 	//toma el valor del id
		var numero_Batida = $(this).attr("id");

		$.ajax({
			url:"../ajax/Batida.php?op=ver_detalle_Batida",
			method:"POST",
			data:{numero_Batida:numero_Batida},
			cache:false,
			//dataType:"json",
			success:function(data)
			{
				
				$("#detalles").html(data);
                 
                 //puse el alert para ver el error, sin necesidad de hacer echo en la consulta ni nada
				//alert(data);
				
			}
		})
	});

	 //CAMBIAR ESTADO DE LA COMPRA

   
    function cambiarEstado(id_Batida, numero_Batida, est){
    

    //alert(numero_compra);
    	

	bootbox.confirm("¿Estas seguro que quieres anular?", function(result){
		if(result)
		{


			$.ajax({
				url:"../ajax/Batida.php?op=cambiar_estado_Batida",
				 method:"POST",
				//data:dataString,
				//toma el valor del id y del estado
				data:{id_Batida:id_Batida,numero_Batida:numero_Batida, est:est},
				cache: false,
				
				success:function(data){
	              
	              //alert(data);
                 $('#Batida_data').DataTable().ajax.reload();
                 
                 //refresca el datatable de compras por fecha
                 $('#Batida_fecha_data').DataTable().ajax.reload();
	             

	              //refresca el datatable de compras por fecha - mes
                 $('#Batida_fecha_mes_data').DataTable().ajax.reload();

				}

			});

		   } 

	  });//bootbox


	  }

	  //CONSULTA COMPRAS-FECHA
           $(document).on("click","#btn_Batida_fecha", function(){


           	var fecha_inicial= $("#datepicker").val();
           	var fecha_final= $("#datepicker2").val();

           	//alert(fecha_inicial);
           	//alert(fecha_final);

        //validamos si existe las fechas entonces se ejecuta el ajax

        if(fecha_inicial!="" && fecha_final!=""){

	       // BUSCA LAS COMPRAS POR FECHA
	      tabla_en_Batida= $('#Batida_fecha_data').DataTable({

	    
	       "aProcessing": true,//Activamos el procesamiento del datatables
	       "aServerSide": true,//Paginación y filtrado realizados por el servidor
	      dom: 'Bfrtip',//Definimos los elementos del control de tabla
	      buttons: [		          
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],

	         "ajax":{
	            url:"../ajax/Batida.php?op=buscar_Batida_fecha",
                type : "post",
				//dataType : "json",
				data:{fecha_inicial:fecha_inicial,fecha_final:fecha_final},						
				error: function(e){
					console.log(e.responseText);

				},

	          
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
			 
			    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			 
			    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
			 
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

			   }, //cerrando language

			    //"scrollX": true



	      });

	        }//cerrando condicional de las fechas

	    });

      //****************************************************************


         //FECHA COMPRA POR MES

           $(document).on("click","#btn_Batida_fecha_mes", function(){

           	//var proveedor= $("#proveedor").val();

           	var mes= $("#mes").val();
           	var ano= $("#ano").val();

           	//alert(mes);
           	//alert(ano);

        //validamos si existe las fechas entonces se ejecuta el ajax

        if(mes!="" && ano!=""){

	       // BUSCA LAS COMPRAS POR FECHA
	      var tabla_Batida_mes= $('#Batida_fecha_mes_data').DataTable({
	        
	       "aProcessing": true,//Activamos el procesamiento del datatables
	       "aServerSide": true,//Paginación y filtrado realizados por el servidor
	      dom: 'Bfrtip',//Definimos los elementos del control de tabla
	      buttons: [		          
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],

	         "ajax":{
	            url:"../ajax/Batida.php?op=buscar_Batida_fecha_mes",
                type : "post",
				//dataType : "json",
				data:{mes:mes,ano:ano},						
				error: function(e){
					console.log(e.responseText);

				},

	          
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
			 
			    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
			 
			    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
			 
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

			   }, //cerrando language

			    //"scrollX": true



	      });

	        }//cerrando condicional de las fechas

	    });

	init();

  
  //TODO:  FUNCION PARA LISTAR ACTUALIZAR

  function listar_en_actualizar11(){

    tabla_en_actualizar=$('#lista_actualizar_data11').dataTable(
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

 

  function agregaractualizar11(id_Mprima,materiales, estado){

  //alert(estado);

  $.ajax({
    url:"../ajax/Mprima.php?op=buscar_actualizar11",
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
              codMpri  : id_Mprima,
              materiales   : data.materiales,
              unidadm : data.unidadm,
              moneda   : data.moneda,
              precio   : data.precio,
              importe  : 0,
              estado   : data.estado
            };

      detalles.push(obj);
      listarformula();

      $('#lista_actualizarModal11').modal("hide");

                     }//if validacion id_producto

                     else {

                         //si el producto está inactivo entonces se muestra una ventana modal

                         bootbox.alert(data.error);
                       }

        }//fin success    

      });//fin de ajax


    }
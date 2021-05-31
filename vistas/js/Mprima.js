  
var tabla;

var tabla_en_Dproducto;



 //Función que se ejecuta al inicio
 function init(){

   listar();

   listar_en_Dproducto();



	 //cuando se da click al boton submit entonces se ejecuta la funcion guardaryeditar(e);
  $("#Mprima_form").on("submit",function(e)
  {

    guardaryeditar(e);	
  })

    //cambia el titulo de la ventana modal cuando se da click al boton
    $("#add_button").click(function(){

		     //habilita los campos cuando se agrega un registro nuevo ya que cuando se editaba un registro asociado entonces aparecia deshabilitado los campos
         $("#Mprima").attr('disabled', false);
         $("#moneda").attr('disabled', false);

         $(".modal-title").text("Agregar Mprima");

       });


  }


//Función limpiar
/*IMPORTANTE: no limpiar el campo oculto del id_usuario, sino no se registra
la categoria*/
function limpiar()
{
	
	$('#materiales').val("");
	$('#unidadm').val("");
  $('#moneda').val("");
  $('#precio').val("");
  $('#stock').val("");
  $('#estado').val("");
  $('#id_Mprima').val("");


}

//Función Listar
function listar()
{
	tabla=$('#Mprima_data').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables    aqui esta opoopop
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
       url: '../ajax/Mprima.php?op=listar',
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

 //Mostrar datos de la categoria en la ventana modal 
 function mostrar(id_Mprima)
 {
   $.post("../ajax/Mprima.php?op=mostrar",{id_Mprima : id_Mprima}, function(data, status)
   {
    data = JSON.parse(data);
    console.log(data);

		 //alert(data.dui);


				 //si existe la categoria_id entonces tiene relacion con otras tablas
         if(data.Mprima_id){

          $('#MprimaModal').modal('show');
          $('#materiales').val(data.materiales);

						//desactiva el campo
           

            $('#unidadm').val(data.unidadm);

            $('#moneda').val(data.moneda);

                //desactiva el campo
                


                $('#precio').val(data.precio);

                $('#stock').val(data.stock);					
                $('#estado').val(data.estado);
                $('.modal-title').text("Editar Mprima");
                $('#resultados_ajax').html(data);
                $("#Mprima_data").DataTable().ajax.reload();
                $('#id_Mprima').val(id_Mprima);



              } else{

                $('#MprimaModal').modal('show');
                $('#materiales').val(data.materiales);

						//desactiva el campo
            

            $('#unidadm').val(data.unidadm);

            $('#moneda').val(data.moneda);

            


            $('#precio').val(data.precio);

            $('#stock').val(data.stock);		             
            $('#estado').val(data.estado);
            $('.modal-title').text("Editar Mprima");
            $('#id_Mprima').val(id_Mprima);
            $('#resultados_ajax').html(data);
            $("#Mprima_data").DataTable().ajax.reload();


          }



        });


 }


	//la funcion guardaryeditar(e); se llama cuando se da click al boton submit
  function guardaryeditar(e)
  {
	e.preventDefault(); //No se activará la acción predeterminada del evento
	var formData = new FormData($("#Mprima_form")[0]);


  $.ajax({
   url: "../ajax/Mprima.php?op=guardaryeditar",
   type: "POST",
   data: formData,
   contentType: false,
   processData: false,

   success: function(datos)
   {                    
		          /*bootbox.alert(datos);	          
		          mostrarform(false);
		          tabla.ajax.reload();*/

		         //alert(datos);

                 /*imprimir consulta en la consola debes hacer un print_r($_POST) al final del metodo 
                    y si se muestran los valores es que esta bien, y se puede imprimir la consulta desde el metodo
                    y se puede ver en la consola o desde el mensaje de alerta luego pegar la consulta en phpmyadmin*/
                    console.log(datos);

                    $('#Mprima_form')[0].reset();
                    $('#MprimaModal').modal('hide');

                    $('#resultados_ajax').html(datos);
                    $('#Mprima_data').DataTable().ajax.reload();

                    limpiar();

                  }

                });

}


//EDITAR ESTADO DE LA CATEGORIA
//importante:id_categoria, est se envia por post via ajax


function cambiarEstado(id_Mprima, est){


 bootbox.confirm("¿Está Seguro de cambiar de estado?", function(result){
  if(result)
  {


   $.ajax({
    url:"../ajax/Mprima.php?op=activarydesactivar",
    method:"POST",
				//data:dataString,
				//toma el valor del id y del estado
				data:{id_Mprima:id_Mprima, est:est},
				//cache: false,
				//dataType:"html",
				success: function(data){

          $('#Mprima_data').DataTable().ajax.reload();

        }

      });

 }

		 });//bootbox



}

   //ELIMINAR CATEGORIA

   function eliminar(id_Mprima){

	     //IMPORTANTE: asi se imprime el valor de una funcion

         //alert(categoria_id);


         bootbox.confirm("¿Está Seguro de eliminar el Costo de Fabricacion?", function(result){
          if(result)
          {

            $.ajax({
             url:"../ajax/Mprima.php?op=eliminar_Mprima",
             method:"POST",
             data:{id_Mprima:id_Mprima},

             success:function(data)
             {
						//alert(data);
						$("#resultados_ajax").html(data);
						$("#Mprima_data").DataTable().ajax.reload();
					}
				});

          }

		 });//bootbox


       }

    //TODO:Función Listar PARA CREAR LAS FORMULAS
    function listar_en_Dproducto(){

      tabla_en_Dproducto=$('#lista_Mprima_data').dataTable(
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
        url: '../ajax/Mprima.php?op=listar_en_Dproducto',
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


/*IMPORTANTE function agregarDetalle y function listarDetalles:
  Asi que detalles pertenece al arreglo detalles[]
  Para agregar elementos a un arreglo en javascript, se utiliza el metodo push()
  Puedes agregar variables u objetos, lo que yo he hecho es agregarle un objeto y ese objeto que contiene mucha informacion, que sería como una fila con muchas columnas
  Para crear un objeto de ese tipo (con columnas), se utliliza esto :
  var obj = { }
  Dentro de las llaves definas columna y valor (Todo esto para una fila)
  Lo defines asi:
  nombre_columna : valor
  El lenght 
  sirve para calcular la longitud del arreglo o el 
  numero de objetos que tiene el arreglo, que es lo mismo Y es por eso que 
  lo necesito en el for. Claro que puedes agregarle un id y name al td*/

    //este es un arreglo vacio
    var detalles = [];


    function agregarDetalle(id_Mprima,materiales, estado){

    //alert(estado);

    $.ajax({
      url:"../ajax/Mprima.php?op=buscar_Mprima",
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

            /*IMPORTANTE: var obj: es un objeto con mucha informacion que contiene una fila con muchas columnas
        Para crear un objeto de ese tipo (con columnas), se utliliza esto :
            var obj = { }, Dentro de las llaves definas columna y valor (Todo esto para una fila)
        Lo defines asi:
        nombre_columna : valor 
        este var obj es un objeto que trae la informacion de la data (../ajax/producto.php?op=buscar_producto)
              .
              .
              .
              .

              .
              .
              .
              .
              .
              .
              .
              .
              aqui no he tocado nada aun ajax buscar Mprima*/
              var obj = {
                cantidad : 1,
                codMpri  : id_Mprima,
                materiales   : data.materiales,
                unidadm : data.unidadm,
                moneda   : data.moneda,
                precio   : data.precio,
                stock    : data.stock,
                importe  : 0,
                estado   : data.estado
              };

     /*IMPORTANTE: detalles.push(obj);: Para agregar elementos a un arreglo en javascript, se utiliza el metodo push()
      Puedes agregar variables u objetos, lo que yo he hechos es agregarle un objeto y ese objeto que contiene mucha informacion,
        el detalles de detalles.push(obj); viene de detalles = [], una vez se agrega el objeto al arreglo entonces se llama a la function listarDetalles(); 
        */
        detalles.push(obj);
        listarDetalles();

        $('#lista_MprimaModal').modal("hide");

                       }//if validacion id_producto

                       else {

                           //si el producto está inactivo entonces se muestra una ventana modal

                           bootbox.alert(data.error);
                         }

          }//fin success    

        });//fin de ajax


      }// fin de funcion


//***********************************************************************

 /*IMPORTANTE: El lenght 
  sirve para calcular la longitud del arreglo o el 
  numero de objetos que tiene el arreglo, que es lo mismo Y es por eso que 
  lo necesito en el for    ------------------------------------------------------------------------------------------------------------
  esta parte va a hacer el proceso que necesito de la multiplicacion*/



  function listarDetalles(){


    $('#listMpriDproducto').html('');



    var filas = "";
    
    var subtotal = 0;

    var total = 0;

    var subtotalFinal = 0;

    var totalFinal = 0;

    var step = 0.001;



    






    for(var i=0; i<detalles.length; i++) {
      if( detalles[i].estado == 1 ) {

        var importe = detalles[i].importe = detalles[i].cantidad * detalles[i].precio;
        
        importe = detalles[i].importe = detalles[i].importe ;
        var filas = filas + 
        "<tr><td>"+(i+1)+"</td> <td name='materiales[]'>"+detalles[i].materiales+
        "</td>  <td name='unidadm[]'>"+detalles[i].unidadm+
        "</td> <td name='precio[]' id='precio[]'>"+detalles[i].moneda+" "+detalles[i].precio+
        "</td> <td>"+detalles[i].stock+
        "</td> <td><input type='number' step=0.000001 class='form-control' name='cantidad[]'id='cantidad[]'onClick='setCantidad(event, this, "+(i)+");' onKeyUp='setCantidad(event, this, "+(i)+");' value='"+detalles[i].cantidad+
        "'></td><td> <span name='importe[]' id='importe"+i+"'>"+detalles[i].moneda+" "+detalles[i].importe+
        "</span> </td> <td>  <button href='#' class='btn btn-danger btn-lg' role='button' onClick='eliminarMpri(event, "+(i)+");' aria-pressed='true'><span class='glyphicon glyphicon-trash'></span> </button></td> </tr>";
        subtotal = subtotal + importe;


        //concatenar para poner la moneda con el subtotal
        subtotalFinal = detalles[i].moneda+" "+subtotal;

        var su = subtotal;
        var or=parseFloat(su);
        var total= Math.round(or+subtotal);


            //concatenar para poner la moneda con el total
            totalFinal = detalles[i].moneda+" "+total;



          }



        }


        $('#listMpriDproducto').html(filas);



  //subtotal
  $('#subtotal').html(subtotalFinal);
  $('#subtotal_Dproducto').html(subtotalFinal);

  //total
  $('#total').html(totalFinal);
  $('#total_Dproducto').html(totalFinal);



}



/*IMPORTANTE:Event es el objeto del evento que los manejadores de eventos utilizan
parseInt es una función para convertir un valor string a entero
obj.value es el valor del campo de texto*/
function setCantidad(event, obj, idx){
  event.preventDefault();
  detalles[idx].cantidad = parseFloat(obj.value);
  recalcular(idx);
}


function recalcular(idx){
    //alert('holaaa:::' + obj.value);
    //var asd = document.getElementById('cantidad');
    //console.log(detalles[idx].cantidad);
    //detalles[idx].cantidad = parseInt(obj.value);
    console.log(detalles[idx].cantidad);
    console.log((detalles[idx].cantidad * detalles[idx].precio));
    //var objImp = 'importe'+idx;
    //console.log(objImp);
    
    /*IMPORTANTE:porque cuando agregaba una segunda fila el importe se alteraba? El importe se modificaba por que olvidé restarle el descuento
    Así que solo agregué esa resta a la operación*/

    var importe =detalles[idx].importe = detalles[idx].cantidad * detalles[idx].precio;
    importe = detalles[idx].importe = detalles[idx].importe;
    
    importeFinal = detalles[idx].moneda+" "+importe;

    $('#importe'+idx).html(importeFinal);
    calcularTotales();
  }

  function calcularTotales(){

   var subtotal = 0;

   var total = 0;

   var subtotalFinal = 0;

   var totalFinal = 0;


   
   for(var i=0; i<detalles.length; i++){
    if(detalles[i].estado == 1){
      subtotal = subtotal + (detalles[i].cantidad * detalles[i].precio) - (detalles[i].cantidad*detalles[i].precio);

        //concatenar para poner la moneda con el subtotal
        subtotalFinal = detalles[i].moneda+" "+subtotal;

        var su = subtotal;
        var or=parseFloat(su);
        var total = Math.round(or+subtotal);

            //concatenar para poner la moneda con el total
            totalFinal = detalles[i].moneda+" "+total;


          }
        }




  //subtotal
  $('#subtotal').html(subtotalFinal);
  $('#subtotal_Dproducto').html(subtotalFinal);

  //total
  $('#total').html(totalFinal);
  $('#total_Dproducto').html(totalFinal);
}


  //*******************************************************************
    /*IMPORTANTE:Event es el objeto del evento que los manejadores de eventos utilizan
parseInt es una función para convertir un valor string a entero
obj.value es el valor del campo de texto*/

function  eliminarMpri(event, idx){
  event.preventDefault();
  detalles[idx].estado = 0;
  listarDetalles();
}

 //********************************************************************



 function registrarDproducto(){

  /*IMPORTANTE: se declaran las variables ya que se usan en el data, sino da error*/
  var numero_Dproducto = $("#numero_Dproducto").val();
  var productoc = $("#productoc").val();
  var rinde = $("#rinde").val();
  var costo = $("#costo").val();
  var categoria = $("#categoria").val();
  var total = $("#total").html();
  var id_usuario = $("#id_usuario").val();
  var id_producto = $("#id_producto").val();


     //alert(usuario_id);

    //validamos, si los campos(proveedor) estan vacios entonces no se envia el formulario

    if(productoc!="" &&   detalles!=""){


     /*console.log(numero_Dproducto);
     console.log(productoc);
     console.log(categoria);
     console.log(datepicker);*/

     console.log('Hola');

    /*IMPORTANTE: el array detalles de la data viene de var detalles = []; esta vacio pero como ya se usó en la function agregarDetalle(id_producto,producto)
    se reusa, pero ya viene cargado con la informacion que se va a enviar con ajax*/
    $.ajax({
      url:"../ajax/Mprima.php?op=registrar_Dproducto",
      method:"POST",
      data:{'arrayDproducto':JSON.stringify(detalles), 'numero_Dproducto':numero_Dproducto,'productoc':productoc,'rinde':rinde,'costo':costo,'categoria':categoria,'total':total,'id_usuario':id_usuario,'id_producto':id_producto},
      cache: false,
      dataType:"html",
      error:function(x,y,z){
        console.log(x);
        console.log(y);
        console.log(z);
      },

         //IMPORTANTE:hay que considerar que esta prueba lo hice sin haber creado la funcion agrega_detalle_compra()
     /*IMPORTANTE: para imprimir el sql en registrar_compra.php, se comenta el typeof y se descomenta console.log(data);
               y en registrar_compra.php que seria la funcion agrega_detalle_compra(); comente $conectar,  $sql=$conectar->prepare($sql); y los parametros enumerados y $sql->execute(),
               me quede solo con los parametros que estan en el foreach, la consulta $sql (insert) y el echo $sql, luego se me muestra un alert con la consulta 
               lo que hice fue concatenar y meter las variables en la consulta y sustituirla por ? ejemplo $sql="insert into detalle_compra
        values(null,'".$numero_compra."','".$producto."','".$precio."','".$cantidad."','".$dscto."','".$dui_proveedor."','".$fecha_compra."');"; 
        luego agrego un producto y creo la consulta con los valores reales por ejemplo insert into detalle_compra values(null,'F000001','ganchate','900','1','0','666666','01/01/1970'); y lo inserto en phpmyadmin

        Antes hice un alert con estas variables (antes hay que llenar el formulario para poder mostrar los valores con el alert)
        var numero_compra = $("#numero_compra").val();
      var dui = $("#dui").val();
      var razon = $("#razon").val();
      var direccion = $("#direccion").val();
      var datepicker = $("#datepicker").val();

      */
      
      success:function(data){
      //IMPORTANTE: esta se descomenta cuando imprimo el console.log
      /*if (typeof data == "string"){
            data = $.parseJSON(data);
          }*/
          console.log(data);

      //alert(data);

            //IMPORTANTE:limpia los campos despues de enviarse
            //cuando se imprime el alert(data) estas variables deben comentarse

            var productoc = $("#productoc").val("");
             var rinde = $("#rinde").val("");
             var costo = $("#costo").val("");
            var categoria = $("#categoria").val("");
            var subtotal = $("#subtotal").html("");
            var total = $("#total").html("");

            
            detalles = [];
            $('#listMpriDproducto').html('');



            //1000-3000


          //muestra un mensaje de exito
          setTimeout ("bootbox.alert('Se ha registrado con éxito');", 100); 
          
          //refresca la pagina, se llama a la funtion explode
          setTimeout ("explode();", 2000); 

          
        }


      }); 

   //cierre del condicional de validacion de los campos del producto,proveedor,pago

 } else{

   bootbox.alert("VACIO");
   return false;
 }  

}


  //*****************************************************************************
  /*RESFRESCA LA PAGINA DESPUES DE REGISTRAR LA COMPRA*/
  function explode(){

    location.reload();
  }




 


  init();
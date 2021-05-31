<?php


//conexion a la base de datos
require_once("conexion.php");


class detalle_Dproducto extends Conectar
{


  public function get_filas_Dproducto()
  {

    $conectar = parent::conexion();

    $sql = "select * from detalle_Dproducto";

    $sql = $conectar->prepare($sql);

    $sql->execute();

    $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

    return $sql->rowCount();
  }
}




class Dproducto extends Conectar
{


  public function get_filas_Dproducto()
  {

    $conectar = parent::conexion();

    $sql = "select * from Dproducto";

    $sql = $conectar->prepare($sql);

    $sql->execute();

    $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

    return $sql->rowCount();
  }

  public function get_formula_por_id_estado($id_Dproducto,$estado){

    $conectar= parent::conexion();

    //declaramos que el estado esté activo, igual a 1

     $estado=1;


     $sql="select * from Dproducto where id_Dproducto=? and estado=?";

     $sql=$conectar->prepare($sql);

     $sql->bindValue(1, $id_Dproducto);
     $sql->bindValue(2, $estado);
     $sql->execute();

     return $resultado= $sql->fetchAll(PDO::FETCH_ASSOC);


}


  public function get_Dproducto()
  {

    $conectar = parent::conexion();

    $sql = "select * from Dproducto";

    $sql = $conectar->prepare($sql);

    $sql->execute();

    return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
  }

  public function get_detalle_qDproducto()
  {

    $conectar = parent::conexion();

    $sql = "select select
          p.id_Dproducto,p.productoc,p.numero_Dproducto,c.id_Mprima,c.materiales,c.unidadm,c.moneda,
          c.precio,c.cantidad,c.estado

          FROM Dproducto p

          INNER JOIN detalle_Dproducto c ON c.numero_Dproducto = p.numero_Dproducto

          GROUP BY numero_Dproducto";

    $sql = $conectar->prepare($sql);

    $sql->execute();

    return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
  }


  public function get_DproductoB()
  {

    $conectar = parent::conexion();
    $sql = "select
          p.id_Dproducto,p.productoc,p.numero_Dproducto,c.id_Mprima,c.materiales,c.unidadm,c.moneda,
          c.precio,c.cantidad,c.estado

          FROM Dproducto p

          INNER JOIN detalle_Dproducto c ON c.numero_Dproducto = p.numero_Dproducto

          
          GROUP BY numero_Dproducto
          
          ";
    $sql = $conectar->prepare($sql);

    $sql->execute();

    return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
  }

  public function get_DproductoP($id_Dproducto, $estado)
  {

    $conectar = parent::conexion();

    $estado = 1;
    $sql = "select
          p.id_Dproducto,p.productoc,p.categoria,p.numero_Dproducto,p.rinde,p.costo,c.id_Mprima,c.materiales,c.unidadm,c.moneda,
          c.precio,c.cantidad,c.estado

          FROM Dproducto p

          INNER JOIN detalle_Dproducto c ON c.numero_Dproducto = p.numero_Dproducto


          where p.id_Dproducto=? and c.estado=?

          ";
    $sql = $conectar->prepare($sql);

    $sql->bindValue(1, $id_Dproducto);
    $sql->bindValue(2, $estado);

    $sql->execute();

    return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
  }

  //TODO:  EXTRAER DATOS DE LA FORMULA

  public function get_formula($id_Dproducto, $estado)
  {

    $conectar = parent::conexion();

    $estado = 1;
    $sql = "select
     p.id_usuario,p.id_producto,id_Dproducto,p.numero_Dproducto,p.productoc,p.categoria,p.rinde,p.costo,c.id_detalle_Dproducto,c.id_Mprima,c.materiales,c.unidadm,c.moneda,
      c.precio,c.cantidad,c.estado

      FROM Dproducto p

      INNER JOIN detalle_Dproducto c ON c.numero_Dproducto = p.numero_Dproducto


      where p.id_Dproducto=? and c.estado=?

      ";
    $sql = $conectar->prepare($sql);

    $sql->bindValue(1, $id_Dproducto);
    $sql->bindValue(2, $estado);

    $sql->execute();

    return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
  }

  public function get_DproductoC($numero_Dproducto)
  {

    $conectar = parent::conexion();
    parent::set_names();

    $sql = "select d.numero_Dproducto,d.materiales,d.unidadm, d.moneda, d.precio,d.cantidad,d.importe, d.fecha_Dproducto,c.numero_Dproducto, c.moneda, c.subtotal,c.total,p.id_producto,p.fecha,p.estado
          from detalle_Dproducto as d, Dproducto as c, producto as p
          where 
          
          d.numero_Dproducto
          =c.numero_Dproducto
          and
          d.numero_Dproducto=?
          
          ;";

    //echo $sql; exit();

    $sql = $conectar->prepare($sql);


    $sql->bindValue(1, $numero_Dproducto);
    $sql->execute();
    return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
  }





  public function get_Dproducto_por_id($id_Dproducto)
  {

    $conectar = parent::conexion();


    $sql = "select * from Dproducto where id_Dproducto=?";

    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $id_Dproducto);
    $sql->execute();

    return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
  }


  public function numero_Dproducto()
  {

    $conectar = parent::conexion();
    parent::set_names();


    $sql = "select numero_Dproducto from detalle_Dproducto;";

    $sql = $conectar->prepare($sql);

    $sql->execute();
    $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);

    //aqui selecciono solo un campo del array y lo recorro que es el campo numero_compra
    foreach ($resultado as $k => $v) {

      $numero_Dproducto["numero"] = $v["numero_Dproducto"];
    }
    //luego despues de tener seleccionado el numero_compra digo que si el campo numero_compra està vacio entonces se le asigna un F000001 de lo contrario ira sumando



    if (empty($numero_Dproducto["numero"])) {
      echo 'F00001';
    } else {
      $num     = substr($numero_Dproducto["numero"], 1);
      $dig     = $num + 1;
      $fact = str_pad($dig, 5, "0", STR_PAD_LEFT);
      echo 'F' . $fact;
    }
  }

  //TODO: UPDATE DE FORMULAS
  public function agrega_formula()
  {


    $str = '';
    $detalles = array();
    $detalles = json_decode($_POST['arrayformula']);
    $conectar = parent::conexion();

    foreach ($detalles as $k => $v) {

      $cantidad = $v->cantidad;
      $id_Mprima = $v->id_Mprima;
      $materiales = $v->materiales;
      $unidadm = $v->unidadm;
      $moneda = $v->moneda;
      $precio = $v->precio;
      $importe = $v->importe;
      //$total = $v->total;
      $estado = $v->estado;

      $rinde = $v->rinde;
    $costo = $v->costo;
    //$numero_Dproducto = $v->numero_Dproducto;

    //$productoc = $v->productoc;
//:TODO: Metodo de envio POST
    $numero_Dproducto = $_POST["numero_Dproducto"];
    $productoc = $_POST["productoc"];
    $categoria = $v->categoria;
    $id_Dproducto = $v->id_Dproducto;
    $id_detalle_Dproducto = $v->id_detalle_Dproducto;
    $id_usuario = $v->id_usuario;
    $id_producto = $v->id_producto;

    $subtotal = $v->subtotal;
    $total = $v->total;


    $stmt = $conectar->prepare("INSERT INTO detalle_Dproducto (id_detalle_Dproducto,numero_Dproducto,productoc,id_Mprima,materiales,unidadm,moneda,precio,cantidad,importe,fecha_Dproducto,id_usuario,id_producto,estado) 
    VALUES (:id_detalle_Dproducto,:numero_Dproducto,:productoc,:id_Mprima,:materiales,:unidadm,:moneda,:precio,:cantidad,:importe,now(),:id_usuario,:id_producto,:estado)
ON DUPLICATE KEY UPDATE  

numero_Dproducto=:numero_Dproducto,
productoc=:productoc,
id_Mprima=:id_Mprima,
materiales=:materiales,
unidadm=:unidadm,
moneda=:moneda,
precio=:precio,
cantidad=:cantidad,
importe=:importe,
id_usuario=:id_usuario,
id_producto=:id_producto,
estado=:estado");

$stmt->bindParam(':id_detalle_Dproducto', $id_detalle_Dproducto);
$stmt->bindParam(':numero_Dproducto', $numero_Dproducto);
$stmt->bindParam(':productoc', $productoc);
$stmt->bindParam(':id_Mprima', $id_Mprima);
$stmt->bindParam(':materiales', $materiales);
$stmt->bindParam(':unidadm', $unidadm);
$stmt->bindParam(':moneda', $moneda);
$stmt->bindParam(':precio', $precio);
$stmt->bindParam(':cantidad', $cantidad);
$stmt->bindParam(':importe', $importe);
$stmt->bindParam(':id_usuario', $id_usuario);
$stmt->bindparam(':id_producto', $id_producto);
$stmt->bindparam(':estado', $estado);



$stmt->execute();
   
    
      $sql3 = "select * from Mprima where id_Mprima=?;";

      $sql3 = $conectar->prepare($sql3);

      $sql3->bindValue(1, $id_Mprima);
      $sql3->execute();

      $resultado = $sql3->fetchAll(PDO::FETCH_ASSOC);

      foreach ($resultado as $b => $row) {

        $re["existencia"] = $row["stock"];
      }

      $cantidad_total = $cantidad + $row["stock"];

      if (is_array($resultado) == true and count($resultado) > 0) {

        $sql4 = "update Mprima set 
                      
                      stock=?
                      where 
                      id_Mprima=?
             	   ";


        $sql4 = $conectar->prepare($sql4);
        $sql4->bindValue(1, $cantidad_total);
        $sql4->bindValue(2, $id_Mprima);
        $sql4->execute();
      }
    }
    $sql5 = "select sum(importe) as total from detalle_Dproducto where numero_Dproducto=?";

    $sql5 = $conectar->prepare($sql5);

    $sql5->bindValue(1, $numero_Dproducto);

    $sql5->execute();

    $resultado2 = $sql5->fetchAll();

    foreach ($resultado2 as $c => $d) {

      $row["total"] = $d["total"];
    }

    $subtotal = $d["total"];
    $iva = 13 / 100;
    $total_iv = $subtotal * $iva;
    $total_iva = $total_iv;

    $tot = $subtotal;
    $total = $tot;


    $sql2 = "update Dproducto set
    numero_Dproducto=?,
    
    productoc=?,
    rinde=?,
    costo=?,
    categoria=?,
    moneda=?,
    subtotal=?,
    total=?,
    estado=?,
    id_producto=?,
    id_usuario=?
    where
    id_Dproducto=?
    ";  

    $sql2 = $conectar->prepare($sql2);
    
    $sql2->bindValue(1, $numero_Dproducto);
    $sql2->bindValue(2, $productoc);
    $sql2->bindValue(3, $rinde);
    $sql2->bindValue(4, $costo);
    $sql2->bindValue(5, $categoria);
    $sql2->bindValue(6, $moneda);
    $sql2->bindValue(7, $subtotal);
    $sql2->bindValue(8, $total);
    $sql2->bindValue(9, $estado);
    $sql2->bindValue(10, $id_producto);
    $sql2->bindValue(11, $id_usuario);
    $sql2->bindValue(12, $id_Dproducto);

    $sql2->execute();
  }


  //TODO: GUARDADO DE FORMULAS 
  /*metodo para agregar la compra */
  public function agrega_detalle_Dproducto()
  {


    //echo json_encode($_POST['arrayCompra']);
    $str = '';
    $detalles = array();
    $detalles = json_decode($_POST['arrayDproducto']);



    /*IMPORTANTE:Esas variables NO las puedes usar fuera del foreach
Por que se crean dentro. con cada producto para el INSERT, 

hay dos formas de hacer esto:
1,. Es la más fácil, que es dentro del bucle 
2..- La más difícil, que es fuera del bucle
Cuando es dentro, lo que vas a hacer es un insert por cada producto
Imagina que son 10 productos los que seleccionaste, entonces dentro del bucle , tendrías 1 insert por esos 10, es decir en total harías 10 inserts
Por que le envías producto por producto
En cambio cuando es fuera del bucle, haces 1 solo insert pero le envías TODO los 10 productos.

-con las variables del proveedor no hay problema, las puedes usar directo
Si no estan en el arreglo, las puedes usar directo, se haria $proveedor = $_POST["debe ir el nombre que le has asignado en el ajax"], Y luego en la consulta INSERT pones la variable que has creado $proveedor 

- cuando armo un insert lo hago en el mismo orden que he creado las columnas de la tabla de la bd


- en esas variables ($cantidad, $codProd, $producto etc) ya están la información de cada producto seleccionado en el formulario


- //IMPORTANTE SOBRE IMPRIMIR EL SQL PARTE 1:hay que considerar que esta prueba lo hice sin haber creado la funcion agrega_detalle_compra(), se hizo desde registrar_compra.php, pero tambien se puede hacer desde comprasModulo.php y funciona igual, ya se hizo la prueba
 

         */

    $conectar = parent::conexion();


    foreach ($detalles as $k => $v) {

      //IMPORTANTE:estas variables son del array detalles
      $cantidad = $v->cantidad;
      $codMpri = $v->codMpri;
      $materiales = $v->materiales;
      $unidadm = $v->unidadm;
      $moneda = $v->moneda;
      $precio = $v->precio;
      $importe = $v->importe;
      //$total = $v->total;
      $estado = $v->estado;

      //echo "***************";
      //echo "Cant: ".$cantidad." codProd: ".$codProd. " Producto: ". $producto. " moneda: ".$moneda. " precio: ".$precio. " descuento: ".$dscto. " estado: ".$estado;

      $numero_Dproducto = $_POST["numero_Dproducto"];
      $productoc = $_POST["productoc"];
      $rinde = $_POST["rinde"];
      $costo = $_POST["costo"];
      $categoria = $_POST["categoria"];
      $total = $_POST["total"];
      $id_usuario = $_POST["id_usuario"];
      $id_producto = $_POST["id_producto"];

      /*IMPORTANTE: no me imprimia porque tenia estas variables que no usaba*/

      //$subtotal_compra = $_POST["subtotal_compra"];
      //$total_compra = $_POST["total_compra"];




      /*$sql="insert into detalle_compra
        values(null,'".$numero_compra."','".$producto."','".$precio."','".$cantidad."','".$dscto."','".$dui_proveedor."','".$fecha_compra."','".$estado."');";

        echo $sql;*/

      //fecha 

      //$fecha_compra= date("d/m/Y");

      //estado 
      //si estado es igual a 1 entonces la compra esta pagada
      //$estado = 1;



      $sql = "insert into detalle_Dproducto
        values(null,?,?,?,?,?,?,?,?,?,now(),?,?,?);";


      $sql = $conectar->prepare($sql);

      //echo $sql;

      /*importante:se ingresó el id_producto=$codProd ya que se necesita para relacionar las tablas compras con detalle_compras para cuando se vaya a hacer la consulta de la existencia del producto y del stock para cuando se elimine un detalle compra y se reintegre la cantidad de producto*/

      $sql->bindValue(1, $numero_Dproducto);
      $sql->bindValue(2, $productoc);
      $sql->bindValue(3, $codMpri);
      $sql->bindValue(4, $materiales);
      $sql->bindValue(5, $unidadm);
      $sql->bindValue(6, $moneda);
      $sql->bindValue(7, $precio);
      $sql->bindValue(8, $cantidad);
      $sql->bindValue(9, $importe);
      $sql->bindValue(10, $id_usuario);
      $sql->bindValue(11, $id_producto);
      $sql->bindValue(12, $estado);

      $sql->execute();

      //print_r($_POST);

      /*IMPORTANTE:esta linea $resultado=$sql->fetch(PDO::ASSOC); debe comentarse sino se insertaria una sola fila

         Esta linea "$resultado=$sql->fetch(PDO::ASSOC);" se utliza cuando la consulta devuelva algún valor(osea si quieres imprimir un campo de la tabla de la bd) Pero la sentencia insert no deuelve nada
         Y esperar que devuelva despues del insert es un error en el codigo por eso es que solo ejecuta 1 producto y no el resto, por lo tanto se comenta dicha linea  */

      //$resultado=$sql->fetch(PDO::ASSOC);


      /*$sql2="insert into compras 
           values(null,'".$fecha_compra."','".$numero_compra."','".$proveedor."','".$dui_proveedor."','".$total."');";*/


      //si existe el producto entonces actualiza la cantidad, en caso contrario no lo inserta


      $sql3 = "select * from Mprima where id_Mprima=?;";

      //echo $sql3;

      $sql3 = $conectar->prepare($sql3);

      $sql3->bindValue(1, $codMpri);
      $sql3->execute();

      $resultado = $sql3->fetchAll(PDO::FETCH_ASSOC);

      foreach ($resultado as $b => $row) {

        $re["existencia"] = $row["stock"];
      }

      //la cantidad total es la suma de la cantidad más la cantidad actual
      $cantidad_total = $cantidad + $row["stock"];


      //si existe el producto entonces actualiza el stock en producto

      if (is_array($resultado) == true and count($resultado) > 0) {

        //actualiza el stock en la tabla producto

        $sql4 = "update Mprima set 
                      
                      stock=?
                      where 
                      id_Mprima=?
             	   ";


        $sql4 = $conectar->prepare($sql4);
        $sql4->bindValue(1, $cantidad_total);
        $sql4->bindValue(2, $codMpri);
        $sql4->execute();
      } //cierre la condicional


    } //cierre del foreach

    /*IMPORTANTE: hice el procedimiento de imprimir la consulta y me di cuenta a traves del mensaje alerta que la variable total no estaba definida y tube que agregarla en el arreglo y funcionó*/


    //SUMO EL TOTAL DE IMPORTE SEGUN EL CODIGO DE DETALLES DE COMPRA

    $sql5 = "select sum(importe) as total from detalle_Dproducto where numero_Dproducto=?";

    $sql5 = $conectar->prepare($sql5);

    $sql5->bindValue(1, $numero_Dproducto);

    $sql5->execute();

    $resultado2 = $sql5->fetchAll();

    foreach ($resultado2 as $c => $d) {

      $row["total"] = $d["total"];
    }

    $subtotal = $d["total"];

    //REALIZO EL CALCULO A REGISTRAR

    // $iva= 13/100;
    //$total_iv=$subtotal*$iva;
    //$total_iva=round($total_iv);
    //$tot=$subtotal+$total_iva;
    //$total=round($tot);

    $iva = 13 / 100;
    $total_iv = $subtotal * $iva;
    $total_iva = $total_iv;
    //$total_iva=round($total_iv);
    $tot = $subtotal;
    $total = $tot;
    //*****************************************//

    //IMPORTANTE: hay que sacar la consulta INSERT INTO COMPRAS fuera del foreach sino se repetiria el registro en la tabla compras

    //fecha 


    //estado 
    //si estado es igual a 1 entonces la compra esta pagada
    //$estado = 1;


    //la fecha no se puede formatear por es un objeto date, solo se formatea en el select, cuando se va a obtener una fecha, por lo tanto la fecha queda en el formato y/m/d en la tabla de la bd	

    $sql2 = "insert into Dproducto 
           values(null,now(),?,?,?,?,?,?,?,?,?,?,?);";


    $sql2 = $conectar->prepare($sql2);


    $sql2->bindValue(1, $numero_Dproducto);
    $sql2->bindValue(2, $productoc);
    $sql2->bindValue(3, $rinde);
    $sql2->bindValue(4, $costo);
    $sql2->bindValue(5, $categoria);
    $sql2->bindValue(6, $moneda);
    $sql2->bindValue(7, $subtotal);
    $sql2->bindValue(8, $total);
    $sql2->bindValue(9, $estado);
    $sql2->bindValue(10, $id_producto);
    $sql2->bindValue(11, $id_usuario);

    $sql2->execute();
  }

  //metodo para ver el detalle del proveedor en una compra en esta parte agrege sin saber la categoria
  public function get_detalle_producto($numero_Dproducto)
  {

    $conectar = parent::conexion();
    parent::set_names();

    $sql = "select c.fecha_Dproducto,c.numero_Dproducto, c.productoc,c.rinde,c.categoria,c.total,p.id_producto,p.productoc,p.id_categoria,p.fecha,p.estado
          from Dproducto as c, producto as p
          where 
          
          c.productoc=p.productoc
          and
          c.numero_Dproducto=?
          
          ;";

    //echo $sql; exit();

    $sql = $conectar->prepare($sql);


    $sql->bindValue(1, $numero_Dproducto);
    $sql->execute();
    return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
  }



  public function get_detalle($numero_Dproducto)
  {

    $conectar = parent::conexion();
    parent::set_names();

    $sql = "select d.numero_Dproducto,d.productoc,d.materiales,d.unidadm, d.moneda, d.precio,d.cantidad,d.importe, d.fecha_Dproducto,c.numero_Dproducto, c.moneda, c.subtotal,c.total,p.id_producto,p.productoc,p.fecha,p.estado
          from detalle_Dproducto as d, Dproducto as c, producto as p
          where 
          
          d.numero_Dproducto
          =c.numero_Dproducto
          and
          d.productoc=p.productoc
          and
          d.numero_Dproducto=?
          
          ;";

    //echo $sql; exit();

    $sql = $conectar->prepare($sql);


    $sql->bindValue(1, $numero_Dproducto);
    $sql->execute();
    $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);


    $html = "

              <thead style='background-color:#A9D0F5'>

                                    <th>Costo de Fabricacion</th>
                                    <th>Unidad de Medida</th>
                                    <th>Cantidad</th>
                                    <th>Precio Unidad</th>
                                    <th>Precio Final</th>
                                   
                                </thead>


                              ";



    foreach ($resultado as $row) {


      $unidad = '';



      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 0) {
        $unidadm = 'Bidon';
        $uni = "btn btn-success btn-md unidadm";
      }

      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 1) {
        $unidadm = 'Bolsa';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 2) {
        $unidadm = 'Tiempo';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 3) {
        $unidadm = 'Caja';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 4) {
        $unidadm = 'Paquete';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 5) {
        $unidadm = 'Fardo';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 6) {
        $unidadm = 'Galon';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 7) {
        $unidadm = 'Lata';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 8) {
        $unidadm = 'Libra';
        $uni = "btn btn-success btn-md unidadm";
      }

      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 9) {
        $unidadm = 'Litro';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 10) {
        $unidadm = 'Saco';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 11) {
        $unidadm = 'unidad';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 12) {
        $unidadm = 'Termo';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 13) {
        $unidadm = 'Onza';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 14) {
        $unidadm = 'Gramo';
        $uni = "btn btn-success btn-md unidadm";
      }


      $html .= "<tr class='filas'><td>" . $row['materiales'] . "</td> <td>" . $unidadm . "</td><td>" . $row['cantidad'] . "</td><td>" . $row["moneda"] . " " . $row['precio'] . "</td> <td>" . $row["moneda"] . " " . $row['importe'] . "</td></tr>";

      $subtotal = $row["moneda"] . " " . $row["subtotal"];
      $total = $row["moneda"] . " " . $row["total"];
    }

    $html .= "<tfoot>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>
                                     <p>SUB-TOTAL</p>
                                     <p class='margen_total'>TOTAL</p>
                                    </th>
                                    <th>

                                    <p><strong>" . $subtotal . "</strong></p>

                                     <p><strong>" . $total . "</strong></p>

                                    </th> 

                                    <tr>
                            
                        </tr>
                                </tfoot>";

    echo $html;
  }


  // esta es la parte donde imprime la informacion de el modal en detalles de Dproducto
  public function get_detalle_Dproducto_producto($numero_Dproducto)
  {

    $conectar = parent::conexion();
    parent::set_names();

    $sql = "select d.numero_Dproducto,d.productoc,d.materiales,d.unidadm, d.moneda, d.precio,d.cantidad,d.importe, d.fecha_Dproducto,c.numero_Dproducto,c.rinde ,c.moneda, c.subtotal,c.total,p.id_producto,p.productoc,p.fecha,p.estado
          from detalle_Dproducto as d, Dproducto as c, producto as p
          where 
          
          d.numero_Dproducto
          =c.numero_Dproducto
          and
          d.productoc=p.productoc
          and
          d.numero_Dproducto=?
          
          ;";

    //echo $sql; exit();

    $sql = $conectar->prepare($sql);


    $sql->bindValue(1, $numero_Dproducto);
    $sql->execute();
    $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);


    $html = "

              <thead style='background-color:#A9D0F5'>

                                    <th>Costo de Fabricacion</th>
                                    <th>Unidad de Medida</th>
                                    <th>Cantidad</th>
                                    <th>Precio Unidad</th>
                                    <th>Precio Final</th>
                                   
                                </thead>


                              ";



    foreach ($resultado as $row) {


      $unidad = '';



      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 0) {
        $unidadm = 'Bidon';
        $uni = "btn btn-success btn-md unidadm";
      }

      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 1) {
        $unidadm = 'Bolsa';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 2) {
        $unidadm = 'Tiempo';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 3) {
        $unidadm = 'Caja';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 4) {
        $unidadm = 'Paquete';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 5) {
        $unidadm = 'Fardo';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 6) {
        $unidadm = 'Galon';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 7) {
        $unidadm = 'Lata';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 8) {
        $unidadm = 'Libra';
        $uni = "btn btn-success btn-md unidadm";
      }

      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 9) {
        $unidadm = 'Litro';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 10) {
        $unidadm = 'Saco';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 11) {
        $unidadm = 'unidad';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 12) {
        $unidadm = 'Termo';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 13) {
        $unidadm = 'Onza';
        $uni = "btn btn-success btn-md unidadm";
      }
      $uni = "btn btn-success btn-md unidadm";
      if ($row["unidadm"] == 14) {
        $unidadm = 'Gramo';
        $uni = "btn btn-success btn-md unidadm";
      }


      $html .= "<tr class='filas'><td>" . $row['materiales'] . "</td> <td>" . $unidadm . "</td><td>" . $row['cantidad'] . "</td><td>" . $row["moneda"] . " " . $row['precio'] . "</td> <td>" . $row["moneda"] . " " . $row['importe'] . "</td></tr>";

      $rinde = $row["rinde"];
      $subtotal = $row["moneda"] . " " . $row["subtotal"];

      $total = $row["moneda"] . " " . $row["total"];
    }

    $html .= "<tfoot>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th>
                                    <br>

                                    <p>BOLSAS POR BATIDAS</p>
                                    <br>
                                     <p>TOTAL FORMULA</p>
                                     
                                    </th>
                                    <th>
                                    <br>

                                    <p><strong>" . $rinde . "</strong></p>
                                    <br>

                                    <p><strong>" . $subtotal . "</strong></p>

                                     

                                    </th> 

                                    <tr>
                            
                        </tr>
                                </tfoot>";

    echo $html;
  }


  /*cambiar estado de la compra, solo se cambia si se quiere eliminar una compra y se revertería la cantidad de compra al stock*/

  public function cambiar_estado($id_Dproducto, $numero_Dproducto, $est)
  {

    $conectar = parent::conexion();
    parent::set_names();

    //si estado es igual a 0 entonces lo cambia a 1
    $estado = 0;
    //el parametro est se envia por via ajax, viene del $est:est
    /*si el estado es ==0 cambiaria a PAGADO Y SE EJECUTARIA TODO LO QUE ESTA ABAJO*/
    if ($_POST["est"] == 0) {
      $estado = 1;


      //declaro $numero_compra, viene via ajax

      $numero_Dproducto = $_POST["numero_Dproducto"];


      $sql = "update Dproducto set 
            
            estado=?
            where 
            id_Dproducto=?
           
              ";

      // echo $sql; 

      $sql = $conectar->prepare($sql);

      $sql->bindValue(1, $estado);
      $sql->bindValue(2, $_POST["id_Dproducto"]);
      $sql->execute();

      $resultado = $sql->fetch(PDO::FETCH_ASSOC);


      $sql_detalle = "update detalle_Dproducto set

          estado=?
          where 
          numero_Dproducto=?
          ";

      $sql_detalle = $conectar->prepare($sql_detalle);

      $sql_detalle->bindValue(1, $estado);
      $sql_detalle->bindValue(2, $numero_Dproducto);
      $sql_detalle->execute();

      $resultado = $sql_detalle->fetch(PDO::FETCH_ASSOC);


      /*una vez se cambie de estado a ACTIVO entonces actualizamos la cantidad de stock en productos*/


      //INICIO CONSULTA DE DETALLE DE COMPRAS Y COMPRAS

      $sql2 = "select * from detalle_Dproducto where numero_Dproducto=?";

      $sql2 = $conectar->prepare($sql2);


      $sql2->bindValue(1, $numero_Dproducto);
      $sql2->execute();

      $resultado = $sql2->fetchAll();

      foreach ($resultado as $row) {

        $id_Mprima = $output["id_Mprima"] = $row["id_Mprima"];
        //selecciona la cantidad comprada
        $cantidad = $output["cantidad"] = $row["cantidad"];




        //si el id_producto existe entonces que consulte si la cantidad de productos existe en la tabla producto

        if (isset($id_Mprima) == true and count($id_Mprima) > 0) {

          $sql3 = "select * from Mprima where id_Mprima=?";

          $sql3 = $conectar->prepare($sql3);

          $sql3->bindValue(1, $id_Mprima);
          $sql3->execute();

          $resultado = $sql3->fetchAll();

          foreach ($resultado as $row2) {

            //este es la cantidad de stock para cada producto
            $stock = $output2["stock"] = $row2["stock"];

            //esta debe estar dentro del foreach para que recorra el $stock de los productos, ya que es mas de un producto que está asociado a la compra
            //cuando das click a estado pasa a PAGADO Y SUMA la cantidad de stock con la cantidad de compra
            $cantidad_actual = $stock + $cantidad;
          }
        }


        //LE ACTUALIZO LA CANTIDAD DEL PRODUCTO 

        $sql6 = "update Mprima set 
               stock=?
               where

               id_Mprima=?

               ";

        $sql6 = $conectar->prepare($sql6);

        $sql6->bindValue(1, $cantidad_actual);
        $sql6->bindValue(2, $id_Mprima);

        $sql6->execute();
      } //cierre del foreach

    } //cierre del if del estado

    else {

      /*si el estado es igual a 1, entonces pasaria a ANULADO y restaria la cantidad de productos al stock*/

      if ($_POST["est"] == 1) {
        $estado = 0;

        //declaro $numero_compra, viene via ajax

        $numero_Dproducto = $_POST["numero_Dproducto"];


        $sql = "update Dproducto set 
            
            estado=?
            where 
            id_Dproducto=?
           
              ";

        // echo $sql; 

        $sql = $conectar->prepare($sql);

        $sql->bindValue(1, $estado);
        $sql->bindValue(2, $_POST["id_Dproducto"]);
        $sql->execute();

        $resultado = $sql->fetch(PDO::FETCH_ASSOC);


        $sql_detalle = "update detalle_Dproducto set

          estado=?
          where 
          numero_Dproducto=?
          ";

        $sql_detalle = $conectar->prepare($sql_detalle);

        $sql_detalle->bindValue(1, $estado);
        $sql_detalle->bindValue(2, $numero_Dproducto);
        $sql_detalle->execute();

        $resultado = $sql_detalle->fetch(PDO::FETCH_ASSOC);



        /*una vez se cambie de estado a ACTIVO entonces actualizamos la cantidad de stock en productos*/


        //INICIO ACTUALIZAR LA CANTIDAD DE PRODUCTOS COMPRADOS EN EL STOCK

        $sql2 = "select * from detalle_Dproducto where numero_Dproducto=?";

        $sql2 = $conectar->prepare($sql2);


        $sql2->bindValue(1, $numero_Dproducto);
        $sql2->execute();

        $resultado = $sql2->fetchAll();

        foreach ($resultado as $row) {

          $id_Mprima = $output["id_Mprima"] = $row["id_Mprima"];
          //selecciona la cantidad comprada
          $cantidad = $output["cantidad"] = $row["cantidad"];




          //si el id_producto existe entonces que consulte si la cantidad de productos existe en la tabla producto

          if (isset($id_Mprima) == true and count($id_Mprima) > 0) {

            $sql3 = "select * from Mprima where id_Mprima=?";

            $sql3 = $conectar->prepare($sql3);

            $sql3->bindValue(1, $id_Mprima);
            $sql3->execute();

            $resultado = $sql3->fetchAll();

            foreach ($resultado as $row2) {

              //este es la cantidad de stock para cada producto
              $stock = $output2["stock"] = $row2["stock"];

              //esta debe estar dentro del foreach para que recorra el $stock de los productos, ya que es mas de un producto que está asociado a la compra
              //cuando le da click al estado pasa de PAGADO A ANULADO y resta la cantidad de stock en productos con la cantidad de compra de detalle_compras, disminuyendo de esta manera la cantidad actual de productos en el stock de productos
              $cantidad_actual = $stock - $cantidad;
            }
          }


          //LE ACTUALIZO LA CANTIDAD DEL PRODUCTO 

          $sql6 = "update Mprima set 
               stock=?
               where

               id_Mprima=?

               ";

          $sql6 = $conectar->prepare($sql6);

          $sql6->bindValue(1, $cantidad_actual);
          $sql6->bindValue(2, $id_Mprima);

          $sql6->execute();
        } //cierre del foreach



      } //cierre del if del estado del else


    }
  } //CIERRE DEL METODO



  //BUSCA REGISTROS COMPRAS-FECHA

  public function lista_busca_registros_fecha($fecha_inicial, $fecha_final)
  {

    $conectar = parent::conexion();


    $date_inicial = $_POST["fecha_inicial"];
    $date = str_replace('/', '-', $date_inicial);
    $fecha_inicial = date("Y-m-d", strtotime($date));

    $date_final = $_POST["fecha_final"];
    $date = str_replace('/', '-', $date_final);
    $fecha_final = date("Y-m-d", strtotime($date));



    $sql = "SELECT * FROM Dproducto WHERE fecha_Dproducto>=? and fecha_Dproducto<=? ";



    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $fecha_inicial);
    $sql->bindValue(2, $fecha_final);
    $sql->execute();
    return $result = $sql->fetchAll(PDO::FETCH_ASSOC);
  }



  //BUSCA REGISTROS COMPRAS-FECHA-MES

  public function lista_busca_registros_fecha_mes($mes, $ano)
  {

    $conectar = parent::conexion();


    //variables que vienen por POST VIA AJAX
    $mes = $_POST["mes"];
    $ano = $_POST["ano"];



    $fecha = ($ano . "-" . $mes . "%");

    //la consulta debe hacerse asi para seleccionar el mes/ano

    /*importante: explicacion de cuando se pone el like y % en una consulta: like sirve para buscar una palabra en especifica dentro de la columna, por ejemplo buscar 09 dentro de 2017-09-04. Los %% se ocupan para indicar en que parte se quiere buscar, si se pone like '%queBusco' significa que lo buscas al final de una cadena, si pones 'queBusco%' significa que se busca al principio de la cadena y si pones '%queBusco%' significa que lo busca en medio, asi la imprimo la consulta en phpmyadmin SELECT * FROM compras WHERE fecha_compra like '2017-09%'*/


    $sql = "SELECT * FROM Dproducto WHERE fecha_Dproducto like ? ";

    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $fecha);
    $sql->execute();
    return $result = $sql->fetchAll(PDO::FETCH_ASSOC);
  }


  public function get_Dproducto_por_id_producto($id_producto)
  {

    $conectar = parent::conexion();


    $sql = "select * from Dproducto where id_producto=?";

    $sql = $conectar->prepare($sql);

    $sql->bindValue(1, $id_producto);
    $sql->execute();

    return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
  }

  public function get_detalle_Dproducto_por_id_producto($id_producto)
  {

    $conectar = parent::conexion();


    $sql = "select * from detalle_Dproducto where id_producto=?";

    $sql = $conectar->prepare($sql);

    $sql->bindValue(1, $id_producto);
    $sql->execute();

    return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
  }

  public function get_Batida_por_id_usuario($id_usuario)
  {

    $conectar = parent::conexion();


    $sql = "select * from Dproducto where id_usuario=?";

    $sql = $conectar->prepare($sql);

    $sql->bindValue(1, $id_usuario);
    $sql->execute();

    return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
  }

  public function get_Dproducto_por_id_estado($id_Dproducto, $estado)
  {

    $conectar = parent::conexion();

    //declaramos que el estado esté activo, igual a 1

    $estado = 1;


    $sql = "select p.id_Dproducto,p.fecha_Dproducto,p.numero_Dproducto,p.productoc,p.categoria,p.moneda,p.subtotal,p.total,p.estado,p.id_producto,c.id_detalle_Dproducto,c.numero_Dproducto,c.productoc,c.id_Mprima,c.materiales,c.unidadm,c.moneda,c.precio,c.cantidad,c.importe,c.subtotal,c.total,c.fecha_Dproducto,c.estado,m.stock

          from Dproducto as p, detalle_Dproducto as c,Mprima as m
          where 
          p.fecha_Dproducto
          =c.fecha_Dproducto
          and
          p.numero_Dproducto
          =c.numero_Dproducto
          and
          p.productoc
          =c.productoc
          and
          p.moneda
          =c.moneda
          and
          p.estado
          =c.estado

          GROUP BY p.numero_Dproducto
          ;";

    $sql = $conectar->prepare($sql);

    $sql->bindValue(1, $id_Dproducto);
    $sql->bindValue(2, $estado);
    $sql->execute();

    return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
  }




  public function get_detalle_Dproducto_por_id_usuario($id_usuario)
  {

    $conectar = parent::conexion();


    $sql = "select * from detalle_Dproducto where id_usuario=?";

    $sql = $conectar->prepare($sql);

    $sql->bindValue(1, $id_usuario);
    $sql->execute();

    return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
  }



  /*REPORTES COMPRAS*/


  public function get_Dproducto_reporte_general()
  {

    $conectar = parent::conexion();
    parent::set_names();


    //hacer la consulta que seleccione la fecha de mayor a menos


    $sql = "SELECT MONTHname(fecha_compra) as mes, MONTH(fecha_compra) as numero_mes, YEAR(fecha_compra) as ano, SUM(total) as total_compra, moneda
        FROM compras where estado='1' GROUP BY YEAR(fecha_compra) desc, month(fecha_compra) desc";


    $sql = $conectar->prepare($sql);

    $sql->execute();
    return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
  }

  //suma el total de compras por año

  public function suma_Dproducto_total_ano()
  {

    $conectar = parent::conexion();


    $sql = "SELECT YEAR(fecha_compra) as ano,SUM(total) as total_compra_ano, moneda FROM compras where estado='1' GROUP BY YEAR(fecha_compra) desc";

    $sql = $conectar->prepare($sql);
    $sql->execute();

    return $resultado = $sql->fetchAll();
  }

  //recorro el array para traerme la lista de una en vez de traerlo con el return, y hago el formato para la grafica
  //suma total por año 
  public function suma_Dproducto_total_grafica()
  {

    $conectar = parent::conexion();


    $sql = "SELECT YEAR(fecha_compra) as ano,SUM(total) as total_compra_ano FROM compras where estado='1' GROUP BY YEAR(fecha_compra) desc";

    $sql = $conectar->prepare($sql);
    $sql->execute();

    $resultado = $sql->fetchAll();

    //recorro el array y lo imprimo
    foreach ($resultado as $row) {

      $ano = $output["ano"] = $row["ano"];
      $p = $output["total_compra_ano"] = $row["total_compra_ano"];

      echo $grafica = "{name:'" . $ano . "', y:" . $p . "},";
    }
  }

  public function suma_compras_canceladas_total_grafica()
  {

    $conectar = parent::conexion();


    $sql = "SELECT YEAR(fecha_compra) as ano,SUM(total) as total_compra_ano FROM compras where estado='0' GROUP BY YEAR(fecha_compra) desc";

    $sql = $conectar->prepare($sql);
    $sql->execute();

    $resultado = $sql->fetchAll();

    //recorro el array y lo imprimo
    foreach ($resultado as $row) {

      $ano = $output["ano"] = $row["ano"];
      $p = $output["total_compra_ano"] = $row["total_compra_ano"];

      echo $grafica = "{name:'" . $ano . "', y:" . $p . "},";
    }
  }


  /*REPORTE DE COMPRAS MENSUAL*/

  public function suma_Dproducto_anio_mes_grafica($fecha)
  {

    $conectar = parent::conexion();
    parent::set_names();

    //se usa para traducir el mes en la grafica
    //imprime la fecha por separado ejemplo: dia, mes y año
    $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");



    //SI EXISTE EL ENVIO POST ENTONCES SE MUESTRA LA FECHA SELECCIONADA
    if (isset($_POST["year"])) {

      $fecha = $_POST["year"];

      $sql = "SELECT YEAR(fecha_Dproducto) as ano, MONTHname(fecha_Dproducto) as mes, SUM(total) as total_Dproducto_mes FROM Dproducto WHERE YEAR(fecha_Dproducto)=? and estado='1' GROUP BY MONTHname(fecha_Dproducto) desc";

      $sql = $conectar->prepare($sql);
      $sql->bindValue(1, $fecha);
      $sql->execute();

      $resultado = $sql->fetchAll();

      //recorro el array y lo imprimo
      foreach ($resultado as $row) {


        $ano = $output["mes"] = $meses[date("n", strtotime($row["mes"])) - 1];
        $p = $output["total_Dproducto_mes"] = $row["total_Dproducto_mes"];

        echo $grafica = "{name:'" . $ano . "', y:" . $p . "},";
      }
    } else {


      //sino se envia el POST, entonces se mostraria los datos del año actual cuando se abra la pagina por primera vez

      $fecha_inicial = date("Y");


      $sql = "SELECT YEAR(fecha_Dproducto) as ano, MONTHname(fecha_Dproducto) as mes, SUM(total) as total_Dproducto_mes FROM Dproducto WHERE YEAR(fecha_Dproducto)=? and estado='1' GROUP BY MONTHname(fecha_Dproducto) desc";

      $sql = $conectar->prepare($sql);
      $sql->bindValue(1, $fecha_inicial);
      $sql->execute();

      $resultado = $sql->fetchAll();

      //recorro el array y lo imprimo
      foreach ($resultado as $row) {

        $ano = $output["mes"] = $meses[date("n", strtotime($row["mes"])) - 1];
        $p = $output["total_Dproducto_mes"] = $row["total_Dproducto_mes"];

        echo $grafica = "{name:'" . $ano . "', y:" . $p . "},";
      } //cierre del foreach


    } //cierre del else


  }


  public function get_year_Dproducto()
  {

    $conectar = parent::conexion();

    $sql = "select year(fecha_Dproducto) as fecha from Dproducto group by year(fecha_Dproducto) asc";


    $sql = $conectar->prepare($sql);
    $sql->execute();
    return $resultado = $sql->fetchAll();
  }


  public function get_Dproducto_mensual($fecha)
  {


    $conectar = parent::conexion();


    if (isset($_POST["year"])) {

      $fecha = $_POST["year"];

      $sql = "select MONTHname(fecha_Dproducto) as mes, MONTH(fecha_Dproducto) as numero_mes, YEAR(fecha_Dproducto) as ano, SUM(total) as total_Dproducto, moneda
        from Dproducto where YEAR(fecha_Dproducto)=? and estado='1' group by MONTHname(fecha_Dproducto) asc";


      $sql = $conectar->prepare($sql);
      $sql->bindValue(1, $fecha);
      $sql->execute();
      return $resultado = $sql->fetchAll();
    } else {

      //sino se envia el POST, entonces se mostraria los datos del año actual cuando se abra la pagina por primera vez

      $fecha_inicial = date("Y");

      $sql = "select MONTHname(fecha_Dproducto) as mes, MONTH(fecha_Dproducto) as numero_mes, YEAR(fecha_Dproducto) as ano, SUM(total) as total_Dproducto, moneda
            from Dproducto where YEAR(fecha_Dproducto)=? and estado='1' group by MONTHname(fecha_Dproducto) asc";


      $sql = $conectar->prepare($sql);
      $sql->bindValue(1, $fecha_inicial);
      $sql->execute();
      return $resultado = $sql->fetchAll();
    } //cierre del else

  }



  /*REPORTE POR RANGO DE FECHA Y PROVEEDOR No se si se pueden usar aun_________________ revisa luego
         */


  public function get_pedido_por_fecha($dui, $fecha_inicial, $fecha_final)
  {

    $conectar = parent::conexion();
    parent::set_names();


    $date_inicial = $_POST["datepicker"];
    $date = str_replace('/', '-', $date_inicial);
    $fecha_inicial = date("Y-m-d", strtotime($date));


    $date_final = $_POST["datepicker2"];
    $date = str_replace('/', '-', $date_final);
    $fecha_final = date("Y-m-d", strtotime($date));


    $sql = "select * from detalle_compras where dui_proveedor=? and fecha_compra>=? and fecha_compra<=? and estado='1';";


    $sql = $conectar->prepare($sql);

    $sql->bindValue(1, $dui);
    $sql->bindValue(2, $fecha_inicial);
    $sql->bindValue(3, $fecha_final);
    $sql->execute();

    return $resultado = $sql->fetchAll(PDO::FETCH_ASSOC);
  }



  public function get_cant_productos_por_fecha($dui, $fecha_inicial, $fecha_final)
  {

    $conectar = parent::conexion();
    parent::set_names();

    $date_inicial = $_POST["datepicker"];
    $date = str_replace('/', '-', $date_inicial);
    $fecha_inicial = date("Y-m-d", strtotime($date));


    $date_final = $_POST["datepicker2"];
    $date = str_replace('/', '-', $date_final);
    $fecha_final = date("Y-m-d", strtotime($date));


    $sql = "select sum(cantidad_compra) as total from detalle_compras where dui_proveedor=? and fecha_compra >=? and fecha_compra <=? and estado = '1';";


    $sql = $conectar->prepare($sql);

    $sql->bindValue(1, $dui);
    $sql->bindValue(2, $fecha_inicial);
    $sql->bindValue(3, $fecha_final);
    $sql->execute();

    return $resultado = $sql->fetch(PDO::FETCH_ASSOC);
  }



  public function get_compras_anio_actual()
  {

    $conectar = parent::conexion();
    parent::set_names();

    $sql = "SELECT YEAR(fecha_compra) as ano, MONTHname(fecha_compra) as mes, SUM(total) as total_compra_mes, moneda FROM compras WHERE YEAR(fecha_compra)=YEAR(CURDATE()) and estado='1' GROUP BY MONTHname(fecha_compra) desc";

    $sql = $conectar->prepare($sql);
    $sql->execute();
    return $resultado = $sql->fetchAll();
  }


  public function get_compras_anio_actual_grafica()
  {

    $conectar = parent::conexion();
    parent::set_names();

    $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

    $sql = "SELECT  MONTHname(fecha_compra) as mes, SUM(total) as total_compra_mes FROM compras WHERE YEAR(fecha_compra)=YEAR(CURDATE()) and estado='1' GROUP BY MONTHname(fecha_compra) desc";

    $sql = $conectar->prepare($sql);
    $sql->execute();

    $resultado = $sql->fetchAll();

    //recorro el array y lo imprimo
    foreach ($resultado as $row) {


      $mes = $output["mes"] = $meses[date("n", strtotime($row["mes"])) - 1];
      $p = $output["total_compra_mes"] = $row["total_compra_mes"];

      echo $grafica = "{name:'" . $mes . "', y:" . $p . "},";
    }
  }
}

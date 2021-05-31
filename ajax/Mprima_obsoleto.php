//unidad de medida
        $unidadm = '';
       
         $atrib = "btn btn-success btn-md unidadm";
        if($row["unidadm"] == 0){
          $unidadm = 'Bidon';
          $atrib = "btn btn-warning btn-md unidadm";
        }
        if($row["unidadm"] == 1){
          $unidadm = 'Bolsa';
          $atrib = "btn btn-warning btn-md unidadm";
        }
        if($row["unidadm"] == 2){
          $unidadm = 'Bote';
          $atrib = "btn btn-warning btn-md unidadm";
        }
        if($row["unidadm"] == 3){
          $unidadm = 'Caja';
          $atrib = "btn btn-warning btn-md unidadm";
        }
        if($row["unidadm"] == 4){
          $unidadm = 'Cubeta';
          $atrib = "btn btn-warning btn-md unidadm";
        }
        if($row["unidadm"] == 5){
          $unidadm = 'Fardo';
          $atrib = "btn btn-warning btn-md unidadm";
        }
        if($row["unidadm"] == 6){
          $unidadm = 'Galon';
          $atrib = "btn btn-warning btn-md unidadm";
        }
        if($row["unidadm"] == 7){
          $unidadm = 'Lata';
          $atrib = "btn btn-warning btn-md unidadm";
        }
        if($row["unidadm"] == 8){
          $unidadm = 'Libra';
          $atrib = "btn btn-warning btn-md unidadm";
        }
        if($row["unidadm"] == 9){
          $unidadm = 'Litro';
          $atrib = "btn btn-warning btn-md unidadm";
        }

        if($row["unidadm"] == 10){
          $unidadm = 'saco';
          $atrib = "btn btn-warning btn-md unidadm";
        }

        if($row["unidadm"] == 11){
          $unidadm = 'unidad';
          $atrib = "btn btn-warning btn-md unidadm";
        }

        if($row["unidadm"] == 12){
          $unidadm = 'Termo';
          $atrib = "btn btn-warning btn-md unidadm";
        }

        if($row["unidadm"] == 13){
          $unidadm = 'onza';
          $atrib = "btn btn-warning btn-md unidadm";
        }

        if($row["unidadm"] == 14){
          $unidadm = 'Gramo';
          $atrib = "btn btn-warning btn-md unidadm";
        }






         $unidadm = '';

        $uni = "btn btn-success btn-md unidadm";
        if($row["unidadm"] == 0){
          $unidadm = 'Bidon';
          $uni = "btn btn-success btn-md unidadm";
        }

        else{
        
        $uni = "btn btn-success btn-md unidadm";
        if($row["unidadm"] == 1){
          $unidadm = 'Bolsa';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if($row["unidadm"] == 2){
          $unidadm = 'Bote';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if($row["unidadm"] == 3){
          $unidadm = 'Caja';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if($row["unidadm"] == 4){
          $unidadm = 'Cubeta';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if($row["unidadm"] == 5){
          $unidadm = 'Fardo';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if($row["unidadm"] == 6){
          $unidadm = 'Galon';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if($row["unidadm"] == 7){
          $unidadm = 'Lata';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if($row["unidadm"] == 8){
          $unidadm = 'Libra';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if($row["unidadm"] == 9){
          $unidadm = 'Litro';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if($row["unidadm"] == 10){
          $unidadm = 'Saco';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if($row["unidadm"] == 11){
          $unidadm = 'unidad';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if($row["unidadm"] == 12){
          $unidadm = 'Termo';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if($row["unidadm"] == 13){
          $unidadm = 'Onza';
          $uni = "btn btn-success btn-md unidadm";
        }
        $uni = "btn btn-success btn-md unidadm";
        if($row["unidadm"] == 14){
          $unidadm = 'Gramo';
          $uni = "btn btn-success btn-md unidadm";
        }



        public function agrega_update()
  {


    $str = '';
    $formula = array();
    $formula = json_decode($_POST['arrayformula']);
    $conectar = parent::conexion();

    foreach ($formula as $k => $v) {

      $cantidad = $v->cantidad;
      $codMpri = $v->codMpri;
      $materiales = $v->materiales;
      $unidadm = $v->unidadm;
      $moneda = $v->moneda;
      $precio = $v->precio;
      $importe = $v->importe;
      //$total = $v->total;
      $estado = $v->estado;

      $rinde = $v->rinde;
    $costo = $v->costo;
    $numero_Dproducto = $v->numero_Dproducto;

    $productoc = $v->productoc;
    $categoria = $v->categoria;
    $id_Dproducto = $v->id_Dproducto;
    $id_detalle_Dproducto = $v->id_detalle_Dproducto;
    
      $total = $_POST["total"];
      $id_usuario = $_POST["id_usuario"];
      $id_producto = $_POST["id_producto"];



      $sql = "update detalle_Dproducto
      set 
      numero_Dproducto=?,
      productoc=?,
      codMprima=?,
      materiales=?,
      unidadm=?,
      moneda=?,
      precio=?,
      cantidad=?,
      importe=?,
      id_usuario=?,
      now(),
      id_producto=?,
      estado=?
      where
      id_Dproducto=?

      ";
    $sql = $conectar->prepare($sql);

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
    $sql->bindValue(13, $id_detalle_Dproducto);

      $sql->execute();


      $sql3 = "select * from Mprima where id_Mprima=?;";

      $sql3 = $conectar->prepare($sql3);

      $sql3->bindValue(1, $codMpri);
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
        $sql4->bindValue(2, $codMpri);
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
    now(),
    productoc=?,
    rinde=?,
    costo=?,
    categoria=?,
    moneda=?,
    subtotal=?,
    total=?,
    estado=?,
    id_producto=?,
    id_usuario=?,
    where
    id_detalle_Dproducto=?
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
    $sql2->bindValue(12, $id_detalle_Dproducto);

    $sql2->execute();
  }


  public function agrega_formula()
  {


    $str = '';
    $formula = array();
    $formula = json_decode($_POST['arrayDproducto']);
    $conectar = parent::conexion();

    foreach ($formula as $k => $v) {

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
    $numero_Dproducto = $v->numero_Dproducto;

    $productoc = $v->productoc;
    $categoria = $v->categoria;
    $id_Dproducto = $v->id_Dproducto;
    $id_detalle_Dproducto = $v->id_detalle_Dproducto;
    
      $total = $_POST["total"];
      $id_usuario = $_POST["id_usuario"];
      $id_producto = $_POST["id_producto"];



      $sql = "update detalle_Dproducto
      set 
      numero_Dproducto=?,
      productoc=?,
      id_Mprima=?,
      materiales=?,
      unidadm=?,
      moneda=?,
      precio=?,
      cantidad=?,
      importe=?,
      id_usuario=?,
      id_producto=?,
      estado=?
      where
      id_detalle_Dproducto=?

      ";
    $sql = $conectar->prepare($sql);

    $sql->bindValue(1, $numero_Dproducto);
    $sql->bindValue(2, $productoc);
    $sql->bindValue(3, $id_Mprima);
    $sql->bindValue(4, $materiales);
    $sql->bindValue(5, $unidadm);
    $sql->bindValue(6, $moneda);
    $sql->bindValue(7, $precio);
    $sql->bindValue(8, $cantidad);
    $sql->bindValue(9, $importe);
    $sql->bindValue(10, $id_usuario);
    $sql->bindValue(11, $id_producto);
    $sql->bindValue(12, $estado);
    $sql->bindValue(13, $id_detalle_Dproducto);

      $sql->execute();


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
    id_usuario=?,
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
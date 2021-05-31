DELIMITER //
CREATE PROCEDURE update_insert(
    IN _id_detalle_Dproducto int(11),
    _numero_Dproducto varchar(100),
      _productoc varchar(100),
      _id_Mprima int(11),
      _materiales varchar(100),
      _unidadm enum('0','1','2','3','4','5','6','7','8','9','10','11','12','13','14'),
      _moneda varchar(100),
      _precio decimal(11,6),
      _cantidad decimal(11,6),
      _importe decimal(11,6),
      _fecha_Dproducto date,
      _id_usuario int(11),
      _id_producto int(11),
      _estado enum('0','1')
)BEGIN
    SELECT * FROM detalle_dproducto WHERE  
    column1 = _id_detalle_Dproducto AND
    column2 = _numero_Dproducto AND 
    column3 = _productoc AND
    column4 = _id_Mprima AND 
    column5 = _materiales AND
    column6 = _unidadm AND 
    column7 = _moneda AND
    column8 = _precio AND
    column9 = _cantidad AND
    column10 = _importe AND
    column11 = _fecha_Dproducto AND
    column12 = _id_usuario AND
    column13 = _estado 
    ;
    IF _id_detalle_Dproducto = 0 THEN 
    UPDATE detalle_dproducto SET 
       column1 = _id_detalle_Dproducto,
       column2 = _numero_Dproducto, 
       column3 = _productoc, 
       column4 = _id_Mprima,
       column5 = _materiales,
       column6 = _unidadm,
       column7 = _moneda,
       column8 = _precio,
       column9 = _cantidad,
       column10 = _importe,
       column11 = _fecha_Dproducto,
       column12 = _id_usuario,
       column13 = _estado 
       WHERE id = _id_detalle_Dproducto
       ;
        
   ELSE

   INSERT INTO detalle_dproducto (column2, column3,column4,column5,column6,column7,column8,column9,column10,column11,column12,columna13)
        VALUES (numero_Dproducto,_productoc ,_id_Mprima,_materiales,_unidadm,_moneda,_precio,_cantidad,_importe,_fecha_Dproducto,_id_usuario,_estado);
       
   END IF;
END
 //DELIMITER ;

//otro
 DELIMITER //
CREATE PROCEDURE updatei(
    IN @id_detalle_Dproducto int(11),
    @numero_Dproducto varchar(100),
     @productoc varchar(100),
      @id_Mprima int(11),
      @materiales varchar(100),
      @unidadm enum('0','1','2','3','4','5','6','7','8','9','10','11','12','13','14'),
      @moneda varchar(100),
      @precio decimal(11,6),
      @cantidad decimal(11,6),
      @importe decimal(11,6),
      @fecha_Dproducto date,
      @id_usuario int(11),
      @id_producto int(11),
      @estado enum('0','1')
)BEGIN
   
    IF _id_detalle_Dproducto = 0 THEN 
    UPDATE detalle_dproducto SET 
       column1 = @id_detalle_Dproducto,
       column2 = @numero_Dproducto, 
       column3 = @productoc, 
       column4 = @id_Mprima,
       column5 = @materiales,
       column6 = @unidadm,
       column7 = @moneda,
       column8 = @precio,
       column9 = @cantidad,
       column10 = @importe,
       column11 = @fecha_Dproducto,
       column12 = @id_usuario,
       column13 = @estado 
       WHERE id = @id_detalle_Dproducto
       ;
        
   ELSE

   INSERT INTO detalle_dproducto (column2, column3,column4,column5,column6,column7,column8,column9,column10,column11,column12,columna13)
        VALUES (@numero_Dproducto,@productoc ,@id_Mprima,@materiales,@unidadm,@moneda,@precio,@cantidad,@importe,@fecha_Dproducto,@id_usuario,@estado);
       
   END IF;
END
 //DELIMITER ;
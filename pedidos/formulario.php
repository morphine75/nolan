<?php
include("../inc/conexion.php");
conectar();
?>
  <div> 
   <?php
   if($_REQUEST['id']>0){
    $titulo="Editar Pedido";
    $id=$_REQUEST['id'];
    $sql=mysqli_query($conn,"SELECT ID_PEDIDO, P.ID_CLIENTE, P.ID_VENDEDOR, C.NOM_CLIENTE, V.NOM_VENDEDOR, FECHA, HORA, TOTAL from pedidos P, clientes C, vendedores V where P.ID_CLIENTE=C.ID_CLIENTE AND P.ID_VENDEDOR=V.ID_VENDEDOR AND ID_PEDIDO=".$id);
    $row=mysqli_fetch_assoc($sql);
    ?>
    <script>seleccionar_cliente(<?php echo $row['ID_CLIENTE']?>)</script>
  <?php
    $sqlD="SELECT a.ID_ARTICULO, a.DESCRIPCION, p.PRECIO AS P_UNITARIO, d.CANT, a.CANTXCAJA, d.BONIF, d.PRECIO, s.CANTIDAD_DISPONIBLE from detalle_pedido d, articulos a, precio_venta p, stock_almacen s where a.ID_ARTICULO=d.ID_ARTICULO AND p.ID_ARTICULO=a.ID_ARTICULO AND s.ID_ARTICULO=a.ID_ARTICULO and s.ID_ALMACEN=1 AND d.ID_PEDIDO=".$id;
    $resD=mysqli_query($conn, $sqlD);
  }
  else{
    $titulo="Nuevo Pedido";
    $id=0;
  }
  ?>
  <h2><?php echo $titulo; ?></h2>
  <fieldset>
    <form method="post" id="formulario">
      <div class="row">
        <div class="col-md-12" style="box-shadow: 10px 10px 5px grey; background-color: #e6f2ff;">
          <div id="txt_clientes">
            <hr>
            <p class="p_form"><label>Nombre Cliente:</label>
              <input type="text" size="40" class="e_form" name="nombre" id="nombre" value="<?php if(isset($row)) { echo $row['NOM_CLIENTE'];}?>" onKeyUp="busca_clientes(this.value)"/>
            </p>
          </div>
          <div class="col-md-12" id="lista_clientes"></div>
        </div>
        <div class="col-md-6" style="box-shadow: 10px 10px 5px grey;">
          <br>
          <p class="p_form"><label>Total Pedido:</label>
            <input type="text" size="10" class="e_form inactivo" name="total" id="total" value="<?php if(isset($row)) { echo $row['TOTAL'];}?>" readonly/>
          </p>
          <br>           
        </div>
        <div class="col-md-6" style="box-shadow: 10px 10px 5px grey;">        
          <br>
          <p class="p_form"><label>Fecha:</label>
            <input type="text" size="10" class="e_form" name="fecha" id="fecha" value="<?php if(isset($row)) { echo $row['FECHA'];} else { echo date('Y-m-d');}?>" readonly/>
          </p> 
          <br>       
        </div>
      </div>
      <hr>
      <div id="detalle">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Codigo</th>
              <th>Articulo</th>
              <th>Precio Unitario</th>
              <th>Cant.Bultos</th>
              <th>Cant.Unidades</th>
              <th>Bonif.</th>
              <th>Subtotal</th>
              <th>Accion</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <td colspan="8"><a href="#" class="btn btn-primary" style="width: 100%" onclick="agregar_fila()">Agregar Fila</a></td>
            </tr>
          </tfoot>          
          <tbody id="body_pedido">
            <?php
            $i=0;
            if ($id>0){
              while ($rowD=mysqli_fetch_assoc($resD)){
                ?>
                <tr id="tr_<?php echo $i?>">
                  <td><input type="text" size="7" name="codigo[]" id="codigo" onblur="busca_art_codigo(this.value, <?php echo $i?>)" value="<?php echo $rowD['ID_ARTICULO']?>"></td>
                  <td><input type="text" name="articulo[]" size="30" id="articulo<?php echo $i?>" value="<?php echo $rowD['DESCRIPCION']?>"></td>
                  <td><span id="precio<?php echo $i?>"><?php echo $rowD['P_UNITARIO']; ?></span></td>
                  <td><input type="text" name="cantidad[]" size="5" id="cantidad<?php echo $i?>" onkeyup="calcula_st(this.value,0,<?php echo $i?>)" value="<?php echo floor($rowD['CANT']/$rowD['CANTXCAJA'])?>"></td>
                  <td><input type="text" name="unidades[]" size="5" id="unidades<?php echo $i?>" onkeyup="calcula_st(this.value,1,<?php echo $i?>)" value="<?php echo ($rowD['CANT']%$rowD['CANTXCAJA'])?>"></td>
                  <td><input type="number" name="bonif[]" size="5" id="bonif'+filas_detalle_pedido+'" onkeyup="calcula_descuento(this.value,<?php echo $i?>)" value="<?php echo $rowD['BONIF']?>"> %</td>
                  <td><span id="subtotal<?php echo $i?>"><?php echo $rowD['PRECIO']?></span></td>
                  <td><a href="#" onclick="quitar_fila_dr(<?php echo $i?>)"><span class="glyphicon glyphicon-trash"></span></a></td>
                </tr>
                <input type="hidden" name="cantxcaja[]" id="cantxcaja<?php echo $i?>" value="<?php echo $rowD['CANTXCAJA']?>">
                <input type="hidden" name="subtotal_linea[]" id="subtotal_linea<?php echo $i?>" value="<?php echo $rowD['PRECIO']?>">
                <input type="hidden" name="stock[]" id="stock<?php echo $i?>" value="<?php echo $rowD['CANTIDAD_DISPONIBLE']?>">;
                </tr>
              <?php
              $i++;
              }
            }
            ?>
            <input type="hidden" id="filas_detalle_pedido" value=<?php echo $i?>>
          </tbody>
        </table>
      </div>
    </form>
    <div class="modal-footer">  
      <button class="btn btn-primary" data-dismiss="modal" onclick="controlar('pedidos',<?php echo $id; ?>)"  style="margin-left: 10px; border:none"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button> <button type="button" class="btn btn-default" data-dismiss="modal" onclick="limpia_div()">Cancelar</button>
    </div>
  </fieldset>
</div>
<?php
desconectar();
?>
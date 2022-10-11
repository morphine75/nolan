<?php
include("../../inc/conexion.php");
conectar();
$nombre=$_GET['nombre'];
$lista=$_GET['lista'];
$fila=$_GET['fila'];
$sql="SELECT DISTINCT (p.ID_ARTICULO), a.DESCRIPCION, a.CANTXCAJA, p.PRECIO, s.CANTIDAD_DISPONIBLE FROM articulos a, precio_venta p, stock_almacen s WHERE p.ID_ARTICULO=a.ID_ARTICULO and s.ID_ARTICULO=a.ID_ARTICULO and p.ID_LISTA=".$lista." and p.ID_ARTICULO=a.ID_ARTICULO and s.ID_ALMACEN=1 and p.ID_ARTICULO=".$nombre;
$res=mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($res);
?>
                  <td><input type="text" class="inactivo" readonly="readonly" size="7" name="codigo[]" id="codigo<?php echo $fila?>" value="<?php echo $row['ID_ARTICULO']?>"></td>
                  <td><input type="text"  name="articulo[]" size="30" id="articulo<?php echo $fila?>" value="<?php echo $row['DESCRIPCION'];?>"></td>
                  <td><span id="precio<?php echo $fila?>"><?php echo $row['PRECIO'];?></span></td>
                  <td><input type="number" name="cantidad[]" size="5" id="cantidad<?php echo $fila?>" onkeyup="calcula_st(this.value,0,<?php echo $fila?>)"></td>
                  <td><input type="number" name="unidades[]" size="5" id="unidades<?php echo $fila?>" onkeyup="calcula_st(this.value,1,<?php echo $fila?>)"></td>
                  <td><input type="number" name="bonif[]" size="5" id="bonif<?php echo $fila?>" onkeyup="calcula_descuento(this.value,<?php echo $fila?>)"> %</td>
                  <td><span id="subtotal<?php echo $fila?>"></span></td>
                  <td><a href="#" onclick="quitar_fila_dr(<?php echo $fila?>)"><span class="glyphicon glyphicon-trash"></span></a></td>
                <input type="hidden" name="cantxcaja[]" id="cantxcaja<?php echo $fila?>" value="<?php echo $row['CANTXCAJA'];?>">
                <input type="hidden" name="subtotal_linea[]" id="subtotal_linea<?php echo $fila?>">
                <input type="hidden" name="stock[]" id="stock<?php echo $fila?>" value="<?php echo $row['CANTIDAD_DISPONIBLE'];?>">
<?php               
desconectar();
?>
<?php
include("../../inc/conexion.php");
conectar();

$id=$_REQUEST['id'];
$lista=$_REQUEST['lista'];

$sql="SELECT a.DESCRIPCION, a.CANTXCAJA, p.PRECIO, s.CANTIDAD_DISPONIBLE FROM articulos a, precio_venta p, stock_almacen s WHERE p.ID_ARTICULO=a.ID_ARTICULO and s.ID_ARTICULO=a.ID_ARTICULO and p.ID_LISTA=".$lista." and p.ID_ARTICULO=".$id." and s.ID_ALMACEN=1";
$res=mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($res);

echo $row['DESCRIPCION']."***".$row['CANTXCAJA']."***".$row['PRECIO']."***".$row['CANTIDAD_DISPONIBLE'];

desconectar();
?>
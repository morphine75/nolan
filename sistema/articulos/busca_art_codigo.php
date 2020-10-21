<?php
include("../../inc/conexion.php");
conectar();

$id=$_REQUEST['id'];
$lista=$_REQUEST['lista'];

$sql="SELECT a.DESCRIPCION, a.CANTXCAJA, 
(SELECT p.PRECIO from precio_venta p where p.ID_ARTICULO=a.ID_ARTICULO and p.ID_LISTA=".$lista.") as PRECIO,
(SELECT s.CANTIDAD_DISPONIBLE from stock_almacen s where a.ID_ARTICULO=s.ID_ARTICULO and s.ID_ALMACEN=1) as CANTIDAD_DISPONIBLE
FROM articulos a WHERE a.ID_ARTICULO=".$id;
$res=mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($res);

$cantxcaja=0;
$precio=0;
$cantidad=0;

if (is_null($row['CANTXCAJA'])){
	$cantxcaja=0;
}
else{
	$cantxcaja=$row['CANTXCAJA'];
}
if (is_null($row['PRECIO'])){
	$precio=0;
}
else{
	$precio=$row['PRECIO'];
}
if (is_null($row['CANTIDAD_DISPONIBLE'])){
	$cantidad=0;
}
else{
	$cantidad=$row['CANTIDAD_DISPONIBLE'];
}

echo $row['DESCRIPCION']."***".$cantxcaja."***".$precio."***".$cantidad;

desconectar();
?>
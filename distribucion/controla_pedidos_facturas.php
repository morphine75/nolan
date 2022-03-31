<?php
include("../inc/conexion.php");
conectar();

$movil=$_REQUEST['movil'];

$sql="select count(id_pedido) as facturas, (select count(id_pedido) from distribucion where id_movil=".$movil.") as pedidos from comprobantes where id_pedido in (SELECT id_pedido FROM distribucion where id_movil=".$movil.")";
$res=mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($res);

if ($row['facturas']==$row['pedidos']){
	echo "0";
}
else{
	echo "1";
}

desconectar();

?>
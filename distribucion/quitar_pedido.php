<?php
include("../inc/conexion.php");
conectar();
$pedido=$_REQUEST['id_pedido'];

$sql="UPDATE pedidos SET DISTRIBUIDO=0 where ID_PEDIDO=".$pedido;
$res=mysqli_query($conn, $sql);

$sql="DELETE from distribucion where ID_PEDIDO=".$pedido;
$res=mysqli_query($conn, $sql);

if ($res){
	echo "Se ha quitado el pedido de la carga";
}

?>
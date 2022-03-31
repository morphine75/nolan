<?php
include("../inc/conexion.php");
conectar();
$movil=$_REQUEST['id_movil'];

$sql="UPDATE pedidos SET DISTRIBUIDO=0 where ID_PEDIDO in (select ID_PEDIDO from distribucion where ID_MOVIL=".$movil.")";
$res=mysqli_query($conn, $sql);

$sql="DELETE from distribucion where ID_MOVIL=".$movil;
$res=mysqli_query($conn, $sql);

if ($res){
	echo "Se han quitado los moviles de la carga";
}

?>
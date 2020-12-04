<?php
include("../inc/conexion.php");
conectar();
$movil=$_REQUEST['id_movil'];
$pedido=$_REQUEST['id_pedido'];

$sql="UPDATE distribucion set ID_MOVIL=".$movil." where ID_PEDIDO=".$pedido;
$res=mysqli_query($conn, $sql);

if ($res){
	echo "Se ha redistribuido la carga";
}

?>
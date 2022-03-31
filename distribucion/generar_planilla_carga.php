<?php
include("../inc/conexion.php");
conectar();

$id_movil=$_REQUEST['id_movil'];
$fecha_entrega=$_REQUEST['fecha_entrega'];

$sql="INSERT INTO movimientos_stock (ID_MOVIL, FECENTRE, TIPOMOV) VALUES (".$id_movil.", '".$fecha_entrega."', 'CAR')";
$res=mysqli_query($conn, $sql);

$sql="SELECT max(ID_MOVIMIENTO) AS ID from movimientos_stock";
$res=mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($res);

$sql="UPDATE distribucion set ID_MOVIMIENTO=".$row['ID']." WHERE ID_MOVIL=".$id_movil;
if (mysqli_query($conn, $sql)){
	echo $row['ID'];
}

desconectar();
?>
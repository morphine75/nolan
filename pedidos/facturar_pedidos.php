<?php 
include("../inc/conexion.php");
conectar();
$id=$_REQUEST['id'];
if ($id=-1){
	$sql="SELECT ID_DOCUMENTO, ID_MOVIMIENTO, ID_VENDEDOR, p.ID_CLIENTE, p.ID_PEDIDO, TOTAL from clientes c, pedidos p  left join distribucion d on p.ID_PEDIDO=d.ID_PEDIDO where PROCESADO=0 and c.ID_CLIENTE=p.ID_CLIENTE";
	$res=mysqli_query($sql);
	while ($row=mysqli_fetch_assoc($res)){
		$sqlInserta="INSERT INTO comprobantes (ID_DOCUMENTO, ID_MOVIMIENTO, ID_VENDEDOR, ID_CLIENTE, ID_PEDIDO, FECHAFAC, TOTAL, ANULADO) values ( ".$row['ID_DOCUMENTO']";
	}
}

desconectar();
?>
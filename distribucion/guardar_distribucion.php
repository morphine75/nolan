<?php
include("../inc/conexion.php");
conectar();

$clientes=json_decode($_REQUEST['clientes_json']);
$movil=$_REQUEST['movil'];
$bandera=0;

for ($i=0;$i<count($clientes);$i++){
	$sql="SELECT ID_PEDIDO FROM pedidos where ID_CLIENTE=".$clientes[$i];
	$res=mysqli_query($conn,$sql);
	while ($id_pedido=mysqli_fetch_assoc($res)){
		$sql="INSERT INTO distribucion (ID_PEDIDO, ID_MOVIL) values (".$id_pedido['ID_PEDIDO'].",".$movil.")";
		if (!mysqli_query($conn, $sql)){
			$bandera=1;
		}
		else{
			$sqlPedidos="UPDATE pedidos set DISTRIBUIDO=1 where ID_PEDIDO=".$id_pedido['ID_PEDIDO'];
			mysqli_query($conn, $sqlPedidos);		
		}
	}
}

if ($bandera==0){
	echo "Se ha guardado la distribucion";
}
else{
	echo "Hubo problemas en la insercion";
}
desconectar();

?>
<?php 
include("../inc/conexion.php");
conectar();
$id=$_REQUEST['id'];
if ($id==-1){
	$sql="SELECT ID_DOCUMENTO, ID_MOVIMIENTO, ID_VENDEDOR, p.ID_CLIENTE, p.ID_PEDIDO, TOTAL from clientes c, pedidos p left join distribucion d on p.ID_PEDIDO=d.ID_PEDIDO where PROCESADO=0 and c.ID_CLIENTE=p.ID_CLIENTE";
	$res=mysqli_query($conn, $sql);
	while ($row=mysqli_fetch_assoc($res)){
		$sqlInserta="INSERT INTO comprobantes (ID_DOCUMENTO, ID_MOVIMIENTO, ID_VENDEDOR, ID_CLIENTE, ID_PEDIDO, FECHAFAC, TOTAL, ANULADO) values ( ".$row['ID_DOCUMENTO'].", ".$row['ID_MOVIMIENTO'].", ".$row['ID_VENDEDOR'].", ".$row['ID_CLIENTE'].", ".$row['ID_PEDIDO'].", '".date('Y-m-d')."', ".$row['TOTAL'].", 0)";
		mysqli_query($conn, $sqlInserta);
		$sqlMax="SELECT max(ID_COMPROBANTE) AS MAXPEDIDO from comprobantes";
		$resMax=mysqli_query($conn, $sqlMax);
		$max=mysqli_fetch_assoc($resMax);
		$sqlDetalle="SELECT ID_ARTICULO, BONIF, CANT, PRECIO FROM detalle_pedido where ID_PEDIDO=".$row['ID_PEDIDO'];
		$resDetalle=mysqli_query($conn, $sqlDetalle);
		while ($rowDetalle=mysqli_fetch_assoc($resDetalle)){
			if ($rowDetalle['BONIF']==''){
				$rowDetalle['BONIF']=0;
			}
			$sqlInsertaDetalle="INSERT INTO detalle_comprobantes (ID_ARTICULO, ID_COMPROBANTE, BONIF, CANT, PRECIO) values (".$rowDetalle['ID_ARTICULO'].",".$max['MAXPEDIDO'].",".$rowDetalle['BONIF'].",".$rowDetalle['CANT'].",".$rowDetalle['PRECIO'].")";
			mysqli_query($conn, $sqlInsertaDetalle);
			$sqlStock="UPDATE stock_almacen SET CANTIDAD_FISICA=CANTIDAD_FISICA-".$rowDetalle['CANT']." WHERE ID_ARTICULO=".$rowDetalle['ID_ARTICULO'];
			mysqli_query($conn, $sqlStock);
		}
		$sqlActualizaPedido="UPDATE pedidos set PROCESADO=1 WHERE ID_PEDIDO=".$row['ID_PEDIDO'];
		$resActualizaPedido=mysqli_query($conn, $sqlActualizaPedido);
	}
	echo "Se han facturado todos los pedidos";
}
else{
	$sql="SELECT ID_DOCUMENTO, ID_MOVIMIENTO, ID_VENDEDOR, p.ID_CLIENTE, p.ID_PEDIDO, TOTAL from clientes c, pedidos p left join distribucion d on p.ID_PEDIDO=d.ID_PEDIDO where PROCESADO=0 and c.ID_CLIENTE=p.ID_CLIENTE and p.ID_PEDIDO=".$id;
	$res=mysqli_query($conn, $sql);
	while ($row=mysqli_fetch_assoc($res)){
		$sqlInserta="INSERT INTO comprobantes (ID_DOCUMENTO, ID_MOVIMIENTO, ID_VENDEDOR, ID_CLIENTE, ID_PEDIDO, FECHAFAC, TOTAL, ANULADO) values ( ".$row['ID_DOCUMENTO'].", ".$row['ID_MOVIMIENTO'].", ".$row['ID_VENDEDOR'].", ".$row['ID_CLIENTE'].", ".$row['ID_PEDIDO'].", '".date('Y-m-d')."', ".$row['TOTAL'].", 0)";
		mysqli_query($conn, $sqlInserta);
		$sqlMax="SELECT max(ID_COMPROBANTE) AS MAXPEDIDO from comprobantes";
		$resMax=mysqli_query($conn, $sqlMax);
		$max=mysqli_fetch_assoc($resMax);
		$sqlDetalle="SELECT ID_ARTICULO, BONIF, CANT, PRECIO FROM detalle_pedido where ID_PEDIDO=".$row['ID_PEDIDO'];
		$resDetalle=mysqli_query($conn, $sqlDetalle);
		while ($rowDetalle=mysqli_fetch_assoc($resDetalle)){
			if ($rowDetalle['BONIF']==''){
				$rowDetalle['BONIF']=0;
			}
			$sqlInsertaDetalle="INSERT INTO detalle_comprobantes (ID_ARTICULO, ID_COMPROBANTE, BONIF, CANT, PRECIO) values (".$rowDetalle['ID_ARTICULO'].",".$max['MAXPEDIDO'].",".$rowDetalle['BONIF'].",".$rowDetalle['CANT'].",".$rowDetalle['PRECIO'].")";
			mysqli_query($conn, $sqlInsertaDetalle);
			$sqlStock="UPDATE stock_almacen SET CANTIDAD_FISICA=CANTIDAD_FISICA-".$rowDetalle['CANT']." WHERE ID_ARTICULO=".$rowDetalle['ID_ARTICULO'];
			mysqli_query($conn, $sqlStock);
		}
		$sqlActualizaPedido="UPDATE pedidos set PROCESADO=1 WHERE ID_PEDIDO=".$row['ID_PEDIDO'];
		$resActualizaPedido=mysql_query($sqlActualizaPedido);
	}
	echo "Se ha facturado el pedido numero :".$id;	
}

desconectar();
?>
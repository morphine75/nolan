<?php
include("../inc/conexion.php");
conectar();
$pedido=$_REQUEST['pedido'];
$documento=$_REQUEST['documento'];

$sql="SELECT ID_ARTICULO, CANT FROM detalle_pedido WHERE ID_PEDIDO=".$pedido;
$res=mysqli_query($conn, $sql);
	while ($row=mysqli_fetch_assoc($res)){
		$sqlStock="UPDATE stock_almacen SET CANTIDAD_DISPONIBLE=CANTIDAD_DISPONIBLE+".$row['CANT']." WHERE ID_ARTICULO=".$row['ID_ARTICULO'];
		mysqli_query($conn, $sqlStock);
	}

	if ($res === false) {
		echo '<div class="alert alert-danger alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>Hubo problemas en la eliminacion </strong></div>';
	}
	else{
		$sql="UPDATE pedidos SET ANULADO =1 WHERE ID_PEDIDO=".$pedido;
		$res=@mysqli_query($conn,$sql);
		if ($res === false) {
			echo '<div class="alert alert-danger alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>Hubo problemas en la eliminacion del pedido </strong></div>';
		}
		else{
			$sql="SELECT d.ID_VENDEDOR, (SELECT ID_COMPROBANTE FROM comprobantes WHERE ID_PEDIDO =".$pedido.") AS PEDIDORECHAZADO, p.ID_CLIENTE, p.ID_PEDIDO, p.TOTAL FROM clientes c, pedidos p LEFT JOIN comprobantes d ON p.ID_PEDIDO = d.ID_PEDIDO WHERE c.ID_CLIENTE = p.ID_CLIENTE and d.ID_PEDIDO=".$pedido." and d.ID_DOCUMENTO=".$documento;
			$res=mysqli_query($conn, $sql);
			$row=mysqli_fetch_assoc($res);
			$sqlInserta="INSERT INTO comprobantes (ID_DOCUMENTO, ID_VENDEDOR, COM_ID_COMPROBANTE, ID_CLIENTE, ID_PEDIDO, FECHAFAC, TOTAL, ANULADO) values ( 2, ".$row['ID_VENDEDOR'].", ".$row['PEDIDORECHAZADO'].", ".$row['ID_CLIENTE'].", ".$row['ID_PEDIDO'].", '".date('Y-m-d')."', ".$row['TOTAL'].", 0)";
		mysqli_query($conn, $sqlInserta);


			
			if ($res === false) {
				echo '<div class="alert alert-danger alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>Hubo problemas anulando el comprobante </strong></div>';	
			}
			else
			{
				?>
				<script type="text/javascript">
				window.open('./facturas/pdf_factura.php?pedido=<?php echo $pedido?>&documento=2', '_blank');
				</script>
			<?php
			echo '<div class="alert alert-success alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>¡OK!</strong> Se ha generado la Nota de Credito</div>';
			}
		}
	}	
?>
<?php
include("../inc/conexion.php");
conectar();
$pedido=$_REQUEST['pedido'];
$documento=$_REQUEST['documento'];
$fecha=date('Y-m-d');

$sql="UPDATE comprobantes SET FECPAGA ='".$fecha."' WHERE ID_PEDIDO=".$pedido." AND ID_DOCUMENTO=".$documento;
		$res=@mysqli_query($conn,$sql);
		if ($res === false) {
		 '<div class="alert alert-danger alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>Hubo problemas en la carga del pago/strong></div>';
		} else {
			echo '<div class="alert alert-success alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>¡OK!</strong> Se ha registrado la fecha de pago</div>';
		}
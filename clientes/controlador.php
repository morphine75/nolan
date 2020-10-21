<?php
include("../inc/conexion.php");
conectar();

$function=$_REQUEST['funcion'];

if (function_exists($function)) {
  $function($conn);
}else {
  echo "la funcion " .$function. " no existe";
}

function guardar($conn){
	$id=$_REQUEST['id'];
	$nombre=$_REQUEST['nombre'];
	$fantasia=$_REQUEST['fantasia'];
	$cuit=$_REQUEST['cuit'];
	$calle=$_REQUEST['calle'];
	$altura=$_REQUEST['altura'];
	$contacto=$_REQUEST['contacto'];
	$telefono=$_REQUEST['telefono'];
	$email=$_REQUEST['email'];
	$sucursal=$_REQUEST['sucursal'];
	$canal=$_REQUEST['canal'];
	$lista_precio=$_REQUEST['lista_precio'];
	$tipo_iva=$_REQUEST['tipo_iva'];
	$xcoord=$_REQUEST['lat'];
	$ycoord=$_REQUEST['long'];
	$fecha=date('Y-m-d');
	$tipo_pago=$_REQUEST['tipo_pago'];
	$observaciones=$_REQUEST['observaciones'];

	if ($id==0){
		$sql="INSERT INTO clientes (NOM_CLIENTE, FANTASIA, CUIT, CALLE, ALTURA, CONTACTO, TELEFONOS, EMAIL, ID_SUCURSAL, ID_CANAL, ID_LISTA, ID_TIPO_IVA, ID_TIPO_PAGO, XCOORD, YCOORD, FECALTA, COMENTARIO, ANULADO) VALUES ('".$nombre."','".$fantasia."', '".$cuit."', '".$calle."','".$altura."','".$contacto."', '".$telefono."', '".$email."', '".$sucursal."', '".$canal."','".$lista_precio."','".$tipo_iva."','".$tipo_pago."', '".$xcoord."','".$ycoord."', '".$fecha."','".$observaciones."',0)";
		$res=@mysqli_query($conn,$sql);
		if ($res === false) {
			echo '<div class="alert alert-danger alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>Hubo problemas en la insercion</strong></div>';
		}
		else{
			echo '<div class="alert alert-success alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>¡OK!</strong> El registro se inserto con &eacute;xito.</div>';
		}		
	}
	else{
		$sql="UPDATE clientes SET NOM_CLIENTE='".$nombre."', CALLE='".$calle."' WHERE ID_CLIENTE=".$id;
		$res=@mysqli_query($conn,$sql);
		if ($res === false) {
			echo '<div class="alert alert-danger alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>Hubo problemas en la modificacion</strong></div>';
		}
		else{
			echo '<div class="alert alert-success alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>¡OK!</strong> El registro se modifico con &eacute;xito.</div>';
		}		
	}

}

function eliminar($conn){
	$id=$_REQUEST['id'];
	$sql="DELETE FROM clientes where ID_CLIENTE=".$id;
	$res=@mysqli_query($conn,$sql);
	if ($res === false) {
		$sql="UPDATE clientes SET ANULADO=1 WHERE ID_CLIENTE=".$id;
		$res=mysqli_query($conn,$sql);
		echo '<div class="alert alert-danger alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>El cliente se encuentra relacionado a movimientos, se procedio a anularlo </strong></div>';
	}
	else{
		echo '<div class="alert alert-success alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>¡OK!</strong> El registro se elimino con &eacute;xito.</div>';
	}

}


?>
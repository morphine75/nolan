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
	$cliente=$_REQUEST['cliente'];
	$ruta=$_REQUEST['ruta'];
	$ruta_dis=$_REQUEST['ruta_dis'];
	$bandera=0;


	$sql="DELETE FROM CLI_X_RUTA WHERE ID_CLIENTE=".$cliente;
	mysqli_query($conn, $sql);
	$sql="INSERT INTO CLI_X_RUTA (ID_RUTA, RUTA, ID_CLIENTE) values (".$ruta.",".$ruta_dis.",".$cliente.")";
	$res=@mysqli_query($conn,$sql);
	if ($res === false) {
		echo '<div class="alert alert-danger alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>Hubo problemas en la insercion</strong></div>';
	}
	else{
		echo '<div class="alert alert-success alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>¡OK!</strong> El registro se inserto con &eacute;xito.</div>';
	}
		
}

function eliminar($conn){
	$id=$_REQUEST['id'];
	$sql="DELETE FROM RUTAS where ID_RUTA=".$id;
	$res=@mysqli_query($conn,$sql);
	if ($res === false) {
		$sql="UPDATE RUTAS SET ANULADO=1 WHERE ID_RUTA=".$id;
		$res=mysqli_query($conn,$sql);
		echo '<div class="alert alert-danger alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>El cliente se encuentra relacionado a movimientos, se procedio a anularlo </strong></div>';
	}
	else{
		echo '<div class="alert alert-success alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>¡OK!</strong> El registro se elimino con &eacute;xito.</div>';
	}

}


?>
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
	$cuit=$_REQUEST['cuit'];
	$direccion=$_REQUEST['direccion'];
	$telefono=$_REQUEST['telefono'];
	$tipo_iva=$_REQUEST['tipo_iva'];
	$dias=$_REQUEST['dias'];
	$numbru=$_REQUEST['numbru'];

	if ($id==0){
		$sql="INSERT INTO proveedores ( ID_TIPO_IVA, NOMPROV, DOMIPROV, DIAS, NUMBRU, NUMCUIT, TELEFONO, ANULADO) VALUES ('".$tipo_iva."', '".$nombre."', '".$direccion."','".$dias."','".$numbru."', '".$cuit."', '".$telefono."', 0)";
		$res=@mysqli_query($conn,$sql);
		if ($res === false) {
			echo '<div class="alert alert-danger alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>Hubo problemas en la insercion</strong></div>';
		}
		else{
			echo '<div class="alert alert-success alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>¡OK!</strong> El registro se inserto con &eacute;xito.</div>';
		}		
	}
	else{
		$sql="UPDATE PROVEEDORES SET ID_TIPO_IVA='".$tipo_iva."', NOMPROV='".$nombre."', DOMIPROV='".$direccion."', DIAS='".$dias."', NUMBRU='".$numbru."', NUMCUIT='".$cuit."', TELEFONO='".$telefono."' WHERE ID_PROVEEDOR=".$id;
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
	$sql="DELETE FROM PROVEEDORES where ID_PROVEEDOR=".$id;
	$res=@mysqli_query($conn,$sql);
	if ($res === false) {
		$sql="UPDATE PROVEEDORES SET ANULADO=1 WHERE ID_PROVEEDOR=".$id;
		$res=mysqli_query($conn,$sql);
		echo '<div class="alert alert-danger alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>El proveedor se encuentra relacionado a movimientos, se procedio a anularlo </strong></div>';
	}
	else{
		echo '<div class="alert alert-success alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>¡OK!</strong> El registro se elimino con &eacute;xito.</div>';
	}

}


?>
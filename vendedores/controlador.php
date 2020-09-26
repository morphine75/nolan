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
	$sucursal=$_REQUEST['sucursal'];
	$domicilio=$_REQUEST['domicilio'];
	$telefono=$_REQUEST['telefono'];
	$cargo=$_REQUEST['cargo'];
	if ($_REQUEST['superior']!=0) {
		$superior=$_REQUEST['superior'];
	}else{
		$superior="NULL";
	};

	if ($id==0){
		$sql="INSERT INTO vendedores ( ID_SUCURSAL, VEN_ID_VENDEDOR, NOM_VENEDDOR, CARGO, DOMICILIO, TELEFOS, ANULADO) VALUES ('".$sucursal."', ".$superior.", '".$nombre."','".$cargo."','".$domicilio."', '".$telefono."', 0)";
		$res=@mysqli_query($conn,$sql);
		if ($res === false) {
			echo '<div class="alert alert-danger alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong> Hubo problemas en la insercion</strong></div>';
		}
		else{
			echo '<div class="alert alert-success alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>¡OK!</strong> El registro se inserto con &eacute;xito.</div>';
		}		
	}
	else{
		$sql="UPDATE VENDEDORES SET ID_SUCURSAL='".$sucursal."', VEN_ID_VENDEDOR=".$superior.", NOM_VENEDDOR='".$nombre."', CARGO='".$cargo."', DOMICILIO='".$domicilio."', TELEFOS='".$telefono."' WHERE ID_VENDEDOR=".$id;
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
	$sql="DELETE FROM VENDEDORES where ID_VENDEDOR=".$id;
	$res=@mysqli_query($conn,$sql);
	if ($res === false) {
		$sql="UPDATE VENDEDORES SET ANULADO=1 WHERE ID_VENDEDOR=".$id;
		$res=mysqli_query($conn,$sql);
		echo '<div class="alert alert-danger alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>El vendedor se encuentra relacionado a movimientos, se procedio a anularlo </strong></div>';
	}
	else{
		echo '<div class="alert alert-success alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>¡OK!</strong> El registro se elimino con &eacute;xito.</div>';
	}

}


?>
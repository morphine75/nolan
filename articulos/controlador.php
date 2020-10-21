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
	$litros=$_REQUEST['litros'];
	$peso=$_REQUEST['peso'];
	$cant_x_caja=$_REQUEST['cant_x_caja'];
	$fecha=date('Y-m-d');

	if ($id==0){
		$sql="INSERT INTO articulos (DESCRIPCION, FECALTA, VALOR, PESO, CANTXCAJA) VALUES ('".$nombre."', '".$fecha."', '".$litros."', '".$peso."', '".$cant_x_caja."')";
		$res=@mysqli_query($conn,$sql);
		if ($res === false) {
			echo '<div class="alert alert-danger alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>Hubo problemas en la insercion</strong></div>';
		}
		else{
			echo '<div class="alert alert-success alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>¡OK!</strong> El registro se inserto con &eacute;xito.</div>';
		}		
	}
	else{
		$sql="UPDATE articulos SET DESCRIPCION='".$nombre."', VALOR='".$litros."', PESO='".$peso."', CANTXCAJA='".$cant_x_caja."' WHERE ID_ARTICULO=".$id;
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
	$sql="DELETE FROM articulos where ID_ARTICULO=".$id;
	$res=@mysqli_query($conn,$sql);
	if ($res === false) {
		$sql="UPDATE articulos SET ANULADO=1 WHERE ID_ARTICULO=".$id;
		$res=mysqli_query($conn,$sql);
		echo '<div class="alert alert-danger alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>El canal se encuentra relacionado a clientes, se procedio a anularlo </strong></div>';
	}
	else{
		echo '<div class="alert alert-success alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>¡OK!</strong> El registro se elimino con &eacute;xito.</div>';
	}

}


?>
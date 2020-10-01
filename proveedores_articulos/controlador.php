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
    $id=explode("-", $id);
    $precio=$_REQUEST['precio'];
    if ($id[0]==''){
    	$proveedor=$_REQUEST['proveedor'];
    	$articulo=$_REQUEST['articulos'];
		$sql="INSERT INTO PROV_X_ARTICULO (ID_PROVEEDOR, ID_ARTICULO, PRECIO_COMPRA) values (".$proveedor.",".$articulo.",".$precio.")";
		$res=@mysqli_query($conn,$sql);
		if ($res === false) {
			echo '<div class="alert alert-danger alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>Hubo problemas en la insercion</strong></div>';
		}
		else{
			echo '<div class="alert alert-success alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>¡OK!</strong> El registro se inserto con &eacute;xito.</div>';
		}
	}
	else{
		$sql="UPDATE PROV_X_ARTICULO SET ID_PROVEEDOR=".$id[0].", ID_ARTICULO=".$id[1].", PRECIO_COMPRA=".$precio;
		$res=@mysqli_query($conn,$sql);
		if ($res === false) {
			echo '<div class="alert alert-danger alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>Hubo problemas en la modificacion</strong></div>';
		}
		else{
			echo '<div class="alert alert-success alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>¡OK!</strong>El registro se modifico con &eacute;xito.</div>';
		}
	}
		
}

function eliminar($conn){
	$id=$_REQUEST['id'];
	$id=explode("-", $id);
	$sql="DELETE FROM PROV_X_ARTICULO where ID_PROVEEDOR=".$id[0]." AND ID_ARTICULO=".$id[1];
	$res=@mysqli_query($conn,$sql);
	if ($res === false) {
		$sql="UPDATE PROV_X_ARTICULO SET ANULADO=1 WHERE ID_PROVEEDOR=".$id[0]." AND ID_ARTICULO=".$id[1];
		$res=mysqli_query($conn,$sql);
		echo '<div class="alert alert-danger alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>La ruta se encuentra relacionado a movimientos, se procedio a anularlo </strong></div>';
	}
	else{
		echo '<div class="alert alert-success alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>¡OK!</strong> El registro se elimino con &eacute;xito.</div>';
	}

}


?>
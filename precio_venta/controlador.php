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
	if ($id !=0){
    $id=explode("-", $id);
	}
	$lista_precio=$_REQUEST['lista_precio'];
	$articulo=$_REQUEST['articulo'];
	$precio=$_REQUEST['precio'];

	if ($id==0){
		$sql1="SELECT * FROM precio_venta WHERE ID_LISTA='".$lista_precio."' AND ID_ARTICULO='".$articulo."'";
		$res1=@mysqli_query($conn,$sql1);
		;
		if (mysqli_num_rows($res1)>0){
				echo '<div class="alert alert-danger alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>Este producto ya se encuentra asignado a esta Lista</strong></div>';
		}
		else {
			$sql="INSERT INTO precio_venta (ID_LISTA, ID_ARTICULO, PRECIO) VALUES ('".$lista_precio."', '".$articulo."', '".$precio."')";
			$res=@mysqli_query($conn,$sql);
				if ($res === false) {
					echo '<div class="alert alert-danger alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>Hubo problemas en la insercion</strong></div>';
				}
				else{
							echo '<div class="alert alert-success alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>¡OK!</strong> El registro se inserto con &eacute;xito.</div>';
				}
		}
	}
	else{
		$sql="UPDATE precio_venta SET PRECIO='".$precio."' WHERE ID_LISTA='".$id[1]."' AND ID_ARTICULO=".$id[0];
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
	$id=explode("-", $id);
	$sql="DELETE FROM precio_venta where ID_LISTA='".$id[1]."' AND ID_ARTICULO=".$id[0];
	$res=@mysqli_query($conn,$sql);
	if ($res === false) {
		//$sql="UPDATE PRECIO_VENTA SET ANULADO=1 WHERE ID_LISTA=".$id[0];
		//$res=mysqli_query($conn,$sql);
		echo '<div class="alert alert-danger alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>La lista se encuentra relacionado a articulos, se procedio a anularlo </strong></div>';
	}
	else{
		echo '<div class="alert alert-success alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>¡OK!</strong> El registro se elimino con &eacute;xito.</div>';
	}

}
?>
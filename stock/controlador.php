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
	$articulo=$_REQUEST['articulo'];

	$sql="select CANTXCAJA from articulos where ID_ARTICULO=".$articulo;
	$res=mysqli_query($conn, $sql);
	$row=mysqli_fetch_assoc($res);


	$b_fisica=$_REQUEST['b_fisica'];
	if ($b_fisica==''){
		$b_fisica=0;
	}
	$b_disponible=$_REQUEST['b_disponible'];
	if ($b_disponible==''){
		$b_disponible=0;
	}
	$u_fisica=$_REQUEST['u_fisica'];
	if ($u_fisica==''){
		$u_fisica=0;
	}
	$u_disponible=$_REQUEST['u_disponible'];
	if ($u_disponible==''){
		$u_disponible=0;
	}

	$fisica=($row['CANTXCAJA']*$b_fisica)+$u_fisica;
	$disponible=($row['CANTXCAJA']*$b_disponible)+$u_disponible;

	if ($id==0){
		$sql="INSERT INTO stock_almacen (ID_ARTICULO, ID_ALMACEN, CANTIDAD_FISICA, CANTIDAD_DISPONIBLE) VALUES ('".$articulo."', 1, '".$fisica."', '".$disponible."')";
		$res=@mysqli_query($conn,$sql);
		if ($res === false) {
			echo '<div class="alert alert-danger alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>Hubo problemas en la insercion</strong></div>';
		}
		else{
			echo '<div class="alert alert-success alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>¡OK!</strong> El registro se inserto con &eacute;xito.</div>';
		}		
	}
	else{
		$sql="UPDATE stock_almacen SET CANTIDAD_DISPONIBLE='".$disponible."', CANTIDAD_FISICA='".$fisica."' WHERE ID_ARTICULO=".$articulo;
		$res=@mysqli_query($conn,$sql);
		if ($res === false) {
			echo '<div class="alert alert-danger alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>Hubo problemas en la modificacion</strong></div>';
		}
		else{
			echo '<div class="alert alert-success alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>¡OK!</strong> El registro se modifico con &eacute;xito.</div>';
		}		
	}

}

?>
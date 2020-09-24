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
	$vendedor=$_REQUEST['vendedor'];
	$ruta=$_REQUEST['ruta'];
	$dias=$_REQUEST['dias'];
	$bandera=0;


		$sql="DELETE FROM PERSO_X_RUT WHERE ID_VENDEDOR=".$vendedor." AND ID_RUTA=".$ruta;
		mysqli_query($conn, $sql);
		if (count($dias)>0){
			for ($i=0;$i<count($dias);$i++){
				$sql="INSERT INTO PERSO_X_RUT (ID_RUTA, ID_VENDEDOR, DIAVIS) values (".$ruta.",".$vendedor.",".$dias[$i].")";
				$res=@mysqli_query($conn,$sql);
				if ($res === false) {
					$bandera=1;
				}
			}
			if ($bandera==1){
				echo '<div class="alert alert-danger alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>Hubo problemas en la insercion</strong></div>';
			}
			else{
				echo '<div class="alert alert-success alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>¡OK!</strong> El registro se inserto con &eacute;xito.</div>';
			}
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
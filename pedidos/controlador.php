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
	$id_cliente=$_REQUEST['id_cliente'];
	$id_vendedor=$_REQUEST['id_vendedor'];
	$fecha=date('Y-m-d');
	$total=$_REQUEST['total'];

	if ($id==0){
		$sql="INSERT INTO pedidos (ID_CLIENTE, ID_VENDEDOR, FECHA, TOTAL, PROCESADO) VALUES ('".$id_cliente."','".$id_vendedor."', '".$fecha."', '".$total."', 0)";
		$res=@mysqli_query($conn,$sql);
		if ($res === false) {
			echo '<div class="alert alert-danger alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>Hubo problemas en la insercion</strong></div>';
		}
		else{
			$bandera_inserta=0;			
			$sql="SELECT MAX(ID_PEDIDO) as ID from pedidos";
			$res=mysqli_query($conn, $sql);
			$id=mysqli_fetch_assoc($res);
			$id_pedido=$id['ID'];
			$id_articulo=$_REQUEST['codigo'];
			$cantidad=$_REQUEST['cantidad'];
			$bonif=$_REQUEST['bonif'];
			$unidades=$_REQUEST['unidades'];
			$cantxcaja=$_REQUEST['cantxcaja'];
			$subtotal_linea=$_REQUEST['subtotal_linea'];
			$cant_inserta=0;
			for ($i=0;$i<count($id_articulo);$i++){
				if ($cantidad[$i]==''){
					$cantidad[$i]=0;
				}
				if ($unidades[$i]==''){
					$unidades[$i]=0;
				}
				$cant_inserta=($cantidad[$i]*$cantxcaja[$i])+$unidades[$i];
				if (($id_articulo[$i]!='')&&($subtotal_linea[$i]!='')&&($cant_inserta>0)){
					$sql="INSERT INTO detalle_pedido (ID_ARTICULO, ID_PEDIDO, BONIF, CANT, PRECIO) VALUES ('".$id_articulo[$i]."','".$id_pedido."','".$bonif[$i]."','".$cant_inserta."','".$subtotal_linea[$i]."')";
					mysqli_query($conn, $sql);

					$sql="UPDATE stock_almacen SET CANTIDAD_DISPONIBLE=CANTIDAD_DISPONIBLE-".$cant_inserta." WHERE ID_ARTICULO=".$id_articulo[$i];
					$res=mysqli_query($conn, $sql);
					if ($res === false){
						$bandera_inserta=1;
					}					
				}
			}
			if ($bandera_inserta==1){
				echo '<div class="alert alert-danger alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>Hubo problemas en la insercion</strong></div>';
			}
			else{			
				echo '<div class="alert alert-success alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>¡OK!</strong> El registro se inserto con &eacute;xito.</div>';
			}
		}		
	}
	else{
		$sql="UPDATE pedidos SET TOTAL =".$total." WHERE ID_PEDIDO=".$id;
		$res=@mysqli_query($conn,$sql);
		if ($res === false) {
			echo '<div class="alert alert-danger alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>Hubo problemas en la insercion</strong></div>';
		}
		else{
		$bandera_inserta=0;
		$sql="SELECT ID_ARTICULO, CANT FROM detalle_pedido WHERE ID_PEDIDO=".$id;
		$res=mysqli_query($conn, $sql);
		while ($row=mysqli_fetch_assoc($res)){
			$sqlStock="UPDATE stock_almacen SET CANTIDAD_DISPONIBLE=CANTIDAD_DISPONIBLE+".$row['CANT']." WHERE ID_ARTICULO=".$row['ID_ARTICULO'];
			mysqli_query($conn, $sqlStock);
		}

		$sql="DELETE FROM detalle_pedido WHERE ID_PEDIDO=".$id;
		mysqli_query($conn, $sql);	
		$id_articulo=$_REQUEST['codigo'];
		$cantidad=$_REQUEST['cantidad'];
		$bonif=$_REQUEST['bonif'];
		$unidades=$_REQUEST['unidades'];
		$cantxcaja=$_REQUEST['cantxcaja'];
		$subtotal_linea=$_REQUEST['subtotal_linea'];
		$cant_inserta=0;
		for ($i=0;$i<count($id_articulo);$i++){
			if ($cantidad[$i]==''){
				$cantidad[$i]=0;
			}
			if ($unidades[$i]==''){
				$unidades[$i]=0;
			}
			$cant_inserta=($cantidad[$i]*$cantxcaja[$i])+$unidades[$i];
			echo $cantidad[$i]."-".$cantxcaja[$i]."-".$unidades[$i];
			if (($id_articulo[$i]!='')&&($subtotal_linea[$i]!='')&&($cant_inserta>0)){
				$sql="INSERT INTO detalle_pedido (ID_ARTICULO, ID_PEDIDO, BONIF, CANT, PRECIO) VALUES ('".$id_articulo[$i]."','".$id."','".$bonif[$i]."','".$cant_inserta."','".$subtotal_linea[$i]."')";
				mysqli_query($conn, $sql);

				$sql="UPDATE stock_almacen SET CANTIDAD_DISPONIBLE=CANTIDAD_DISPONIBLE-".$cant_inserta." WHERE ID_ARTICULO=".$id_articulo[$i];
				$res=mysqli_query($conn, $sql);
				if ($res === false){
					$bandera_inserta=1;
				}

			}
		}
		if ($bandera_inserta==1){
			echo '<div class="alert alert-danger alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>Hubo problemas en la modificacion</strong></div>';
		}
		else{
			echo '<div class="alert alert-success alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>¡OK!</strong> El registro se modifico con &eacute;xito.</div>';
		}				
	}

}
}
function eliminar($conn){
	$id=$_REQUEST['id'];
	$sql="SELECT ID_ARTICULO, CANT FROM detalle_pedido WHERE ID_PEDIDO=".$id;
	$res=mysqli_query($conn, $sql);
	while ($row=mysqli_fetch_assoc($res)){
		$sqlStock="UPDATE stock_almacen SET CANTIDAD_DISPONIBLE=CANTIDAD_DISPONIBLE+".$row['CANT']." WHERE ID_ARTICULO=".$row['ID_ARTICULO'];
		mysqli_query($conn, $sqlStock);
	}	
	$sql="DELETE FROM detalle_pedido where ID_PEDIDO=".$id;
	$res=@mysqli_query($conn,$sql);
	if ($res === false) {
		echo '<div class="alert alert-danger alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>Hubo problemas en la eliminacion </strong></div>';
	}
	else{
		$sql="DELETE FROM pedidos where ID_PEDIDO=".$id;
		$res=@mysqli_query($conn,$sql);
		if ($res === false) {
			echo '<div class="alert alert-danger alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>Hubo problemas en la eliminacion </strong></div>';
		}
		else{			
			echo '<div class="alert alert-success alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>¡OK!</strong> El registro se elimino con &eacute;xito.</div>';
		}
	}

}


?>
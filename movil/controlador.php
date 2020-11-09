<?php
include("../inc/conexion.php");
conectar();

$function=$_REQUEST['f'];

if (function_exists($function)) {
  $function($conn);
}else {
  echo "la funcion " .$function. " no existe";
}

function guardar($conn){
	$cliente=$_REQUEST['cliente'];
	$vendedor=$_REQUEST['vendedor'];
	$fecha=date('Y-m-d');
	$articulos=$_REQUEST['articulo'];
	$detalle_carga=array();
	$total=0;
	$arti_consultas="(";
	$j=0;
	for ($i=0;$i<count($articulos);$i++){
		$linea=explode("-",$articulos[$i]);
		//echo $linea[0].$linea[1]."<br>";
		if ($linea[1]=='B'){
			$sql="SELECT PRECIO/CANTXCAJA as IMPORTE from precio_venta P, articulos A where A.ID_ARTICULO=P.ID_ARTICULO AND A.ID_ARTICULO=".$linea[0];
			$res=mysqli_query($conn, $sql);
			$row=mysqli_fetch_assoc($res);
			$detalle_carga[$j]['ID_ARTICULO']=$linea[0];
			$detalle_carga[$j]['IMPORTE']=$row['IMPORTE'];
			$detalle_carga[$j]['BULTO']=1;
			$detalle_carga[$j]['UNIDAD']=0;
			$j++;
		}
		if ($linea[1]=='U'){
			$sql="SELECT PRECIO/CANTXCAJA as IMPORTE from precio_venta P, articulos A where A.ID_ARTICULO=P.ID_ARTICULO AND A.ID_ARTICULO=".$linea[0];
			$res=mysqli_query($conn, $sql);
			$row=mysqli_fetch_assoc($res);			
			$detalle_carga[$j]['ID_ARTICULO']=$linea[0];
			$detalle_carga[$j]['IMPORTE']=$row['IMPORTE'];
			$detalle_carga[$j]['BULTO']=0;
			$detalle_carga[$j]['UNIDAD']=1;
			$j++;
		}
		$arti_consultas=$arti_consultas.$linea[0].",";
	}

	$arti_consultas=substr($arti_consultas, 0,-1);
	$arti_consultas=$arti_consultas.")";

	$sql="SELECT ID_ARTICULO, CANTXCAJA from articulos WHERE ID_ARTICULO IN ".$arti_consultas;
	$res=mysqli_query($conn, $sql);
	$vecDetalle=array();
	$x=0;
	while ($row=mysqli_fetch_assoc($res)){
		$vecDetalle[$x]['ID_ARTICULO']=$row['ID_ARTICULO'];
		$vecDetalle[$x]['CANTXCAJA']=$row['CANTXCAJA'];
		$vecDetalle[$x]['CANTIDAD']=0;
		$vecDetalle[$x]['PRECIO']=0;
		$x++;
	}

	for ($i=0;$i<count($detalle_carga);$i++){
		for ($j=0;$j<count($vecDetalle);$j++){
			if ($detalle_carga[$i]['ID_ARTICULO']==$vecDetalle[$j]['ID_ARTICULO']){
				if ($detalle_carga[$i]['BULTO']==0){
					$vecDetalle[$j]['CANTIDAD']=$vecDetalle[$j]['CANTIDAD']+1;
					$vecDetalle[$j]['PRECIO']=$vecDetalle[$j]['CANTIDAD']*$detalle_carga[$i]['IMPORTE'];
				}
				if ($detalle_carga[$i]['UNIDAD']==0){
					$vecDetalle[$j]['CANTIDAD']=$vecDetalle[$j]['CANTIDAD']+$vecDetalle[$j]['CANTXCAJA'];
					$vecDetalle[$j]['PRECIO']=$vecDetalle[$j]['CANTIDAD']*$detalle_carga[$i]['IMPORTE'];
				}
				$total=$total+$vecDetalle[$j]['PRECIO'];
			}
		}
	}

	$bandera=0;
	$sql="INSERT INTO pedidos (ID_CLIENTE, ID_VENDEDOR, FECHA, TOTAL) VALUES (".$cliente.",".$vendedor.",'".$fecha."',".$total.")";
	if ($res=mysqli_query($conn, $sql))
	{
		$sqlMax="SELECT MAX(ID_PEDIDO) as ID FROM pedidos";
		$resMax=mysqli_query($conn, $sqlMax);
		$rowMax=mysqli_fetch_assoc($resMax);
		for ($i=0;$i<count($vecDetalle);$i++){
			$sql="INSERT INTO detalle_pedido (ID_PEDIDO, ID_ARTICULO, CANT, PRECIO) VALUES (".$rowMax['ID'].",".$vecDetalle[$i]['ID_ARTICULO'].",".$vecDetalle[$i]['CANTIDAD'].",".$vecDetalle[$i]['PRECIO'].")";
			$res=mysqli_query($conn, $sql);
			if ($res === false) {
				$bandera=1;
			}
		}
		if ($bandera==1){
			echo '<div class="alert alert-danger alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>Hubo problemas en la insercion detalle</strong></div>';
		}
		else{
			echo '<div class="alert alert-success alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>¡OK!</strong> El detalle se inserto con &eacute;xito.</div>';
		}
	}
}

function eliminar_pedido($conn){
	$id=$_REQUEST['id'];
	$sql="DELETE FROM detalle_pedido where ID_PEDIDO=".$id;
	$res=@mysqli_query($conn,$sql);
	$sql="DELETE FROM pedidos where ID_PEDIDO=".$id;
	$res=@mysqli_query($conn,$sql);

	if ($res === false) {
		echo '<div class="alert alert-danger alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>El cliente se encuentra relacionado a movimientos, se procedio a anularlo </strong></div>'.$sql;
	}
	else{
		echo '<div class="alert alert-success alert-dismissable"> <button type="button" class="close" data-dismiss="alert">&times;</button> <i class="glyphicon glyphicon-ok-sign"></i> <strong>¡OK!</strong> El registro se elimino con &eacute;xito.</div>';
	}

}


?>
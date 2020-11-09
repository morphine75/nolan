<style type="text/css">
	.cabecera{
		background-color: #3F6077;
		color: #FFF;
		font-weight: bold;
	}
</style>
<?php 
include("../inc/conexion.php");
conectar();

$idpedido=$_REQUEST['idpedido'];

$sqlCabecera="SELECT FECHA, NOM_CLIENTE, TOTAL FROM pedidos P, clientes C, vendedores V where V.ID_VENDEDOR=P.ID_VENDEDOR AND P.ID_CLIENTE=C.ID_CLIENTE AND ID_PEDIDO=".$idpedido;
$resCabecera=mysqli_query($conn, $sqlCabecera);
$rowCabecera=mysqli_fetch_assoc($resCabecera);
?>
<table class="table">
	<thead>
		<tr>
			<th class="cabecera">Fecha del Pedido</th>
			<th><?php echo $rowCabecera['FECHA'] ?></th>
			<th class="cabecera">Cliente</th>
			<th><?php echo $rowCabecera['NOM_CLIENTE'] ?></th>
		</tr>
		<tr>
			<th class="cabecera" >Total del Pedido</th>
			<th><?php echo $rowCabecera['TOTAL'] ?></th>
			<th></th>
			<th></th>
		</tr>
	</thead>
	<tbody class="table-striped">
	<tr>
		<td colspan="2" class="cabecera">Articulo</td>
		<td class="cabecera">Precio</td>
		<td class="cabecera">Bonificacion</td>
	</tr>		
<?php
$sqlDetalle="SELECT A.DESCRIPCION, P.PRECIO, P.BONIF FROM detalle_pedido P, articulos A where A.ID_ARTICULO=P.ID_ARTICULO AND ID_PEDIDO=".$idpedido;
$resDetalle=mysqli_query($conn, $sqlDetalle);
while ($rowDetalle=mysqli_fetch_assoc($resDetalle)){
?>		
	<tr>
		<td colspan="2"><?php echo $rowDetalle['DESCRIPCION'] ?></td>
		<td><?php echo $rowDetalle['PRECIO'] ?></td>
		<td><?php echo $rowDetalle['BONIF'] ?></td>
	</tr>
<?php
}
?>
	</tbody>
</table>
<?php
desconectar();
?>
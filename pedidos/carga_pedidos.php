<?php
include("../inc/conexion.php");
conectar();

$sql="SELECT p.ID_CLIENTE, c.NOM_CLIENTE, p.TOTAL, p.ID_PEDIDO FROM pedidos p, clientes c, distribucion d where c.ID_CLIENTE=p.ID_CLIENTE and p.ID_PEDIDO=d.ID_PEDIDO and p.PROCESADO=0";
$res=mysqli_query($conn, $sql);
?>
<table class="table table-striped">
	<thead>
		<tr>
			<th colspan="5"><a class="btn btn-primary" onclick="facturar_pedidos(-1)">Facturar todos los pedidos</a></th>
		</tr>
		<tr>
			<th>ID.PEDIDO</th>
			<th>ID.CLIENTE</th>
			<th>CLIENTE</th>
			<th>TOTAL</th>
			<th>FACTURAR</th>
		</tr>
	</thead>
	<tbody>
		<?php
		while ($row=mysqli_fetch_assoc($res)){?>
		<tr>
			<td><?php echo $row['ID_PEDIDO']?></td>
			<td><?php echo $row['ID_CLIENTE']?></td>
			<td><?php echo $row['NOM_CLIENTE']?></td>
			<td>$ <?php echo number_format($row['TOTAL'],2,",","")?></td>
			<td><a class="btn btn-primary" onclick="facturar_pedidos(<?php echo $row['ID_PEDIDO']?>)">Facturar</a></td>
		</tr>
		<?php
		}
		?>
	</tbody>
</table>
<?php
desconectar();
?>
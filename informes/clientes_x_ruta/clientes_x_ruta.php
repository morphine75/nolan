<script type="text/javascript">
	$('#listado_informe').DataTable();
</script>
<?php
include("../../inc/conexion.php");
conectar();

$id_ruta=$_REQUEST['ruta'];

$sql="SELECT c.ID_CLIENTE, NOM_CLIENTE, FANTASIA, CUIT, CALLE, ALTURA from cli_x_ruta r, clientes c where c.ID_CLIENTE=r.ID_CLIENTE and r.ID_RUTA=".$id_ruta;
$res=mysqli_query($conn, $sql);
?>
<table id="listado_informe" class="table table-hover">
	<thead>
		<tr>
			<th>ID</th>
			<th>Cliente</th>
			<th>Fantasia</th>
			<th>CUIT</th>
			<th>Domicilio</th>
		</tr>
	</thead>
	<tbody>
		<?php
		while ($row=mysqli_fetch_assoc($res)){
		?>
		<tr>
			<td><?php echo $row['ID_CLIENTE']?></td>
			<td><?php echo $row['NOM_CLIENTE']?></td>
			<td><?php echo $row['FANTASIA']?></td>
			<td><?php echo $row['CUIT']?></td>
			<td><?php echo $row['CALLE']." ".$row['ALTURA']?></td>
		</tr>
		<?php
		}
		?>
	</tbody>
</table>
<table cellspacing="1" border="0" width="80%" class="table table-hover" id="listado_disponibles">
	<thead>
		<tr>
			<th>Id</th>
			<th>Cliente</th>
			<th>CUIT</th>
			<th>Direccion</th>
			<th>Vendedor</th>
			<th>Seleccionar</th>
		</tr>
	</thead>
<?php
include("../../inc/conexion.php");
conectar();

$nombre=$_REQUEST['cadena'];

$sql="select DISTINCT(c.ID_CLIENTE) as ID_CLIENTE, c.NOM_CLIENTE, c.CUIT, c.CALLE, c.ALTURA, v.NOM_VENDEDOR from clientes c left join cli_x_ruta cli on c.ID_CLIENTE=cli.ID_CLIENTE left join perso_x_rut p on p.ID_RUTA=cli.ID_RUTA left join vendedores v on p.ID_VENDEDOR=v.ID_VENDEDOR where c.NOM_CLIENTE like ('%".$nombre."%')";

$res=mysqli_query($conn, $sql);

while($row=mysqli_fetch_assoc($res)){?>
	<tr>
		<td><?php echo $row['ID_CLIENTE']?></td>
		<td><?php echo $row['NOM_CLIENTE']?></td>
		<td><?php echo $row['CUIT']?></td>
		<td><?php echo $row['CALLE']." ".$row['ALTURA'];?></td>
		<td><?php echo $row['NOM_VENDEDOR']?></td>
		<td><a class="btn btn-primary" onClick="seleccionar_cliente(<?php echo $row['ID_CLIENTE']; ?>);" title="Seleccionar Cliente..">Seleccionar</a></td>
	</tr>
<?php
}
desconectar();
?>
</table>
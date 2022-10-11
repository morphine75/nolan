<table cellspacing="1" border="0" width="80%" class="table table-hover" id="listado_articulos">
	<thead>
		<tr>
			<th>Id</th>
			<th>Nombre</th>
			<th>Seleccionar</th>
		</tr>
	</thead>
<?php
include("../../inc/conexion.php");
conectar();

$nombre=$_REQUEST['cadena'];
$lista=$_REQUEST['lista'];
$fila=$_REQUEST['fila'];
$sql="SELECT DISTINCT (p.ID_ARTICULO), a.DESCRIPCION, a.CANTXCAJA, p.PRECIO, s.CANTIDAD_DISPONIBLE FROM articulos a, precio_venta p, stock_almacen s WHERE p.ID_ARTICULO=a.ID_ARTICULO and s.ID_ARTICULO=a.ID_ARTICULO and p.ID_LISTA=".$lista." and p.ID_ARTICULO=a.ID_ARTICULO and s.ID_ALMACEN=1 and a.DESCRIPCION like ('%".$nombre."%')";
$res=mysqli_query($conn, $sql);

while($row=mysqli_fetch_assoc($res)){?>
	<tr>
		<td><?php echo $row['ID_ARTICULO'];?></td>
		<td><?php echo $row['DESCRIPCION'];?></td>
		<td><a class="btn btn-primary" onClick="seleccionar_articulo(<?php echo $row['ID_ARTICULO'].', '.$lista.', '.$fila;?>)" title="Seleccionar Articulo..">Seleccionar</a></td>
	</tr>
<?php
}
desconectar();
?>
</table>
<?php
include("../inc/conexion.php");
conectar();
$ruta=$_REQUEST['path'];
?>
<h3>Stock</h3>
<div id="menu" align="left">
  <a class="btn btn-primary" onclick="editar('stock',0)" href="#modal-container-abm" data-toggle="modal"><span class="glyphicon glyphicon-plus-sign"></span> Nuevo</a>&emsp;
  <br />
  <hr>
</div>
<?php
$sql="select a.ID_ARTICULO, DESCRIPCION, CANTIDAD_FISICA, CANTIDAD_DISPONIBLE, CANTXCAJA from articulos a, stock_almacen s where s.ID_ARTICULO=a.ID_ARTICULO";
$res=mysqli_query($conn, $sql);
?>

<div id="listado">
	<table class="table table-hover" id="tabla_listado">
		<thead>
			<tr>
				<th>Id</th>
				<th>Nombre</th>
				<th>Bultos Existencia Fisica</th>
				<th>Unidades Existencia Fisica</th>
				<th>Bultos Existencia Disponible</th>
				<th>Unidades Existencia Disponible</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			<?php
			while ($row=mysqli_fetch_assoc($res)){?>
				<tr>
					<td><?php echo $row['ID_ARTICULO']?></td>
					<td><?php echo $row['DESCRIPCION']?></td>
					<td><?php echo floor($row['CANTIDAD_FISICA']/$row['CANTXCAJA'])?></td>
					<td><?php echo ($row['CANTIDAD_FISICA']%$row['CANTXCAJA'])?></td>
					<td><?php echo floor($row['CANTIDAD_DISPONIBLE']/$row['CANTXCAJA']);?></td>
					<td><?php echo ($row['CANTIDAD_DISPONIBLE']%$row['CANTXCAJA'])?></td>					
					<td>
	                	<a onclick="editar('stock', <?php echo $row['ID_ARTICULO']?>)" class="btn btn-primary" href="#modal-container-abm" data-toggle="modal"> <span class="glyphicon glyphicon-edit"></span> Modificar</a></td>
				</tr>
			<?php
			}
			?>
		</tbody>
	</table>
</div>

<div class="modal fade" id="modal-container-abm" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      </div>
      <div class="modal-body" id="modal-body">

      </div>
    </div>
  </div>
</div>
<br>
<?php
desconectar();
?>
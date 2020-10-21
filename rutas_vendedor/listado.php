<?php
include("../inc/conexion.php");
conectar();
$ruta=$_REQUEST['path'];
?>
<h3>Rutas por Vendedor</h3>
<div id="menu" align="left">
  <a class="btn btn-primary" onclick="editar('rutas_vendedor',0)" href="#modal-container-abm" data-toggle="modal"><span class="glyphicon glyphicon-plus-sign"></span> Nuevo</a>&emsp;
  <br />
  <hr>
</div>

<?php
$sql="select p.ID_RUTA, r.DESCRIPCION as RUTA, v.ID_VENDEDOR, v.NOM_VENDEDOR, p.DIAVIS from perso_x_rut p, vendedores v, rutas r WHERE r.ID_RUTA=p.ID_RUTA and v.ID_VENDEDOR=p.ID_VENDEDOR";
$res=mysqli_query($conn, $sql);
?>

<div id="listado">
	<table class="table table-hover" id="tabla_listado">
		<thead>
			<tr>
				<th>Id</th>
				<th>Ruta</th>				
				<th>Vendedor</th>
				<th>Dias de Visita</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			<?php
			while ($row=mysqli_fetch_assoc($res)){?>
				<tr>
					<td><?php echo $row['ID_RUTA'].$row['ID_VENDEDOR']?></td>
					<td><?php echo $row['RUTA']?></td>
					<td><?php echo $row['NOM_VENDEDOR']?></td>
					<td><?php echo $row['DIAVIS']?></td>
					<td><a class="btn btn-danger" onclick="anular('rutas_vendedor', '<?php echo $row['ID_RUTA']."-".$row['ID_VENDEDOR'];?>')" style="padding: 5px">
                	<span class="glyphicon glyphicon-remove"></span> Eliminar</a>
                	<!--<a onclick="editar('rutas_vendedor', '<?php echo $row['ID_RUTA']."-".$row['ID_VENDEDOR'];?>')" class="btn btn-primary" href="#modal-container-abm" data-toggle="modal"> <span class="glyphicon glyphicon-edit"></span> Modificar</a>--></td>
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
<?php
include("../inc/conexion.php");
conectar();
$ruta=$_REQUEST['path'];
?>
<h3>Clientes</h3>
<div id="menu" align="left">
  <a class="btn btn-primary" onclick="editar('clientes',0)" href="#modal-container-abm" data-toggle="modal"><span class="glyphicon glyphicon-plus-sign"></span> Nuevo</a>&emsp;
  <br />
  <hr>
</div>

<?php
$sql="select * from clientes where ANULADO=0";
$res=mysqli_query($conn, $sql);
?>

<div id="listado">
	<table class="table table-hover" id="tabla_listado">
		<thead>
			<tr>
				<th>Id</th>
				<th>Nombre</th>
				<th>Direccion</th>
				<th>Contacto</th>
				<th>Telefono</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			<?php
			while ($row=mysqli_fetch_assoc($res)){?>
				<tr>
					<td><?php echo $row['ID_CLIENTE']?></td>
					<td><?php echo $row['NOM_CLIENTE']?></td>
					<td><?php echo $row['DOMI_CLIENTE']?></td>
					<td><?php echo $row['CONTACTO']?></td>
					<td><?php echo $row['TELEFONOS']?></td>
					<td><a class="btn btn-danger" onclick="anular('clientes', <?php echo $row['ID_CLIENTE'];?>)" style="padding: 5px">
                	<span class="glyphicon glyphicon-remove"></span> Eliminar</a>
                	<a onclick="editar('clientes', <?php echo $row['ID_CLIENTE']?>)" class="btn btn-primary" href="#modal-container-abm" data-toggle="modal"> <span class="glyphicon glyphicon-edit"></span> Modificar</a></td>
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
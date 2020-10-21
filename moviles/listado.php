<?php
include("../inc/conexion.php");
conectar();
$ruta=$_REQUEST['path'];
?>
<h3>Moviles</h3>
<div id="menu" align="left">
  <a class="btn btn-primary" onclick="editar('moviles',0)" href="#modal-container-abm" data-toggle="modal"><span class="glyphicon glyphicon-plus-sign"></span> Nuevo</a>&emsp;
  <br />
  <hr>
</div>

<?php
$sql="SELECT * from moviles WHERE ANULADO=0";
$res=mysqli_query($conn, $sql);
?>

<div id="listado">
	<table class="table table-hover table-striped" id="tabla_listado">
		<thead>
			<tr>
				<th>Id</th>
				<th>Movil</th>
				<th>Chapa</th>
				<th>Vehiculo</th>
				<th>Modelo</th>
				<th>Peso Max.</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			<?php
			while ($row=mysqli_fetch_assoc($res)){?>
				<tr>
					<td><?php echo $row['ID_MOVIL']?></td>
					<td><?php echo $row['NOM_MOVIL']?></td>
					<td><?php echo $row['CHAPA']?></td>
					<td><?php echo $row['VEHICULO']?></td>
					<td><?php echo $row['MODELO']?></td>
					<td><?php echo $row['MAXPESO']?></td>
					<td>
						<a class="btn btn-danger" onclick="anular('moviles', <?php echo $row['ID_MOVIL'];?>)" style="padding: 5px">
                		<span class="glyphicon glyphicon-remove"></span> Eliminar</a>
                	<a onclick="editar('moviles', <?php echo $row['ID_MOVIL']?>)" class="btn btn-primary" href="#modal-container-abm" data-toggle="modal"> <span class="glyphicon glyphicon-edit"></span> Modificar</a></td>
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
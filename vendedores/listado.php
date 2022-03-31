<?php
include("../inc/conexion.php");
conectar();
$ruta=$_REQUEST['path'];
?>
<h3>Vendedores</h3>
<div id="menu" align="left">
  <a class="btn btn-primary" onclick="editar('vendedores',0)" href="#modal-container-abm" data-toggle="modal"><span class="glyphicon glyphicon-plus-sign"></span> Nuevo</a>&emsp;
  <br />
  <hr>
</div>

<?php
$sql="select * from vendedores where ANULADO=0";
$res=mysqli_query($conn, $sql);
?>

<div id="listado">
	<table class="table table-hover table-striped" id="tabla_listado">
		<thead>
			<tr>
				<th>Id</th>
				<th>Nombre</th>
				<th>Sucursal</th>
				<th>Cargo</th>
				<th>Superior</th>
				<th>Domicilio</th>
				<th>Telefono</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
			while ($row=mysqli_fetch_assoc($res)){?>
				<tr>
					<td><?php echo $row['ID_VENDEDOR']?></td>
					<td><?php echo $row['NOM_VENDEDOR']?></td>
					<td>
						<?php
							$sqlsuc="select * from sucursales where ID_SUCURSAL=".$row['ID_SUCURSAL'];
							$ressuc=mysqli_query($conn, $sqlsuc);
							$rowsuc=mysqli_fetch_assoc($ressuc);
							 echo $rowsuc['DESCRIPCION'];
						?>	 
					</td>
					<td><?php echo $row['CARGO']?></td>
					<td>
						<?php 
							if (isset($row['VEN_ID_VENDEDOR'])) {
								$sqlven="select * from vendedores where ID_VENDEDOR=".$row['VEN_ID_VENDEDOR'];
								$resven=mysqli_query($conn, $sqlven);
								$rowven=mysqli_fetch_assoc($resven);
								 echo $rowven['NOM_VENDEDOR'];
							}else{
								echo "No Posee";
							}
							
						?>
					</td>
					<td><?php echo $row['DOMICILIO']?></td>
					<td><?php echo $row['TELEFOS']?></td>
					<td><a class="btn btn-danger" onclick="anular('vendedores', <?php echo $row['ID_VENDEDOR'];?>)" style="padding: 5px">
                	<span class="glyphicon glyphicon-remove"></span> Eliminar</a>
                	</td>
                	<td><a onclick="editar('vendedores', <?php echo $row['ID_VENDEDOR']?>)" class="btn btn-primary" href="#modal-container-abm" data-toggle="modal"> <span class="glyphicon glyphicon-edit"></span> Modificar</a></td>
                	
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
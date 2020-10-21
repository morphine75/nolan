<?php
include("../inc/conexion.php");
conectar();
$ruta=$_REQUEST['path'];
?>
<h3>Proveedores</h3>
<div id="menu" align="left">
  <a class="btn btn-primary" onclick="editar('proveedores',0)" href="#modal-container-abm" data-toggle="modal"><span class="glyphicon glyphicon-plus-sign"></span> Nuevo</a>&emsp;
  <br />
  <hr>
</div>

<?php
$sql="select * from proveedores where ANULADO=0";
$res=mysqli_query($conn, $sql);
?>

<div id="listado">
	<table class="table table-hover table-striped" id="tabla_listado">
		<thead>
			<tr>
				<th>Id</th>
				<th>Nombre</th>
				<th>Direccion</th>
				<th>CUIT</th>
				<th>Telefono</th>
				<th>Condicion IVA</th>
				<th>Dias</th>
				<th>Ingresos Brutos</th>
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
			while ($row=mysqli_fetch_assoc($res)){?>
				<tr>
					<td><?php echo $row['ID_PROVEEDOR']?></td>
					<td><?php echo $row['NOMPROV']?></td>
					<td><?php echo $row['DOMIPROV']?></td>
					<td><?php echo $row['NUMCUIT']?></td>
					<td><?php echo $row['TELEFONO']?></td>
					<td><?php 
						$sqliva="select * from tipos_iva where ID_TIPO_IVA=".$row['ID_TIPO_IVA'];
						$resiva=mysqli_query($conn, $sqliva);
						$rowiva=mysqli_fetch_assoc($resiva);
						echo $rowiva['DESCRIPCION'];
						?>		
					</td>
					<td><?php echo $row['DIAS']?></td>
					<td><?php echo $row['NUMBRU']?></td>
					<td><a class="btn btn-danger" onclick="anular('proveedores', <?php echo $row['ID_PROVEEDOR'];?>)" style="padding: 5px">
                	<span class="glyphicon glyphicon-remove"></span> Eliminar</a>
                	</td>
                	<td><a onclick="editar('proveedores', <?php echo $row['ID_PROVEEDOR']?>)" class="btn btn-primary" href="#modal-container-abm" data-toggle="modal"> <span class="glyphicon glyphicon-edit"></span> Modificar</a></td>
                	
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
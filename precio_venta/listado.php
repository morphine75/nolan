<?php
include("../inc/conexion.php");
conectar();
$ruta=$_REQUEST['path'];
?>
<h3>Precios por Lista</h3>
<div id="menu" align="left">
  <a class="btn btn-primary" onclick="editar('precio_venta','0')" href="#modal-container-abm" data-toggle="modal"><span class="glyphicon glyphicon-plus-sign"></span> Nuevo</a>&emsp;
  <br />
  <hr>
</div>

<?php
$sql="SELECT A.ID_ARTICULO, L.ID_LISTA, A.DESCRIPCION AS ARTICULO, L.DESCRIPCION AS LISTA, P.PRECIO, A.CANTXCAJA from precio_venta P, articulos A, listas_precio L WHERE L.ID_LISTA=P.ID_LISTA AND A.ID_ARTICULO=P.ID_ARTICULO";
$res=mysqli_query($conn, $sql);
?>

<div id="listado">
	<table class="table table-hover" id="tabla_listado">
		<thead>
			<tr>
				<th>Id</th>
				<th>Articulo</th>
				<th>Lista de Precios</th>
				<th>Precio Bulto</th>
				<th>Precio Unitario</th>				
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			<?php
			while ($row=mysqli_fetch_assoc($res)){?>
				<tr>
					<td><?php echo $row['ID_ARTICULO'].$row['ID_LISTA']?></td>
					<td><?php echo $row['ARTICULO']?></td>
					<td><?php echo $row['LISTA']?></td>
					<td><?php echo $row['PRECIO']?></td>
					<td><?php echo number_format($row['PRECIO']/$row['CANTXCAJA'],2)?></td>
					<td>
						<a class="btn btn-danger" onclick="anular('precio_venta', '<?php echo $row['ID_ARTICULO']."-".$row['ID_LISTA'];?>')" style="padding: 5px">
                		<span class="glyphicon glyphicon-remove"></span> Eliminar</a>
                	<a onclick="editar('precio_venta','<?php echo $row['ID_ARTICULO']."-".$row['ID_LISTA'];?>')" class="btn btn-primary" href="#modal-container-abm" data-toggle="modal"> <span class="glyphicon glyphicon-edit"></span> Modificar</a></td>
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
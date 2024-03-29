<?php
include("../inc/conexion.php");
conectar();
$ruta=$_REQUEST['path'];
?>
<h3>Pedidos</h3>
<div id="menu" align="left">
  <a class="btn btn-primary" onclick="editar('pedidos',0)" href="#modal-container-abm" data-toggle="modal"><span class="glyphicon glyphicon-plus-sign"></span> Nuevo</a>&emsp;
  <br />
  <br />
  <a class="btn btn-primary" href="#modal-container-facturar" data-toggle="modal" onclick="cargar_pedidos()"><span class="glyphicon glyphicon-refresh"></span> Facturar Pedidos</a>&emsp;
  <br />  
  <hr>
</div>

<?php
$sql="SELECT P.ID_PEDIDO, P.ID_CLIENTE, P.ID_VENDEDOR, P.ANULADO, C.NOM_CLIENTE, C.FANTASIA, V.NOM_VENDEDOR, P.FECHA, P.HORA, P.TOTAL from pedidos P, clientes C, vendedores V where P.ID_CLIENTE=C.ID_CLIENTE AND P.PROCESADO=0 AND P.ID_VENDEDOR=V.ID_VENDEDOR";
$res=mysqli_query($conn, $sql);
?>

<div id="listado">
	<table class="table table-hover table-striped" id="tabla_listado">
		<thead>
			<tr>
				<th>Id</th>
				<th>Cliente</th>
				<th>Fantasia</th>
				<th>Vendedor</th>
				<th>Fecha</th>
				<th>Hora</th>
				<th>Total</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			<?php
			while ($row=mysqli_fetch_assoc($res)){?>
				<tr>
					<td><?php echo $row['ID_PEDIDO']?></td>
					<td><?php echo $row['NOM_CLIENTE']?></td>
					<td><?php echo $row['FANTASIA']?></td>
					<td><?php echo $row['NOM_VENDEDOR']?></td>
					<td><?php echo $row['FECHA']?></td>
					<td><?php echo $row['HORA']?></td>
					<td>$ <?php echo number_format($row['TOTAL'],2,",","")?></td>					
					<td>
						<a onclick="editar('pedidos', <?php echo $row['ID_PEDIDO']?>)" class="btn btn-primary" href="#modal-container-abm" data-toggle="modal"> <span class="glyphicon glyphicon-edit"></span> Modificar</a>
						<a onclick="ver('pedidos', <?php echo $row['ID_PEDIDO']?>)" class="btn btn-primary" href="#modal-container-abm" data-toggle="modal"> <span class="glyphicon glyphicon-search"></span> Ver Pedido</a>
						<a class="btn btn-danger" onclick="anular('pedidos', <?php echo $row['ID_PEDIDO'];?>)" style="padding: 5px">
                		<span class="glyphicon glyphicon-remove"></span> Eliminar</a>
					</td>
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
<div class="modal fade" id="modal-container-facturar" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
      	  <h2>FACTURAR PEDIDOS</h2>         
      </div>
      <div class="modal-body" id="modal-body-facturar">

      </div>
    </div>
  </div>
</div>
<?php
desconectar();
?>
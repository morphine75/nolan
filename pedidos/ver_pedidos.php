<?php
include("../inc/conexion.php");
conectar();
$id=$_REQUEST['id'];
$sql="SELECT * from pedidos p, clientes c where c.ID_CLIENTE=p.ID_CLIENTE AND p.ID_PEDIDO=".$id;
$res=mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($res);
?>
<div class="col-md-6">
	<table class="table">
		<thead>
			<tr class="encabezado_tabla">
				<th>Numero de Pedido</th>
				<th>Cliente</th>
			</tr>
			<tbody>
				<tr>
					<td><?php echo $row['ID_PEDIDO']?></td>
					<td><?php echo $row['NOM_CLIENTE']?></td>
				</tr>
			</tbody>
		</thead>
	</table>
</div>
<div class="col-md-6">
	<table class="table">
		<thead>
			<tr class="encabezado_tabla">
				<th>Fecha</th>
				<th>Total</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><?php echo $row['FECHA']?></td>
				<td>$ <?php echo $row['TOTAL']?></td>
			</tr>
		</tbody>		
	</table>
</div>
<?php
$sql="SELECT a.ID_ARTICULO, DESCRIPCION, CANT, PRECIO, BONIF from detalle_pedido d, articulos a where d.ID_ARTICULO=a.ID_ARTICULO AND d.ID_PEDIDO=".$id;
$res=mysqli_query($conn, $sql);
?>
<div class="col-md-12">
	<table class="table">
		<thead>
			<tr class="encabezado_tabla">
				<th>ID.Articulo</th>
				<th>Articulo</th>
				<th>Cantidad Pedida</th>
				<th>Bonificacion</th>
				<th>SubTotal</th>												
			</tr>
		</thead>
		<tbody>
		<?php
		while ($row=mysqli_fetch_assoc($res)){?>
			<tr>
				<td><?php echo $row['ID_ARTICULO']?></td>
				<td><?php echo $row['DESCRIPCION']?></td>
				<td><?php echo $row['CANT']?></td>
				<td><?php echo $row['BONIF']?></td>
				<td><?php echo $row['PRECIO']?></td>
			</tr>
		<?php
		}
		?>
		</tbody>
	</table>
</div>
<div class="modal-footer">  
  <button class="btn btn-primary" data-dismiss="modal" style="margin-left: 10px; border:none"><span class="glyphicon glyphicon-log-out"></span></span> Cerrar</button>
</div>
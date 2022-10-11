<?php
include("../inc/conexion.php");
conectar();
$ruta=$_REQUEST['path'];
?>
<h3>Listado de Comprobantes</h3>

<?php
$sql="SELECT P.ID_PEDIDO, P.ID_CLIENTE, P.ID_VENDEDOR, C.NOM_CLIENTE, C.FANTASIA, V.NOM_VENDEDOR, P.FECHA, P.HORA, P.TOTAL, CO.FECPAGA, CO.ID_DOCUMENTO, D.DESCRIPCION from pedidos P, clientes C, vendedores V, comprobantes CO, documentos D where P.ID_CLIENTE=C.ID_CLIENTE AND P.PROCESADO=1 AND P.ID_VENDEDOR=V.ID_VENDEDOR AND P.ID_PEDIDO=CO.ID_PEDIDO AND CO.ID_DOCUMENTO=D.ID_DOCUMENTO";
$res=mysqli_query($conn, $sql);
?>

<div id="listado">
	<table class="table table-hover table-striped" id="tabla_listado">
		<thead>
			<tr>
				<th>Pago</th>
				<th>Id</th>
				<th>Tipo</th>
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
					<td><?php if (isset($row['FECPAGA']) and $row['FECPAGA'] !=''){?> <span class="glyphicon glyphicon-ok"></span> <?php } ?></td>
					<td><?php echo $row['ID_PEDIDO']?></td>
					<td><?php echo $row['DESCRIPCION']?></td>
					<td><?php echo $row['NOM_CLIENTE']?></td>
					<td><?php echo $row['FANTASIA']?></td>
					<td><?php echo $row['NOM_VENDEDOR']?></td>
					<td><?php echo $row['FECHA']?></td>
					<td><?php echo $row['HORA']?></td>
					<td>$ <?php echo number_format($row['TOTAL'],2,",","")?></td>				
					<td>
						<a href="./facturas/pdf_factura.php?pedido=<?php echo $row['ID_PEDIDO']?>&documento=<?php echo $row['ID_DOCUMENTO']?>" class="btn btn-primary" target="_blank" data-toggle="modal"> <span class="glyphicon glyphicon-print"></span> Imprimir</a>
						<?php
					if ($row['ID_DOCUMENTO'] == 3)
						{ ?>
						<a id="rechazar_<?php echo $row['ID_PEDIDO'] ?>"  onclick="rechazar_pedido(<?php echo $row['ID_PEDIDO']?>, <?php echo $row['ID_DOCUMENTO']?>)" class="btn btn-danger"> <span class="glyphicon glyphicon-remove"></span> Pedido Rechazado</a>
						<a id="pago<?php echo $row['ID_PEDIDO'] ?>"  onclick="pago_pedido(<?php echo $row['ID_PEDIDO']?>, <?php echo $row['ID_DOCUMENTO']?>)" class="btn btn-success"> <span class="glyphicon glyphicon-usd"></span>Pago</a>
						<?php } ?>
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
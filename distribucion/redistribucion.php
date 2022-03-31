<style>
#leyenda{
	color: #61e177;
	font-size: 14px;
	font-weight: bold;
}

</style>
<script type="text/javascript">
	function editar(id_pedido){
		$('#quitar_'+id_pedido).css('display','none');
		$('#modificar_'+id_pedido).css('display','none');
		$('#cancelar_'+id_pedido).css('display','table-cell');
		$('#guardar_'+id_pedido).css('display','table-cell');
		$('#moviles_'+id_pedido).css('display','table-cell');
	}

	function cancelar(id_pedido){
		$('#quitar_'+id_pedido).css('display','table-cell');
		$('#modificar_'+id_pedido).css('display','table-cell');
		$('#cancelar_'+id_pedido).css('display','none');
		$('#guardar_'+id_pedido).css('display','none');		
		$('#moviles_'+id_pedido).css('display','none');		
	}
</script>
<?php
include("../inc/conexion.php");
conectar();
$movil=$_REQUEST['movil'];

$sql="SELECT p.ID_CLIENTE, p.ID_PEDIDO, c.NOM_CLIENTE, c.CALLE, c.ALTURA, sum(a.PESO*dp.CANT) as PESO, sum(p.TOTAL) as TOTAL , floor(sum(CANT/CANTXCAJA)) as BULTOS, sum(CANT mod CANTXCAJA) as UNIDADES, d.ID_MOVIL from distribucion d, moviles m, detalle_pedido dp, articulos a, pedidos p, clientes c where m.ID_MOVIL=d.ID_MOVIL and dp.ID_PEDIDO=d.ID_PEDIDO and a.ID_ARTICULO=dp.ID_ARTICULO and dp.ID_PEDIDO=p.ID_PEDIDO and d.ID_MOVIL=".$movil." and c.ID_CLIENTE=p.ID_CLIENTE GROUP BY ID_PEDIDO, ID_CLIENTE";
$res=mysqli_query($conn, $sql);

$sqlMoviles="SELECT * from moviles";
$resMoviles=mysqli_query($conn, $sqlMoviles);
$vecMoviles=array();
$i=0;
while ($rowMoviles=mysqli_fetch_assoc($resMoviles)){
	$vecMoviles[$i]['ID_MOVIL']=$rowMoviles['ID_MOVIL'];
	$vecMoviles[$i]['NOM_MOVIL']=$rowMoviles['NOM_MOVIL'];
	$i++;
}

?>
<legend id="leyendas" class=""></legend>
<table class="table">
	<caption><a class="btn btn-primary" onclick="quitar_carga(<?php echo $movil?>)">Quitar toda la carga del movil</a></caption>
	<thead>
		<tr>
			<th>CODIGO CLIENTE</th>
			<th>CLIENTE</th>
			<th>DIRECCION</th>
			<th>PESO DE LA CARGA</th>
			<th>TOTAL $</th>
			<th>BULTOS</th>
			<th>UNIDADES</th>
			<th>ACCIONES</th>
		</tr>
	</thead>
	<tbody>
<?php
while ($row=mysqli_fetch_assoc($res)){?>
	<tr>
		<td><?php echo $row['ID_CLIENTE']?></td>
		<td><?php echo $row['NOM_CLIENTE']?></td>
		<td><?php echo $row['CALLE']." ".$row['ALTURA']?></td>
		<td><?php echo $row['PESO']?></td>
		<td><?php echo $row['TOTAL']?></td>
		<td><?php echo $row['BULTOS']?></td>
		<td><?php echo $row['UNIDADES']?></td>
		<td>
			<select id="moviles_<?php echo $row['ID_PEDIDO']?>" style="display: none">
				<?php
				for ($i=0;$i<count($vecMoviles);$i++){
				?>
					<option value="<?php echo $vecMoviles[$i]['ID_MOVIL']?>"><?php echo $vecMoviles[$i]['NOM_MOVIL'] ?></option>
				<?php
				}
				?>
			</select>
			<a id="quitar_<?php echo $row['ID_PEDIDO']?>" class="btn btn-danger" onclick="quitar_pedido(<?php echo $row['ID_PEDIDO']?>, <?php echo $movil?>)" style="padding: 5px"><span class="glyphicon glyphicon-remove"></span> Quitar pedido del movil</a>
			<a id="modificar_<?php echo $row['ID_PEDIDO'] ?>" onclick="editar(<?php echo $row['ID_PEDIDO']?>)" class="btn btn-primary"> <span class="glyphicon glyphicon-edit"></span> Modificar de movil</a>
			<a id="cancelar_<?php echo $row['ID_PEDIDO'] ?>" style="display: none; padding: 5px" onclick="cancelar(<?php echo $row['ID_PEDIDO']?>)" class="btn btn-primary"> <span class="glyphicon glyphicon-ban-circle"></span> Cancelar la modificacion</a>
			<a id="guardar_<?php echo $row['ID_PEDIDO'] ?>" style="display: none" onclick="guardar_redistribucion(<?php echo $row['ID_PEDIDO']?>, <?php echo $movil?>)" class="btn btn-primary"> <span class="glyphicon glyphicon-ok-sign"></span> Confirmar la modificacion</a>
		</td>

	</tr>
<?php
}
desconectar();
?>
	</tbody>
</table>

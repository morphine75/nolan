<?php
include("../inc/conexion.php");
conectar();

$sqlMoviles="SELECT * from moviles where ANULADO=0";
$resMoviles=mysqli_query($conn, $sqlMoviles);
$vecMoviles=array();
$i=0;
while ($rowMoviles=mysqli_fetch_assoc($resMoviles)){
	$vecMoviles[$i]['ID_MOVIL']=$rowMoviles['ID_MOVIL'];
	$vecMoviles[$i]['NOM_MOVIL']=$rowMoviles['NOM_MOVIL'];
	$i++;
}

?>
<legend>COMPOSICION DE CARGA</legend>
<br>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<div class="tabbable" id="tabs">
				<ul class="nav nav-tabs">
					<?php
					for ($i=0;$i<count($vecMoviles);$i++){
					?>
					<li class="nav-item <?php if ($i==0) { echo "active";}?>">
						<a class="nav-link" href="#<?php echo $vecMoviles[$i]['ID_MOVIL']?>" data-toggle="tab"><span style="font-size: 24px; color: Black;"><i class="fas fa-truck"></i></span>  <?php echo $vecMoviles[$i]['NOM_MOVIL'];?></a>
					</li>
					<?php
					}
					?>
				</ul>
				<div class="tab-content">
					<?php
					for ($i=0;$i<count($vecMoviles);$i++){
						$sql="SELECT SUM( a.PESO * ( CANT / CANTXCAJA ) ) AS PESO, p1.TOTAL AS TOTAL, SUM( FLOOR( CANT / CANTXCAJA ) ) AS BULTOS, SUM( CANT mod CANTXCAJA ) AS UNIDADES, d.ID_MOVIL, d.ID_MOVIMIENTO FROM (SELECT SUM( p.total ) AS total, d.id_movil FROM pedidos p, distribucion d WHERE p.id_pedido = d.id_pedido GROUP BY d.id_movil)p1, distribucion d, moviles m, detalle_pedido dp, articulos a, pedidos p WHERE m.ID_MOVIL = d.ID_MOVIL AND p1.id_movil = d.id_movil AND dp.ID_PEDIDO = d.ID_PEDIDO AND a.ID_ARTICULO = dp.ID_ARTICULO AND dp.ID_PEDIDO = p.ID_PEDIDO AND d.ID_MOVIL=".$vecMoviles[$i]['ID_MOVIL'];
						$res=mysqli_query($conn, $sql);
						$row=mysqli_fetch_assoc($res);
					?>

					<div class="tab-pane <?php if ($i==0) { echo "active";}?>" id="<?php echo $vecMoviles[$i]['ID_MOVIL']?>">
						<p>
							<form id="form_<?php echo $vecMoviles[$i]['ID_MOVIL']?>">
								<br>
								<table class="table table-striped">
									<thead>
										<tr>
											<th colspan="2"><a href="#" class="btn btn-primary" onclick="generar_planilla_carga(<?php echo $vecMoviles[$i]['ID_MOVIL']?>)" id="btn_generar<?php echo $vecMoviles[$i]['ID_MOVIL']?>" <?php if ($row['ID_MOVIMIENTO']!=0){ echo "style='display:none'";} ?>>Guardar Composicion y Generar Planilla de Carga</a></th>
											<th>Fecha de Entrega</th>
											<th><input type="date" id="fecha_entrega_<?php echo $vecMoviles[$i]['ID_MOVIL']?>" <?php if ($row['ID_MOVIMIENTO']!=0){ echo "style='display:none'";} ?>></th>
										</tr>
										<tr>
											<th><b><span id="span_num_composicion"></span></b></th>
											<th colspan="3"><a href="./informes/composicion_carga/pdf_composicion_carga.php?id_movil=<?php echo $vecMoviles[$i]['ID_MOVIL']?>&nom_movil=<?php echo $vecMoviles[$i]['NOM_MOVIL']?>" class="btn btn-primary" target="_blank" <?php if ($row['ID_MOVIMIENTO']==0){ echo "style='display:none'";} ?> id="btn_imprimir<?php echo $vecMoviles[$i]['ID_MOVIL']?>">Imprimir Composicion</a></th>
										</tr>
										<tr>
											<th colspan="4" class="success"><?php echo $vecMoviles[$i]['NOM_MOVIL'] ?></th>
										</tr>
										<tr>
											<th align="center" class="alert-info">PESO</th>
											<th><?php echo $row['PESO']?></th>
											<th align="center" class="alert-info">BULTOS</th>
											<th><?php echo $row['BULTOS']?></th>
										</tr>
										<tr>
											<th align="center" class="alert-info">TOTAL $</th>
											<th><?php echo number_format($row['TOTAL'],2,",","")?></th>
											<th align="center" class="alert-info">UNIDADES</th>
											<th><?php echo $row['UNIDADES']?></th>
										</tr>
										<tr>
											<th>CODIGO</th>
											<th>ARTICULO</th>
											<th>BULTOS</th>
											<th>UNIDADES</th>
										</tr>
									</thead>
									<tbody>
									<?php
									$sqlDetalle="SELECT sum(a.PESO*(CANT/CANTXCAJA)) as PESO, sum(floor(CANT/CANTXCAJA)) as BULTOS, sum(CANT mod CANTXCAJA) as UNIDADES, a.ID_ARTICULO, a.DESCRIPCION from distribucion d, moviles m, detalle_pedido dp, articulos a, pedidos p where m.ID_MOVIL=d.ID_MOVIL and dp.ID_PEDIDO=d.ID_PEDIDO and a.ID_ARTICULO=dp.ID_ARTICULO and dp.ID_PEDIDO=p.ID_PEDIDO AND d.ID_MOVIL=".$vecMoviles[$i]['ID_MOVIL']." group by a.ID_ARTICULO";
									$resDetalle=mysqli_query($conn, $sqlDetalle);
									while ($rowDetalle=mysqli_fetch_assoc($resDetalle)){
									?>
										<tr>
											<td><?php echo $rowDetalle['ID_ARTICULO']?></td>
											<td><?php echo $rowDetalle['DESCRIPCION']?></td>
											<td><?php echo $rowDetalle['BULTOS']?></td>
											<td><?php echo $rowDetalle['UNIDADES']?></td>
										</tr>
									<?php
									}
									?>
									</tbody>
								</table>
							</form>				
						</p>													
					</div>
					<?php
					}
					?>					
				</div>
			</div>
		</div>
	</div>
</div>

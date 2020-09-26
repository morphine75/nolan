<link rel="stylesheet" href="../css/estilo_datatable.css">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="../css/jquery-confirm.min.css"><!--css de alert-->
<script type="text/javascript" src="../js/jquery-confirm.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script type="text/javascript">
var art_unidades=[];
var art_bultos=[];
var filas=0;
var total=0;
$( document ).ready(function() {
	$('#tabla_listado').DataTable();
	$('#tabla_articulos').DataTable({
		"lengthMenu": [ 10, 25, 50, 75, 100 ],
		"pageLength": 50}
	);
});

function carga_pedido_unidades(articulo, descripcion, precio){
	filas++;
	total=total+parseInt(precio);
    $("#tabla_listado_pedido").append('<tr id="tr_'+filas+'"><td>'+articulo+'</td><td>'+descripcion+'</td><td>$ '+precio+'</td><td>U</td><td><a href="#" onclick="quitar_fila('+filas+', '+precio+','+articulo+')"><img src="imagenes/descheck.png" style="width:20px"></a></td></tr>');
    $("#formulario").append("<input type='hidden' name='articulo[]' id='hd_"+filas+articulo+"' value='"+articulo+"-U'>");
	$('#total').html('$ '+total);

}

function carga_pedido_bultos(articulo, descripcion, precio){
	filas++;	
	total=total+parseInt(precio);
    $("#tabla_listado_pedido").append('<tr id="tr_'+filas+'"><td>'+articulo+'</td><td>'+descripcion+'</td><td>$ '+precio+'</td><td>B</td><td><a href="#" onclick="quitar_fila('+filas+', '+precio+','+articulo+')"><img src="imagenes/descheck.png" style="width:20px"></a></td></tr>');
    $("#formulario").append("<input type='hidden' name='articulo[]' id='hd_"+filas+articulo+"' value='"+articulo+"-B'>")     
    $('#total').html('$ '+total);
}

function quitar_fila(fila, precio, articulo){
  $('#tr_'+fila).remove();
  total=total-parseInt(precio);
  $('#total').html('$ '+total);
  $('#hd_'+fila+articulo).remove(); 
}

function limpiar(){
	$('#tabla_listado_pedido tr').empty();
	$('#total').html('$ 0');
	total=0;
}

function alertas(msj)
{
  $.alert({
    title: 'Alerta!',
    //content: 'alerta común. <br> algo de <strong>HTML</strong> <em>con tags =)</em>',
    content: msj,
    icon: 'fa fa-rocket',
    animation: 'scale',
    closeAnimation: 'scale',
    buttons: {
      okay: {
        text: 'OK!',
        btnClass: 'btn-blue'
      }
    }
  });
}

function guardar_pedido(){
  $.post("controlador.php?f=guardar",$("#formulario").serialize(),function(dato){
    alertas(dato);
    cerrar();
  });  
}

function carga_cabecera(cliente, vendedor, nom_cliente){
	$('#cliente').val(cliente);
	$('#vendedor').val(vendedor);
	$('#nombre_cliente').html(nom_cliente);
}

function cerrar(){
	$('#modal-container-abm').modal('hide');
	$('body').removeClass('modal-open');
	$('.modal-backdrop').remove();
}

</script>

<?php

function saber_dia($nombredia) {
	$dias = array('0','1','2','3','4','5','6');
	$fecha = $dias[date('N', strtotime($nombredia))];
	return $fecha;
}


include("../inc/conexion.php");
conectar();



$id=$_REQUEST['id'];

$sql="SELECT c.ID_CLIENTE, c.NOM_CLIENTE, c.CALLE, c.ALTURA, count(ID_PEDIDO) AS PEDIDOS from cli_x_ruta cli, perso_x_rut p, clientes c left join pedidos e on e.ID_CLIENTE=c.ID_CLIENTE where p.ID_RUTA=cli.ID_RUTA and cli.ID_CLIENTE=c.ID_CLIENTE and P.DIAVIS=".saber_dia(date('Y-m-d'))." and p.ID_VENDEDOR=".$id." GROUP BY c.ID_CLIENTE";
$res=mysqli_query($conn, $sql);
?>
<div id="listado">
	<table class="table table-striped" id="tabla_listado">
		<thead>
			<tr>
				<th>Id</th>
				<th>Nombre</th>
				<th>Direccion</th>
			</tr>
		</thead>
		<tbody>
			<?php
			while ($row=mysqli_fetch_assoc($res)){
				?>
				<tr>
					<td><a href="#modal-container-abm" data-toggle="modal" onclick="carga_cabecera(<?php echo $row['ID_CLIENTE']?>, <?php echo $id?>, '<?php echo $row['NOM_CLIENTE']?>')"><?php echo $row['ID_CLIENTE']?></a>
					<?php
					if ($row['PEDIDOS']>0){?>
						<span class="glyphicon glyphicon-thumbs-up"></span>
					<?php
					}
					?>
					</td>
					<td><a href="#modal-container-abm" data-toggle="modal" onclick="carga_cabecera(<?php echo $row['ID_CLIENTE']?>, <?php echo $id?>, '<?php echo $row['NOM_CLIENTE']?>')"><?php echo $row['NOM_CLIENTE']?></a></td>
					<td><a href="#modal-container-abm" data-toggle="modal" onclick="carga_cabecera(<?php echo $row['ID_CLIENTE']?>, <?php echo $id?>, '<?php echo $row['NOM_CLIENTE']?>')"><?php echo $row['CALLE']." ".$row['ALTURA']?></a></td>
				</tr>
			<?php
			}
			?>
		</tbody>
	</table>
</div>
<?php
$sql="select A.ID_ARTICULO, A.DESCRIPCION, A.CANTXCAJA, P.PRECIO from articulos a, precio_venta p where a.id_articulo=p.id_articulo";
$res=mysqli_query($conn, $sql);
?>
<div class="modal fade" id="modal-container-abm" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
         <button type="button" class="close" data-dismiss="modal" aria-hidden="true" onclick="limpiar();">×</button>
      </div>
      <div id="ver"></div>
      <div>
      	<form id="formulario">
      		<input type="hidden" name="cliente" id="cliente">
      		<input type="hidden" name="vendedor" id="vendedor">
      	</form>
      	<legend align="center"><span id="nombre_cliente"></span></legend>
      	<table id="tabla_listado_pedido" class="table table-striped">
      	<legend align="center">Pedido</legend>
      	</table>
      	<h4 align="center">Total del Pedido  <span id="total"></span></h4> 
      	<p align="center"><a class="btn btn-primary" onclick="guardar_pedido()">Guardar Pedido</a></p>     	
      </div>
      <hr>
      <div class="modal-body" id="modal-body">
      	<table id="tabla_articulos" class="table">      		
      		<thead>
      			<tr>
      				<th>Cod.</th>
      				<th>Articulo</th>
      				<th>Pr.Bulto</th>
      				<th>Pr.Unitario</th>
      			</tr>
      		</thead>
      		<tbody>
      			<?php
      			while ($row=mysqli_fetch_assoc($res)){?>
      				<tr>
      					<td><?php echo $row['ID_ARTICULO'];?></td>
      					<td><?php echo $row['DESCRIPCION'];?></td>
      					<td><a><span class="glyphicon glyphicon-plus-sign" onclick="carga_pedido_bultos('<?php echo $row['ID_ARTICULO']?>','<?php echo $row['DESCRIPCION'];?>', <?php echo $row['PRECIO'];?>)"></span></a> <?php echo $row['PRECIO'];?></td>
      					<td><a><span class="glyphicon glyphicon-plus-sign" onclick="carga_pedido_unidades('<?php echo $row['ID_ARTICULO']?>','<?php echo $row['DESCRIPCION'];?>', <?php echo number_format($row['PRECIO']/$row['CANTXCAJA'],2)?>)"></span></a> <?php echo number_format($row['PRECIO']/$row['CANTXCAJA'],2);?></td>
      				</tr>
      			<?php
      			}
      			?>
      		</tbody>
      	</table>
      </div>
    </div>
  </div>
</div>
<?php
desconectar();
?>
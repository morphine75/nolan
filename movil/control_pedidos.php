<link rel="stylesheet" href="../css/estilo_datatable.css">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="../js/jquery.dataTables.min.js"></script>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link rel="stylesheet" href="../css/jquery-confirm.min.css"><!--css de alert-->
<script type="text/javascript" src="../js/jquery-confirm.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
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
    $("#tabla_listado_pedido").append('<tr id="tr_'+filas+'" class="fila"><td>'+articulo+'</td><td>'+descripcion+'</td><td>$ '+precio+'</td><td>U</td><td><a href="#" onclick="quitar_fila('+filas+', '+precio+','+articulo+')"><img src="imagenes/descheck.png" style="width:20px"></a></td></tr>');
    $("#formulario").append("<input type='hidden' name='articulo[]' id='hd_"+filas+articulo+"' value='"+articulo+"-U'>");
	$('#total').html('$ '+total);

}

function carga_pedido_bultos(articulo, descripcion, precio){
	filas++;	
	total=total+parseInt(precio);
    $("#tabla_listado_pedido").append('<tr id="tr_'+filas+'" class="fila"><td>'+articulo+'</td><td>'+descripcion+'</td><td>$ '+precio+'</td><td>B</td><td><a href="#" onclick="quitar_fila('+filas+', '+precio+','+articulo+')"><img src="imagenes/descheck.png" style="width:20px"></a></td></tr>');
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
    icon: 'fa fa-exclamation',
    animation: 'scale',
    closeAnimation: 'scale',
    buttons: {
      okay: {
        text: 'OK!',
        btnClass: 'btn-blue',
        action: function () { 
        	location.reload();
        }
      }
    }
  });
}

function guardar_pedido(){
  $.post("controlador.php?f=guardar",$("#formulario").serialize(),function(dato){
    alertas(dato);
    cerrar();
    $('.fila').remove();
    $('#total').html('');
    var cliente=$('#cliente').val();
    $('#thumb_'+cliente).css('display','inline');
  });
}

function carga_cabecera(idpedido){
	$.ajax({
		url:'carga_pedido.php',
		type:'POST',
		data:'idpedido='+idpedido,
		success: function (a){
			$('#modal-body').html(a);
		}
	})
}

function cerrar(){
	$('#modal-container-abm').modal('hide');
	$('body').removeClass('modal-open');
	$('.modal-backdrop').remove();
}

function eliminar_pedido(id){
	$.confirm({
    title: 'Confirmar Acción',
    content: 'Desea eliminar el registro?',
    icon: 'glyphicon glyphicon-question-sign',
    animation: 'scale',
    closeAnimation: 'scale',
    opacity: 0.5,
    buttons: {
        confirm: {
            text: 'SI',
            btnClass: 'btn-green', 
            action: function () {         
                //accion de eliminar
                var dataString='f=eliminar_pedido&id='+id;
                $.ajax({
					url:'./controlador.php',
                	type:'post',
                	data: dataString,
                	success: function(a){
                		alertas(a);
                	}
                })
                //fin de accion eliminar
            }
        },
        cancel: {
            text: 'NO',
            btnClass: 'btn-red',
            action: function () {
              $.alert('Accion Cancelada');
            }
        }
    }
  });   
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

$sql="SELECT c.ID_CLIENTE, c.NOM_CLIENTE, e.FECHA, e.TOTAL, e.ID_PEDIDO from clientes c, pedidos e where e.ID_CLIENTE=c.ID_CLIENTE and e.ID_VENDEDOR=".$id;
$res=mysqli_query($conn, $sql);

$sqlTotal="SELECT sum(e.TOTAL) as TOTAL from pedidos e where e.ID_VENDEDOR=".$id;
$resTotal=mysqli_query($conn, $sqlTotal);
$rowTotal=mysqli_fetch_assoc($resTotal);
?>
<button type="button" class="btn btn-primary btn-lg btn-block" style="height: 50px; font-size: 24px" onclick="window.history.go(-1)"><i class="fas fa-arrow-left"></i>  Volver</button></a>
<div id="listado">
	<table class="table" style="font-size: 30px">
		<thead>
			<tr align="center">
				<th>Total Pedidos</th>
				<th>$ <?php echo number_format($rowTotal['TOTAL'],2)?></th>
			</tr>
		</thead>
	</table>
	<table class="table table-striped" id="tabla_listado">
		<thead>
			<tr>
				<th>Id</th>
				<th>Nombre</th>
				<th>Fecha</th>
				<th>Total</th>
				<th>Acciones</th>
			</tr>
		</thead>
		<tbody>
			<?php
			while ($row=mysqli_fetch_assoc($res)){
				?>
				<tr>
					<td><a href="#modal-container-abm" data-toggle="modal" onclick="carga_cabecera(<?php echo $row['ID_CLIENTE']?>)"><?php echo $row['ID_CLIENTE']?></a>
					</td>
					<td><a href="#modal-container-abm" data-toggle="modal" onclick="carga_cabecera(<?php echo $row['ID_CLIENTE']?>)"><?php echo $row['NOM_CLIENTE']?></a></td>
					<td><a href="#modal-container-abm" data-toggle="modal" onclick="carga_cabecera(<?php echo $row['ID_CLIENTE']?>)"><?php echo $row['FECHA']?></a></td>
					<td><a href="#modal-container-abm" data-toggle="modal" onclick="carga_cabecera(<?php echo $row['ID_CLIENTE']?>)"><?php echo $row['TOTAL']?></a></td>		
					<td><a onclick="eliminar_pedido(<?php echo $row['ID_PEDIDO']?>)" href="#"><span style="font-size: 24px; color: Red;"><i class="fas fa-trash"></i></span></a><br><br><a href="#modal-container-abm" data-toggle="modal" onclick="carga_cabecera(<?php echo $row['ID_PEDIDO']?>)"><span style="font-size: 24px; color:#52a4ff"><i class="fas fa-search-plus"></i></span></a></td>			
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
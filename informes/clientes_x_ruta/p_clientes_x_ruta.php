<?php
include("../../inc/conexion.php");
conectar();
$ruta=$_REQUEST['path'];
$sql="SELECT * from rutas where id_tipo_ruta=1 and anulado=0";
$res=mysqli_query($conn, $sql);
?>
<h3>Informe Clientes por Ruta</h3>
<div id="menu" align="left">
  <hr>
</div>
<div id="listado">
	<form id="formulario">
		<table class="table">
			<tr>
				<td>Seleccione una Ruta: </td>
				<td><select id="ruta" name="ruta">
					<?php
					while ($row=mysqli_fetch_assoc($res)){?>
						<option value="<?php echo $row['ID_RUTA']?>"><?php echo $row['DESCRIPCION'];?></option>
					<?php
					}
					?>
				</select></td>
			</tr>
			<tr>
				<td><a class="btn btn-primary" onclick="ver_informe('clientes_x_ruta')" href="#modal-container-abm" data-toggle="modal"><span class="glyphicon glyphicon-plus-sign"></span> Ver Listado</a>&emsp;</td>
				<td><a class="btn btn-primary" onclick="imprimir_informe('clientes_x_ruta')" href="#modal-container-abm" data-toggle="modal"><span class="glyphicon glyphicon-print"></span> Imprimir Listado</a>&emsp;  </td>
			</tr>
		</table>
	</form>
</div>
<div id="resultado">
</div>

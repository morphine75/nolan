<?php
include("../../inc/conexion.php");
conectar();
$id=$_GET['id'];

$sql="SELECT DISTINCT(c.ID_CLIENTE) as ID_CLIENTE, c.ID_LISTA, c.NOM_CLIENTE, c.CUIT, c.CALLE, c.ALTURA, v.NOM_VENDEDOR, v.ID_VENDEDOR from clientes c left join cli_x_ruta cli on c.ID_CLIENTE=cli.ID_CLIENTE left join perso_x_rut p on p.ID_RUTA=cli.ID_RUTA left join vendedores v on p.ID_VENDEDOR=v.ID_VENDEDOR where c.ID_CLIENTE=".$id;

$sql=mysqli_query($conn,$sql);
$row=mysqli_fetch_assoc($sql);
?>
<div class="col-md-6">
  <fieldset style="width:90%; margin:10px auto;">
    <input type="hidden" value="<?php echo $id;?>" name="id_cliente" id="id_cliente" />
    <input type="hidden" value="<?php if (!is_null($row['ID_VENDEDOR'])){ echo $row['ID_VENDEDOR'];} else { echo "0";}?>" name="id_vendedor" id="id_vendedor" />
    <input type="hidden" value="<?php echo $row['ID_LISTA'];?>" name="id_lista" id="id_lista" />

    <p class="p_form">
    	<strong> Cliente: <?php echo $row['NOM_CLIENTE']  ;?> </strong>
    </p>
    <p class="p_form">
    	<strong> Direccion: <?php echo $row['CALLE']." ".$row['ALTURA'];?></strong>
    </p>
    <p class="p_form">
    	<strong> CUIT: <?php echo $row['CUIT']  ;?> </strong>
    </p>
    <p class="p_form">
    	<strong> Vendedor: <?php if (!is_null($row['NOM_VENDEDOR'])) { echo $row['NOM_VENDEDOR'];} else { echo "MOSTRADOR";} ?> </strong>
    </p>
  </fieldset>
</div>
<?php
$sql="SELECT * from cli_x_ruta c, rutas r, perso_x_rut p where r.ID_RUTA=c.ID_RUTA and p.ID_RUTA=r.ID_RUTA and c.ID_CLIENTE=".$id;

$sql=mysqli_query($conn,$sql);
$ruta='';
$dias_visita='';
while ($row=mysqli_fetch_assoc($sql)){
  $ruta=$row['DESCRIPCION'];
  if ($row['DIAVIS']==1){
    $dias_visita.="Lunes - ";
  }
  if ($row['DIAVIS']==2){
    $dias_visita.="Martes - ";
  }
  if ($row['DIAVIS']==3){
    $dias_visita.="Miercoles - ";
  }
  if ($row['DIAVIS']==4){
    $dias_visita.="Jueves - ";
  }
  if ($row['DIAVIS']==5){
    $dias_visita.="Viernes - ";
  }
  if ($row['DIAVIS']==6){
    $dias_visita.="Sabado - ";
  }
}

$dias_visita=substr($dias_visita, 0, -2);

?>
<div class="col-md-6">
  <fieldset style="width:90%; margin:10px auto;">
    <p class="p_form">
      <strong> Ruta: <?php echo $ruta;?> </strong>
    </p>
    <p class="p_form">
      <strong> Dias de Visita: <?php echo $dias_visita;?></strong>
    </p>
    <br>
    <br>
    <br>
  </fieldset>
</div>
<?php
desconectar();
?>
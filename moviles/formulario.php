<?php
include("../inc/conexion.php");
conectar();
?>
  <div> 
   <?php
   if($_REQUEST['id']>0){
    $titulo="Editar Movil";
    $id=$_REQUEST['id'];
    $sql=mysqli_query($conn,"SELECT * FROM MOVILES WHERE ID_MOVIL=".$id);
    $row=mysqli_fetch_assoc($sql);   
  }
  else{
    $titulo="Nuevo Movil";
    $id=0;
  }
  ?>
  <h2><?php echo $titulo; ?></h2>
  <fieldset>
    <form method="post" id="formulario">
      <p class="p_form"><label>(*)Nombre:</label>
        <input type="text" size="40" class="e_form" name="nombre" id="nombre" value="<?php if(isset($row)) { echo $row['NOM_MOVIL'];}?>"/>
      </p>
      <p class="p_form"><label>Chapa</label>
        <input type="text" size="10" class="e_form" name="chapa" id="chapa" value="<?php if(isset($row)) { echo $row['CHAPA'];}?>"/>        
      </p>
      <p class="p_form"><label>Vehiculo</label>
        <input type="text" size="40" class="e_form" name="vehiculo" id="vehiculo" value="<?php if(isset($row)) { echo $row['VEHICULO'];}?>"/>        
      </p>      
      <p class="p_form"><label>Modelo</label>
        <input type="number" class="e_form" name="modelo" id="modelo" value="<?php if(isset($row)) { echo $row['MODELO'];}?>"/>        
      </p>  
      <p class="p_form"><label>Peso Maximo</label>
        <input type="text" size="10" class="e_form" name="peso_max" id="peso_max" value="<?php if(isset($row)) { echo $row['MAXPESO'];}?>"/>        
      </p>  
      <br>
    </form>
    <div class="modal-footer">  
      <button class="btn btn-primary" data-dismiss="modal" onclick="controlar('moviles',<?php echo $id; ?>)"  style="margin-left: 10px; border:none"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button> <button type="button" class="btn btn-default" data-dismiss="modal" onclick="limpia_div()">Cancelar</button>
    </div>
  </fieldset>
</div>
<?php
desconectar();
?>
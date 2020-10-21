<?php
include("../inc/conexion.php");
conectar();
?>
  <div> 
   <?php
   if($_REQUEST['id']>0){
    $titulo="Editar Deposito";
    $id=$_REQUEST['id'];
    $sql=mysqli_query($conn,"SELECT * FROM depositos WHERE ID_DEPOSITO=".$id);
    $row=mysqli_fetch_assoc($sql);   
  }
  else{
    $titulo="Nuevo Deposito";
    $id=0;
  }
  ?>
  <h2><?php echo $titulo; ?></h2>
  <fieldset>
    <form method="post" id="formulario">
      <p class="p_form"><label>Nombre:</label>
        <input type="text" size="40" class="e_form" name="nombre" id="nombre" value="<?php if(isset($row)) { echo $row['DESCRIPCION'];}?>"/>
      </p>
      <p class="p_form"><label>Calle</label>
        <input type="text" name="calle" class="e_form" id="calle" size="20" value="<?php if(isset($row)) { echo $row['CALLE'];}?>"/>
      </p>
      <p class="p_form"><label>Altura</label>
        <input type="text" name="altura" class="e_form" id="altura" size="20" value="<?php if(isset($row)) { echo $row['ALTURA'];}?>"/>
      </p>
      <br>
    </form>
    <div class="modal-footer">  
      <button class="btn btn-primary" data-dismiss="modal" onclick="controlar('depositos',<?php echo $id; ?>)"  style="margin-left: 10px; border:none"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button> <button type="button" class="btn btn-default" data-dismiss="modal" onclick="limpia_div()">Cancelar</button>
    </div>
  </fieldset>
</div>
<?php
desconectar();
?>
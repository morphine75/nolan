<?php
include("../inc/conexion.php");
conectar();
?>
  <div> 
   <?php
   if($_REQUEST['id']!='0'){
    $titulo="Editar Tipo de Movimiento";
    $id=$_REQUEST['id'];
    $sql="SELECT * FROM tipomov WHERE TIPOMOV='".$id."'";
    $sql=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($sql);   
  }
  else{
    $titulo="Nuevo Tipo de Movimiento";
    $id='0';
  }
  ?>
  <h2><?php echo $titulo; ?></h2>
  <fieldset>
    <form method="post" id="formulario">
      <p class="p_form"><label>Nombre:</label>
        <input type="text" size="40" class="e_form" name="nombre" id="nombre" value="<?php if(isset($row)) { echo $row['TIPOMOV'];}?>"/>
      </p>
      <p class="p_form"><label>Descripcion:</label>
        <input type="text" size="40" class="e_form" name="descripcion" id="descripcion" value="<?php if(isset($row)) { echo $row['DESCMOV'];}?>"/>
      </p>      
      <p class="p_form"><label>Signo:</label>
        <select name="signo">
          <option value="+"><b>+</b></option>
          <option value="-"><b>-</b></option>
        </select>
      </p>      
      <br>
    </form>
    <div class="modal-footer">  
      <button class="btn btn-primary" data-dismiss="modal" onclick="controlar('tipos_movimiento','<?php echo $id; ?>')"  style="margin-left: 10px; border:none"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button> <button type="button" class="btn btn-default" data-dismiss="modal" onclick="limpia_div()">Cancelar</button>
    </div>
  </fieldset>
</div>
<?php
desconectar();
?>
<?php
include("../inc/conexion.php");
conectar();
?>
  <div> 
   <?php
   if($_REQUEST['id']>0){
    $titulo="Editar Documento";
    $id=$_REQUEST['id'];
    $sql=mysqli_query($conn,"SELECT * FROM documentos WHERE ID_DOCUMENTO=".$id);
    $row=mysqli_fetch_assoc($sql);   
  }
  else{
    $titulo="Nuevo Documento";
    $id=0;
  }
  ?>
  <h2><?php echo $titulo; ?></h2>
  <fieldset>
    <form method="post" id="formulario">
      <p class="p_form"><label>Nombre:</label>
        <input type="text" size="40" class="e_form" name="nombre" id="nombre" value="<?php if(isset($row)) { echo $row['DESCRIPCION'];}?>"/>
      </p>
      <p class="p_form"><label>Letra</label>
        <input type="text" name="letra" class="e_form" id="letra" size="5" value="<?php if(isset($row)) { echo $row['LETRA'];}?>"/>
      </p>
      <p class="p_form"><label>Accion en Stock</label>
        <select name="signo">
          <option value="+" <?php if(isset($row)) { if ($row['LETRA']=='+') { echo "selected";}}?>>+</option>
          <option value="-" <?php if(isset($row)) { if ($row['LETRA']=='-') { echo "selected";}}?>>-</option>
        </select>
      </p>
      <br>
    </form>
    <div class="modal-footer">  
      <button class="btn btn-primary" data-dismiss="modal" onclick="controlar('documentos',<?php echo $id; ?>)"  style="margin-left: 10px; border:none"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button> <button type="button" class="btn btn-default" data-dismiss="modal" onclick="limpia_div()">Cancelar</button>
    </div>
  </fieldset>
</div>
<?php
desconectar();
?>
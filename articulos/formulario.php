<?php
include("../inc/conexion.php");
conectar();
?>
  <div> 
   <?php
   if($_REQUEST['id']>0){
    $titulo="Editar Articulo";
    $id=$_REQUEST['id'];
    $sql=mysqli_query($conn,"SELECT * FROM articulos WHERE ID_ARTICULO=".$id);
    $row=mysqli_fetch_assoc($sql);   
  }
  else{
    $titulo="Nuevo Articulo";
    $id=0;
  }
  ?>
  <h2><?php echo $titulo; ?></h2>
  <fieldset>
    <form method="post" id="formulario">
      <p class="p_form"><label>Nombre:</label>
        <input type="text" size="40" class="e_form" name="nombre" id="nombre" value="<?php if(isset($row)) { echo $row['DESCRIPCION'];}?>"/>
      </p>
      <br>
      <p class="p_form"><label>Litros por Bulto:</label>
        <input type="text" size="40" class="e_form" name="litros" id="litros" value="<?php if(isset($row)) { echo $row['VALOR'];}?>"/>
      </p>
      <br>
      <p class="p_form"><label>Peso por Bulto:</label>
        <input type="text" size="40" class="e_form" name="peso" id="peso" value="<?php if(isset($row)) { echo $row['PESO'];}?>"/>
      </p>
      <br>
      <p class="p_form"><label>Cantidad por Bulto:</label>
        <input type="text" size="40" class="e_form" name="cant_x_caja" id="cant_x_caja" value="<?php if(isset($row)) { echo $row['CANTXCAJA'];}?>"/>
      </p>
      <br>                  
    </form>
    <div class="modal-footer">  
      <button class="btn btn-primary" data-dismiss="modal" onclick="controlar('articulos',<?php echo $id; ?>)"  style="margin-left: 10px; border:none"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button> <button type="button" class="btn btn-default" data-dismiss="modal" onclick="limpia_div()">Cancelar</button>
    </div>
  </fieldset>
</div>
<?php
desconectar();
?>
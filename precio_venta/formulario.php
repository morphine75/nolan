<?php
include("../inc/conexion.php");
conectar();
?>
  <div> 
   <?php
   if($_REQUEST['id']!='0'){
    $titulo="Editar Precio";
    $id=$_REQUEST['id'];
    $id=explode("-", $id);

    $sql=mysqli_query($conn,"SELECT * FROM precio_venta WHERE ID_LISTA=".$id[1]." AND ID_ARTICULO=".$id[0]);
    $row=mysqli_fetch_assoc($sql);   
  }
  else{
    $titulo="Nuevo Precio en Lista";
    $id=0;
  }
  ?>
  <h2><?php echo $titulo; ?></h2>
  <fieldset>
    <form method="post" id="formulario">
      <p class="p_form"><label>Lista de Precios:</label>
        <select name="lista_precio">
        <?php
          $sql1="SELECT * from listas_precio";
          $res1=mysqli_query($conn, $sql1);
          while ($row1=mysqli_fetch_assoc($res1)){?>
            <option value="<?php echo $row1['ID_LISTA']?>" <?php if(isset($row)) { if ($row1['ID_LISTA']==$id[1]) { echo "selected='selected'";}}?>><?php echo $row1['DESCRIPCION']?></option>
          <?php
          }
        ?>
        </select>
      </p>
      <br>
      <p class="p_form"><label>Articulo:</label>
        <select name="articulo">
        <?php
          $sql1="SELECT * from articulos WHERE ANULADO=0";
          $res1=mysqli_query($conn, $sql1);
          while ($row1=mysqli_fetch_assoc($res1)){?>
            <option value="<?php echo $row1['ID_ARTICULO']?>" <?php if(isset($row)) { if ($row1['ID_ARTICULO']==$id[0]) { echo "selected='selected'";}}?>><?php echo $row1['DESCRIPCION']?></option>
          <?php
          }
        ?>
        </select>
      </p>
      <br>

      <p class="p_form"><label>Precio:</label>
        <input type="text" size="40" class="e_form" name="precio" id="precio" value="<?php if(isset($row)) { echo $row['PRECIO'];}?>"/>
      </p>
      <br>
    </form>
    <div class="modal-footer">  
      <button class="btn btn-primary" data-dismiss="modal" onclick="controlar('precio_venta','<?php echo $id[0]."-".$id[1]; ?>')"  style="margin-left: 10px; border:none"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button> <button type="button" class="btn btn-default" data-dismiss="modal" onclick="limpia_div()">Cancelar</button>
    </div>
  </fieldset>
</div>
<?php
desconectar();
?>
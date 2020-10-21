<?php
include("../inc/conexion.php");
conectar();
?>
  <div> 
   <?php
   if($_REQUEST['id']>0){
    $titulo="Editar Almacen";
    $id=$_REQUEST['id'];
    $sql=mysqli_query($conn,"SELECT * FROM almacenes WHERE ID_ALMACEN=".$id);
    $row=mysqli_fetch_assoc($sql);   
  }
  else{
    $titulo="Nuevo Almacen";
    $id=0;
  }
  ?>
  <h2><?php echo $titulo; ?></h2>
  <fieldset>
    <form method="post" id="formulario">
      <p class="p_form"><label>Nombre:</label>
        <input type="text" size="40" class="e_form" name="nombre" id="nombre" value="<?php if(isset($row)) { echo $row['DESCRIPCION'];}?>"/>
      </p>
      <p class="p_form"><label>Deposito</label>
        <select name="deposito">
        <?php
        $sqlD="SELECT ID_DEPOSITO, DESCRIPCION FROM depositos WHERE ANULADO=0";
        $resD=mysqli_query($conn, $sqlD);
        while ($rowD=mysqli_fetch_assoc($resD)){?>
          <option value="<?php echo $rowD['ID_DEPOSITO']?>"><?php echo $rowD['DESCRIPCION']?></option>
        <?php
        }
        ?>          
        </select>
      </p>
      <br>
    </form>
    <div class="modal-footer">  
      <button class="btn btn-primary" data-dismiss="modal" onclick="controlar('almacenes',<?php echo $id; ?>)"  style="margin-left: 10px; border:none"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button> <button type="button" class="btn btn-default" data-dismiss="modal" onclick="limpia_div()">Cancelar</button>
    </div>
  </fieldset>
</div>
<?php
desconectar();
?>
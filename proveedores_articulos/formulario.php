
<?php
include("../inc/conexion.php");
conectar();
?>
  <div> 
   <?php
   if($_REQUEST['id']>0){
    $titulo="Editar Proveedores por Articulos";
    $id=$_REQUEST['id'];
    $id=explode("-", $id);
    $sql=mysqli_query($conn,"SELECT * FROM prov_x_articulo WHERE ID_PROVEEDOR=".$id[0]." AND ID_ARTICULO=".$id[1]);
    $row=mysqli_fetch_assoc($sql);   
  }
  else{
    $titulo="Proveedores por Articulos";
    $id=0;
  }
  ?>
  <h2><?php echo $titulo; ?></h2>
  <fieldset>
    <form method="post" id="formulario">
      <p class="p_form"><label><span class="obligatorio">(*)</span>Proveedor:</label>
        <?php 
        $sqlSuc="SELECT * from proveedores where ANULADO=0";
        $resSuc=mysqli_query($conn, $sqlSuc);
        ?>    
        <select name="proveedor">
          <?php
          while ($rowSuc=mysqli_fetch_assoc($resSuc)){
          ?>
          <option value="<?php if(isset($row)) { echo $row['ID_PROVEEDOR'];} else { echo $rowSuc['ID_PROVEEDOR'];}?>" <?php if(isset($row)){ if ($row['ID_PROVEEDOR']==$rowSuc['ID_PROVEEDOR']) { echo "selected='true'";}}?>><?php echo $rowSuc['NOMPROV'];?></option>
          <?php
          }
          ?>
        </select>
      </p>
      <p class="p_form"><label><span class="obligatorio">(*)</span> Articulo:</label>
          <?php 
            $sqlSuc="SELECT * from articulos where ANULADO=0";
            $resSuc=mysqli_query($conn, $sqlSuc);
            ?>    
            <select name="articulos">
              <?php
              while ($rowSuc=mysqli_fetch_assoc($resSuc)){
              ?>
              <option value="<?php if(isset($row)) { echo $row['ID_ARTICULO'];} else { echo $rowSuc['ID_ARTICULO'];}?>" <?php if(isset($row)){ if ($row['ID_ARTICULO']==$rowSuc['ID_ARTICULO']) { echo "selected='true'";}}?>><?php echo $rowSuc['DESCRIPCION']?></option>
              <?php
              }
              ?>
            </select>
      </p>
      <p class="p_form"><label><span class="obligatorio">(*)</span> Precio:</label>
        <input type="text" name="precio" id="precio" value="<?php if(isset($row)){ echo $row['PRECIO_COMPRA'];}?>">
      </p>      
    </form>
    <div class="modal-footer" style="width: 100%;" align="left">  
      <button class="btn btn-primary" onclick="controlar('proveedores_articulos','<?php echo $id[0]."-".$id[1]; ?>')"  style="margin-left: 10px; border:none"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button> <button type="button" class="btn btn-default" data-dismiss="modal" onclick="limpia_div()">Cancelar</button>
    </div>
  </fieldset>
</div>
<?php
desconectar();
?>
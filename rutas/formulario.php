
<?php
include("../inc/conexion.php");
conectar();
?>
  <div> 
   <?php
   if($_REQUEST['id']>0){
    $titulo="Editar Ruta";
    $id=$_REQUEST['id'];
    $sql=mysqli_query($conn,"SELECT * FROM rutas WHERE ID_RUTA=".$id);
    $row=mysqli_fetch_assoc($sql);   
  }
  else{
    $titulo="Nueva Ruta";
    $id=0;
  }
  ?>
  <h2><?php echo $titulo; ?></h2>
  <div id="map"></div>  
  <fieldset>
    <form method="post" id="formulario"> 
      <p class="p_form"><label><span class="obligatorio">(*)</span> Nombre:</label>
        <input type="text" size="60" class="e_form" name="nombre" id="nombre" value="<?php if(isset($row)) { echo $row['DESCRIPCION'];}?>"/>
      </p>
      <p class="p_form"><label><span class="obligatorio">(*)</span> Sucursal:</label>
          <?php 
            $sqlSuc="select * from SUCURSALES";
            $resSuc=mysqli_query($conn, $sqlSuc);
            ?>    
            <select name="sucursal">
              <?php
              while ($rowSuc=mysqli_fetch_assoc($resSuc)){
              ?>
              <option value="<?php if(isset($row)) { echo $row['ID_SUCURSAL'];} else { echo $rowSuc['ID_SUCURSAL'];}?>" <?php if(isset($row)){ if ($row['ID_SUCURSAL']==$rowSuc['ID_SUCURSAL']) { echo "selected='true'";}}?>><?php echo $rowSuc['DESCRIPCION']?></option>
              <?php
              }
              ?>
            </select>
      </p>
    </form>
    <div class="modal-footer" style="width: 100%;" align="left">  
      <button class="btn btn-primary" onclick="controlar('rutas',<?php echo $id; ?>)"  style="margin-left: 10px; border:none"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button> <button type="button" class="btn btn-default" data-dismiss="modal" onclick="limpia_div()">Cancelar</button>
    </div>
  </fieldset>
</div>
<?php
desconectar();
?>
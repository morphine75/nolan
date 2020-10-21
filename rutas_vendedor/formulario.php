
<?php
include("../inc/conexion.php");
conectar();
?>
  <div> 
   <?php
   if($_REQUEST['id']>0){
    $titulo="Editar Ruta por Vendedor";
    $id=$_REQUEST['id'];
    $ruta_vendedor=explode("-", $id);
    $sql=mysqli_query($conn,"SELECT * FROM perso_x_rut WHERE ID_RUTA=".$ruta_vendedor[0]." and ID_VENDEDOR=".$ruta_vendedor[1]);
    $row=mysqli_fetch_assoc($sql);   
  }
  else{
    $titulo="Rutas por Vendedor";
    $id=0;
  }
  ?>
  <h2><?php echo $titulo; ?></h2>
  <div id="map"></div>  
  <fieldset>
    <form method="post" id="formulario"> 
      <p class="p_form"><label><span class="obligatorio">(*)</span> Ruta:</label>
          <?php 
            $sqlSuc="select * from rutas where ID_TIPO_RUTA=1";
            $resSuc=mysqli_query($conn, $sqlSuc);
            ?>    
            <select name="ruta">
              <?php
              while ($rowSuc=mysqli_fetch_assoc($resSuc)){
              ?>
              <option value="<?php if(isset($row)) { echo $row['ID_RUTA'];} else { echo $rowSuc['ID_RUTA'];}?>" <?php if(isset($row)){ if ($row['ID_RUTA']==$rowSuc['ID_RUTA']) { echo "selected='true'";}}?>><?php echo $rowSuc['DESCRIPCION']?></option>
              <?php
              }
              ?>
            </select>
      </p>
      <p class="p_form"><label><span class="obligatorio">(*)</span> Vendedor:</label>
          <?php 
            $sqlSuc="select * from vendedores";
            $resSuc=mysqli_query($conn, $sqlSuc);
            ?>    
            <select name="vendedor">
              <?php
              while ($rowSuc=mysqli_fetch_assoc($resSuc)){
              ?>
              <option value="<?php if(isset($row)) { echo $row['ID_VENDEDOR'];} else { echo $rowSuc['ID_VENDEDOR'];}?>" <?php if(isset($row)){ if ($row['ID_VENDEDOR']==$rowSuc['ID_VENDEDOR']) { echo "selected='true'";}}?>><?php echo $rowSuc['NOM_VENDEDOR']?></option>
              <?php
              }
              ?>
            </select>
      </p>
      <hr>
      <legend align="center">Dias de Visita</legend>
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <p>
            <label for="lunes">Lunes</label><input type="checkbox" name="dias[]" id="lunes" value="1" <?php if(isset($row)) { if ($row['DIAVIS']==1){ echo "checked='true'";} }?>><hr>
            <label for="martes">Martes</label><input type="checkbox" name="dias[]" id="martes" value="2" <?php if(isset($row)) { if ($row['DIAVIS']==2){ echo "checked='true'";} }?>><hr>
            <label>Miercoles</label><input type="checkbox" name="dias[]" id="miercoles" value="3" <?php if(isset($row)) { if ($row['DIAVIS']==3){ echo "checked='true'";} }?>><hr>
            <label>Jueves</label><input type="checkbox" name="dias[]" id="jueves" value="4" <?php if(isset($row)) { if ($row['DIAVIS']==4){ echo "checked='true'";} }?>><hr>
            <label>Viernes</label><input type="checkbox" name="dias[]" id="viernes" value="5" <?php if(isset($row)) { if ($row['DIAVIS']==5){ echo "checked='true'";} }?>><hr>
            <label>Sabado</label><input type="checkbox" name="dias[]" id="sabado" value="6" <?php if(isset($row)) { if ($row['DIAVIS']==6){ echo "checked='true'";} }?>><hr>
          </p>
        </div>
      </div>
    </form>
    <div class="modal-footer" style="width: 100%;" align="left">  
      <button class="btn btn-primary" onclick="controlar('rutas_vendedor',<?php echo $id; ?>)"  style="margin-left: 10px; border:none"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button> <button type="button" class="btn btn-default" data-dismiss="modal" onclick="limpia_div()">Cancelar</button>
    </div>
  </fieldset>
</div>
<?php
desconectar();
?>
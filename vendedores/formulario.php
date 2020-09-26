
<?php
include("../inc/conexion.php");
conectar();
?>
  <div> 
   <?php
   if($_REQUEST['id']>0){
    $titulo="Editar Vendedor";
    $id=$_REQUEST['id'];
    $sql=mysqli_query($conn,"SELECT * FROM VENDEDORES WHERE id_vendedor=".$id);
    $row=mysqli_fetch_assoc($sql);   
  }
  else{
    $titulo="Nuevo Vendedor";
    $id=0;
  }
  ?>
  <h2><?php echo $titulo; ?></h2>
  <div id="map"></div>  
  <fieldset>
    <form method="post" id="formulario"> 
      <p class="p_form"><label><span class="obligatorio">(*)</span> Nombre:</label>
        <input type="text" size="60" class="e_form" name="nombre" id="nombre" value="<?php if(isset($row)) { echo $row['NOM_VENDEDOR'];}?>"/>
      </p>
      <p class="p_form"><label><span class="obligatorio">(*)</span> Sucursal:</label>
        <select name="sucursal" class="e_form" id="sucursal">
          <?php
            $sqlscl="select * from SUCURSALES";
            $resscl=mysqli_query($conn,$sqlscl);
            while ($rowscl=mysqli_fetch_assoc($resscl)){
              ?>
              <option value="<?php if(isset($row)) { echo $rowscl['ID_SUCURSAL'];} else { echo $rowscl['ID_SUCURSAL'];}?>" <?php if(isset($row)){ if ($row['ID_SUCURSAL']==$rowscl['ID_SUCURSAL']) { echo "selected='true'";}}?>><?php echo $rowscl['DESCRIPCION']?></option>
            <?php
            }
          ?>
        </select>
      </p>
      <p class="p_form"><label><span class="obligatorio">(*)</span> Cargo:</label>
        <input type="text" maxlength="2" size="60" class="e_form" name="cargo" id="cargo" value="<?php if(isset($row)) { echo $row['CARGO'];}?>" />
      </p>   
      <p>
        <label for="superior">Superior</label>
          <select name="superior" class="e_form" id="superior">
              <option value="0">No Posee</option>
          <?php
            $sqlvdr="select * from VENDEDORES where anulado=0";
            $resvdr=mysqli_query($conn,$sqlvdr);
            while ($rowvdr=mysqli_fetch_assoc($resvdr)){
              ?>
              <option value="<?php if(isset($row)) { echo $rowvdr['ID_VENDEDOR'];} else { echo $rowvdr['ID_VENDEDOR'];}?>" <?php if(isset($row)){ if ($row['VEN_ID_VENDEDOR']==$rowvdr['ID_VENDEDOR']) { echo "selected='true'";}}?>><?php echo $rowvdr['NOM_VENDEDOR']?></option>
            <?php
            }
          ?>
          </select>
      </p>
    <hr>
      <p>
        <label for="telefono">Telefono</label>
          <input type="text" name="telefono" class="e_form" id="telefono" size="20" value="<?php if(isset($row)) { echo $row['TELEFOS'];}?>"/>
      </p> 
      <p>
         <label for="domicilio">Domicilio</label>
        <input type="text" name="domicilio" class="e_form" id="domicilio" size="20" value="<?php if(isset($row)) { echo $row['DOMICILIO'];}?>"/>
      </p>
    </form>
    <div class="modal-footer" style="width: 100%;" align="left">  
      <button class="btn btn-primary" onclick="controlar('vendedores',<?php echo $id; ?>)"  style="margin-left: 10px; border:none"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button> <button type="button" class="btn btn-default" data-dismiss="modal" onclick="limpia_div()">Cancelar</button>
    </div>
  </fieldset>
</div>
<?php
desconectar();
?>
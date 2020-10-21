
<?php
include("../inc/conexion.php");
conectar();
?>
  <div> 
   <?php
   if($_REQUEST['id']>0){
    $titulo="Editar Proveedor";
    $id=$_REQUEST['id'];
    $sql=mysqli_query($conn,"SELECT * FROM proveedores WHERE id_proveedor=".$id);
    $row=mysqli_fetch_assoc($sql);   
  }
  else{
    $titulo="Nuevo Proveedor";
    $id=0;
  }
  ?>
  <h2><?php echo $titulo; ?></h2>
  <div id="map"></div>  
  <fieldset>
    <form method="post" id="formulario"> 
      <p class="p_form"><label><span class="obligatorio">(*)</span> Nombre:</label>
        <input type="text" size="60" class="e_form" name="nombre" id="nombre" value="<?php if(isset($row)) { echo $row['NOMPROV'];}?>"/>
      </p>
      <p class="p_form"><label><span class="obligatorio">(*)</span> CUIT:</label>
        <input type="text" size="20" class="e_form" name="cuit" id="cuit" value="<?php if(isset($row)) { echo $row['NUMCUIT'];}?>"/>
      </p>
      <p class="p_form"><label><span class="obligatorio">(*)</span> Direccion:</label>
        <input type="text" size="60" class="e_form" name="direccion" id="direccion" value="<?php if(isset($row)) { echo $row['DOMIPROV'];}?>"/>
      </p>
      <p>
        <label for="telefono">Telefono</label>
          <input type="text" name="telefono" class="e_form" id="telefono" size="20" value="<?php if(isset($row)) { echo $row['TELEFONO'];}?>"/>
      </p> 
      <hr>
      <p>
        <label for="tipo_iva">Tipo de IVA</label>
          <select name="tipo_iva" class="e_form" id="tipo_iva">
          <?php
            $sqlIVA="select * from TIPOS_IVA";
            $resIVA=mysqli_query($conn,$sqlIVA);
            while ($rowIVA=mysqli_fetch_assoc($resIVA)){
              ?>
              <option value="<?php if(isset($row)) { echo $row['ID_TIPO_IVA'];} else { echo $rowIVA['ID_TIPO_IVA'];}?>" <?php if(isset($row)){ if ($row['ID_TIPO_IVA']==$rowIVA['ID_TIPO_IVA']) { echo "selected='true'";}}?>><?php echo $rowIVA['DESCRIPCION']?></option>
            <?php
            }
          ?>
          </select>
      </p>
      <p>
         <label for="telefono">Dias</label>
        <input type="text" name="dias" class="e_form" id="dias" size="20" value="<?php if(isset($row)) { echo $row['DIAS'];}?>"/>
      </p>
      <p>
        <label for="telefono">Ingresos Brutos</label>
        <input type="text" name="numbru" class="e_form" id="numbru" size="20" value="<?php if(isset($row)) { echo $row['NUMBRU'];}?>"/>
      </p>
    </form>
    <div class="modal-footer" style="width: 100%;" align="left">  
      <button class="btn btn-primary" onclick="controlar('proveedores',<?php echo $id; ?>)"  style="margin-left: 10px; border:none"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button> <button type="button" class="btn btn-default" data-dismiss="modal" onclick="limpia_div()">Cancelar</button>
    </div>
  </fieldset>
</div>
<?php
desconectar();
?>

<?php
include("../inc/conexion.php");
conectar();
?>
  <div> 
   <?php
   if($_REQUEST['id']>0){
    $titulo="Editar Ruta";
    $id=$_REQUEST['id'];
    $sql=mysqli_query($conn,"SELECT * FROM RUTAS WHERE ID_RUTA=".$id);
    $row=mysqli_fetch_assoc($sql);   
  }
  else{
    $titulo="Rutas por Cliente";
    $id=0;
  }
  ?>
  <h2><?php echo $titulo; ?></h2>
  <fieldset>
    <form method="post" id="formulario">
      <p class="p_form"><label><span class="obligatorio">(*)</span>Cliente:</label>
        <?php 
        $sqlSuc="select ID_CLIENTE, NOM_CLIENTE, FANTASIA, CALLE, ALTURA from CLIENTES where ANULADO=0";
        $resSuc=mysqli_query($conn, $sqlSuc);
        ?>    
        <select name="cliente">
          <?php
          while ($rowSuc=mysqli_fetch_assoc($resSuc)){
          ?>
          <option value="<?php if(isset($row)) { echo $row['ID_CLIENTE'];} else { echo $rowSuc['ID_CLIENTE'];}?>" <?php if(isset($row)){ if ($row['ID_CLIENTE']==$rowSuc['ID_CLIENTE']) { echo "selected='true'";}}?>><?php echo $rowSuc['NOM_CLIENTE']."-".$rowSuc['FANTASIA']."-".$rowSuc['CALLE']."-".$rowSuc['ALTURA']?></option>
          <?php
          }
          ?>
        </select>
      </p>
      <p class="p_form"><label><span class="obligatorio">(*)</span> Ruta de Venta:</label>
          <?php 
            $sqlSuc="select * from RUTAS where ID_TIPO_RUTA=1";
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
      <p class="p_form"><label><span class="obligatorio">(*)</span> Ruta de Distribucion:</label>
          <?php 
            $sqlSuc="select * from RUTAS where ID_TIPO_RUTA=2";
            $resSuc=mysqli_query($conn, $sqlSuc);
            ?>    
            <select name="ruta_dis">
              <?php
              while ($rowSuc=mysqli_fetch_assoc($resSuc)){
              ?>
              <option value="<?php if(isset($row)) { echo $row['ID_RUTA'];} else { echo $rowSuc['ID_RUTA'];}?>" <?php if(isset($row)){ if ($row['ID_RUTA']==$rowSuc['ID_RUTA']) { echo "selected='true'";}}?>><?php echo $rowSuc['DESCRIPCION']?></option>
              <?php
              }
              ?>
            </select>
      </p>
    </form>
    <div class="modal-footer" style="width: 100%;" align="left">  
      <button class="btn btn-primary" onclick="controlar('rutas_cliente',<?php echo $id; ?>)"  style="margin-left: 10px; border:none"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button> <button type="button" class="btn btn-default" data-dismiss="modal" onclick="limpia_div()">Cancelar</button>
    </div>
  </fieldset>
</div>
<?php
desconectar();
?>
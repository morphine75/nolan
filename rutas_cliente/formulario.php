
<?php
include("../inc/conexion.php");
conectar();
?>
  <div> 
   <?php
   if($_REQUEST['id']>0){
    $titulo="Editar Ruta";
    $id=$_REQUEST['id'];
    $ruta_cliente=explode("-", $id);
    if ($ruta_cliente[1]!=''){
      $sql="SELECT * FROM cli_x_ruta WHERE ID_RUTA=".$ruta_cliente[0]." AND RUTA=".$ruta_cliente[1]." AND ID_CLIENTE=".$ruta_cliente[2];
      $sqlSuc="select ID_CLIENTE, NOM_CLIENTE, FANTASIA, CALLE, ALTURA from clientes where ANULADO=0";
    }
    else{
      $sql="SELECT * FROM cli_x_ruta WHERE ID_RUTA=".$ruta_cliente[0]." AND ID_CLIENTE=".$ruta_cliente[2];     
    }
    $res=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($res); 
    $sqlSuc="select ID_CLIENTE, NOM_CLIENTE, FANTASIA, CALLE, ALTURA from clientes where ANULADO=0";
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
            $sqlSuc="select * from rutas where ID_TIPO_RUTA=1";
            $resSuc=mysqli_query($conn, $sqlSuc);
            ?>    
            <select name="ruta">
              <?php
              while ($rowSuc=mysqli_fetch_assoc($resSuc)){
              ?>
              <option value="<?php echo $rowSuc['ID_RUTA'];?>" <?php if(isset($row)){ if ($row['ID_RUTA']==$rowSuc['ID_RUTA']) { echo "selected='true'";}}?>><?php echo $rowSuc['DESCRIPCION']?></option>
              <?php
              }
              ?>
            </select>
      </p>
      <p class="p_form"><label><span class="obligatorio">(*)</span> Ruta de Distribucion:</label>
          <?php 
            $sqlSuc="select * from rutas where ID_TIPO_RUTA=2";
            $resSuc=mysqli_query($conn, $sqlSuc);
            ?>    
            <select name="ruta_dis">
              <?php
              while ($rowSuc=mysqli_fetch_assoc($resSuc)){
              ?>
                <option value="<?php 
                if(isset($row)) {
                  if ($row['RUTA']!=''){
                    echo $row['RUTA'];
                  }
                  else{
                    echo $rowSuc['ID_RUTA'];
                  }
                } 
                else { 
                  echo $rowSuc['ID_RUTA'];
                }?>" <?php 
                if(isset($row)){ 
                  if ($row['RUTA']==$rowSuc['ID_RUTA']) { 
                    echo "selected='true'";
                  }
                }?>><?php echo $rowSuc['DESCRIPCION']?></option>
                <?php
              }
              ?>
            </select>
      </p>
    </form>
    <div class="modal-footer" style="width: 100%;" align="left">  
      <button class="btn btn-primary" onclick="controlar('rutas_cliente','<?php echo $id; ?>')"  style="margin-left: 10px; border:none"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button> <button type="button" class="btn btn-default" data-dismiss="modal" onclick="limpia_div()">Cancelar</button>
    </div>
  </fieldset>
</div>
<?php
desconectar();
?>
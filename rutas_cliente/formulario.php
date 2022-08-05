
<?php
include("../inc/conexion.php");
conectar();
?>
  <div> 
  <?php
   if($_REQUEST['id']>0){
    $titulo="Editar Ruta";
    $id=$_REQUEST['id'];
      $sql=mysqli_query($conn,"SELECT p.*, r.DESCRIPCION, v.ID_CLIENTE, v.NOM_CLIENTE, v.FANTASIA from cli_x_ruta p, clientes v, rutas r WHERE r.ID_RUTA=p.ID_RUTA and v.ID_CLIENTE=p.ID_CLIENTE and p.ID_CLIENTE=".$id);
      $row=mysqli_fetch_assoc($sql);   
    }
    else{
      $titulo="Nueva Ruta por Cliente";
      $id=0;
    }
    ?>
  <h2><?php echo $titulo;?></h2>
  <fieldset>
    <form method="post" id="formulario">
      <p class="p_form"><label><span class="obligatorio">(*)</span>Cliente:</label>
        <select name="cliente">
          <?php
           $sqlclientes="select * from clientes";
            $resclientes=mysqli_query($conn,$sqlclientes);
            while ($rowclientes=mysqli_fetch_assoc($resclientes)){
              ?>
          <option value="<?php if(isset($row)) { echo $row['ID_CLIENTE'];} else { echo $rowclientes['ID_CLIENTE'];}?>" <?php if(isset($row)){ if ($row['ID_CLIENTE']==$rowclientes['ID_CLIENTE']) { echo "selected='true'";}}?>><?php echo $rowclientes['NOM_CLIENTE']." - ".$rowclientes['FANTASIA']?></option>
          <?php
          }
          ?>
        </select>
      </p><br>
      <p class="p_form"><label><span class="obligatorio">(*)</span> Ruta de Venta:</label>
            <select name="rutaven">
              <?php
                $sqlventas="SELECT * from rutas where ANULADO=0";
                $resventas=mysqli_query($conn, $sqlventas);
              while ($rowventas=mysqli_fetch_assoc($resventas)){
              ?>
              <option value="<?php if(isset($row)) {echo $rowventas['ID_RUTA'];} else { echo $rowventas['ID_RUTA'];}?>" <?php if(isset($row)){ if ($row['ID_RUTA']==$rowventas['ID_RUTA']) { echo "selected='true'";}}?>><?php echo $rowventas['DESCRIPCION']?></option>
              <?php
              }
              ?>
            </select>
      </p><br>
    </form>
    <div class="modal-footer" style="width: 100%;" align="left">  
      <button class="btn btn-primary" onclick="controlar('rutas_cliente','<?php echo $id; ?>')"  style="margin-left: 10px; border:none"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button> <button type="button" class="btn btn-default" data-dismiss="modal" onclick="limpia_div()">Cancelar</button>
    </div>
  </fieldset>
</div>
<?php
desconectar();
?>
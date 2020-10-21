<?php
include("../inc/conexion.php");
conectar();
?>
  <div> 
   <?php
   if($_REQUEST['id']>0){
    $titulo="Editar Stock";
    $id=$_REQUEST['id'];
    $sql=mysqli_query($conn,"select * from articulos a, stock_almacen s where s.ID_ARTICULO=a.ID_ARTICULO and s.ID_ARTICULO=".$id);
    $row=mysqli_fetch_assoc($sql);   
  }
  else{
    $titulo="Nuevo Registro de Stock";
    $id=0;
  }
  ?>
  <h2><?php echo $titulo; ?></h2>
  <fieldset>
    <form method="post" id="formulario">
      <p class="p_form"><label>Articulo:</label>
        <?php
        $sqlA="select ID_ARTICULO, DESCRIPCION from articulos";
        $resA=mysqli_query($conn, $sqlA);
        ?>
        <select name="articulo">
        <?php
        while ($rowA=mysqli_fetch_assoc($resA)){?>
          <option value="<?php echo $rowA['ID_ARTICULO']?>" <?php if(isset($row)) { if ($row['ID_ARTICULO']==$rowA['ID_ARTICULO']){ echo "selected"; }}?>><?php echo $rowA['DESCRIPCION'] ?></option>
        <?php
        }
        ?>
        </select>
      </p>
      <br>
      <p class="p_form"><label>Bultos Fisicos:</label>
        <input type="text" size="40" class="e_form" name="b_fisica" id="b_fisica" value="<?php if(isset($row)) { echo floor($row['CANTIDAD_FISICA']/$row['CANTXCAJA']);}?>"/>
      </p>
      <br>
      <p class="p_form"><label>Unidades Fisicos:</label>
        <input type="text" size="40" class="e_form" name="u_fisica" id="u_fisica" value="<?php if(isset($row)) { echo $row['CANTIDAD_FISICA']%$row['CANTXCAJA'];}?>"/>
      </p>      
      <hr>
      <p class="p_form"><label>Bultos Disponibles:</label>
        <input type="text" size="40" class="e_form" name="b_disponible" id="b_disponible" value="<?php if(isset($row)) { echo floor($row['CANTIDAD_DISPONIBLE']/$row['CANTXCAJA']);}?>"/>
      </p>
      <br>
      <p class="p_form"><label>Unidades Disponibles:</label>
        <input type="text" size="40" class="e_form" name="u_disponible" id="u_disponible" value="<?php if(isset($row)) { echo $row['CANTIDAD_DISPONIBLE']%$row['CANTXCAJA'];}?>"/>
      </p>
      <br>                  
    </form>
    <div class="modal-footer">  
      <button class="btn btn-primary" data-dismiss="modal" onclick="controlar('stock',<?php echo $id; ?>)"  style="margin-left: 10px; border:none"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button> <button type="button" class="btn btn-default" data-dismiss="modal" onclick="limpia_div()">Cancelar</button>
    </div>
  </fieldset>
</div>
<?php
desconectar();
?>
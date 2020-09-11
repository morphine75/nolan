<style>
  /* Always set the map height explicitly to define the size of the div
   * element that contains the map. */
  #map {
    float: right;
    height: 40%;
    width: 30%;
    top:-15px;
  }
</style>
<?php
include("../inc/conexion.php");
conectar();
?>
  <div> 
   <?php
   if($_REQUEST['id']>0){
    $titulo="Editar Cliente";
    $id=$_REQUEST['id'];
    $sql=mysqli_query($conn,"SELECT * FROM clientes WHERE id_cliente=".$id);
    $row=mysqli_fetch_assoc($sql);   
  }
  else{
    $titulo="Nuevo Cliente";
    $id=0;
  }
  ?>
  <h2><?php echo $titulo; ?></h2>
  <div id="map"></div>  
  <fieldset>
    <form method="post" id="formulario">
      <p>
        <label for="sucursal">Sucursal</label>
          <select name="sucursal" class="e_form" id="sucursal">
          <?php
            $sqlSucursales="select * from SUCURSALES";
            $ressucursales=mysqli_query($conn,$sqlSucursales);
            while ($rowSucursales=mysqli_fetch_assoc($ressucursales)){
              ?>
              <option value="<?php if(isset($row)) { echo $row['ID_SUCURSAL'];} else { echo $rowSucursales['ID_SUCURSAL'];}?>" <?php if(isset($row)){ if ($row['ID_SUCURSAL']==$rowSucursales['ID_SUCURSAL']) { echo "selected='true'";}}?>><?php echo $rowSucursales['DESCRIPCION']?></option>
            <?php
            }
          ?>
          </select>
      </p>      
      <p class="p_form"><label><span class="obligatorio">(*)</span> Nombre:</label>
        <input type="text" size="60" class="e_form" name="nombre" id="nombre" value="<?php if(isset($row)) { echo $row['NOM_CLIENTE'];}?>"/>
      </p>
      <p class="p_form"><label>Fantasia:</label>
        <input type="text" size="60" class="e_form" name="fantasia" id="fantasia" value="<?php if(isset($row)) { echo $row['FANTASIA'];}?>"/>
      </p> 
      <p class="p_form"><label><span class="obligatorio">(*)</span> CUIT:</label>
        <input type="text" size="20" class="e_form" name="cuit" id="cuit" value="<?php if(isset($row)) { echo $row['CUIT'];}?>"/>
      </p>           
      <p class="p_form"><label for="calle"><span class="obligatorio">(*)</span> Calle</label>
        <input type="text" name="calle" class="e_form" id="calle" size="40" value="<?php if(isset($row)) { echo $row['CALLE'];}?>"/> Interseccion <input type="checkbox" id="interseccion" onclick="sin_altura()">
      </p>
      <p>
        <label for="altura"><span class="obligatorio">(*)</span> Altura</label>
          <input type="text" name="altura" class="e_form" id="altura" size="10" value="<?php if(isset($row)) { echo $row['ALTURA'];}?>"/>
        <a href="#" onclick="buscar_direccion()"><img src="arrow.png" title="Geolocalizar" style="width: 25px"></a>               
      </p>
      <p>
        <label for="contacto">Contacto</label>
          <input type="text" name="contacto" class="e_form" id="contacto" size="40" value="<?php if(isset($row)) { echo $row['CONTACTO'];}?>"/>
      </p>   
      <p>
        <label for="telefono">Telefono</label>
          <input type="text" name="telefono" class="e_form" id="telefono" size="20" value="<?php if(isset($row)) { echo $row['CONTACTO'];}?>"/>
      </p>       
      <p>
        <label for="email">E-Mail</label>
          <input type="mail" name="email" class="e_form" id="email" size="40" value="<?php if(isset($row)) { echo $row['EMAIL'];}?>"/>
      </p>   
      <hr>
      <p>
        <label for="canal">Canal</label>
          <select name="canal" class="e_form" id="canal">
          <?php
            $sqlCanal="select * from CANALES";
            $resCanal=mysqli_query($conn,$sqlCanal);
            while ($rowCanal=mysqli_fetch_assoc($resCanal)){
              ?>
              <option value="<?php if(isset($row)) { echo $row['ID_CANAL'];} else { echo $rowCanal['ID_CANAL'];}?>" <?php if(isset($row)){ if ($row['ID_CANAL']==$rowCanal['ID_CANAL']) { echo "selected='true'";}}?>><?php echo $rowCanal['DESCRIPCION']?></option>
            <?php
            }
          ?>
          </select>
      </p> 
      <p>
        <label for="lista_precio">Lista de Precio</label>
          <select name="lista_precio" class="e_form" id="lista_precio">
          <?php
            $sqlLP="select * from LISTAS_PRECIO";
            $resLP=mysqli_query($conn,$sqlLP);
            while ($rowLP=mysqli_fetch_assoc($resLP)){
              ?>
              <option value="<?php if(isset($row)) { echo $row['ID_LISTA'];} else { echo $rowLP['ID_LISTA'];}?>" <?php if(isset($row)){ if ($row['ID_LISTA']==$rowLP['ID_LISTA']) { echo "selected='true'";}}?>><?php echo $rowLP['DESCRIPCION']?></option>
            <?php
            }
          ?>
          </select>
      </p>
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
        <label for="tipo_pago">Pago</label>
          <select name="tipo_pago" class="e_form" id="tipo_pago">
          <?php
            $sqlPago="select * from TIPOS_PAGO";
            $resPago=mysqli_query($conn,$sqlPago);
            while ($rowPago=mysqli_fetch_assoc($resPago)){
              ?>
              <option value="<?php if(isset($row)) { echo $row['ID_TIPO_PAGO'];} else { echo $rowPago['ID_TIPO_PAGO'];}?>" <?php if(isset($row)){ if ($row['ID_TIPO_PAGO']==$rowPago['ID_TIPO_PAGO']) { echo "selected='true'";}}?>><?php echo $rowPago['DESCRIPCION']?></option>
            <?php
            }
          ?>
          </select>
      </p>
      <p>
        <label for="observaciones">Observaciones</label>
        <textarea name="observaciones" id="observaciones" cols="100"></textarea>
      </p>                  
      <br>
      <input type="hidden" name="lat" id="lat">
      <input type="hidden" name="long" id="long">
    </form>
    <div class="modal-footer" style="width: 100%;" align="left">  
      <button class="btn btn-primary" onclick="controlar('clientes',<?php echo $id; ?>)"  style="margin-left: 10px; border:none"><span class="glyphicon glyphicon-floppy-disk"></span> Guardar</button> <button type="button" class="btn btn-default" data-dismiss="modal" onclick="limpia_div()">Cancelar</button>
    </div>
  </fieldset>
</div>
<?php
desconectar();
?>
<script>

  var map;

  function buscar_direccion(){
    var calle=$('#calle').val();
    var altura=$('#altura').val();
    $.getJSON('https://maps.googleapis.com/maps/api/geocode/json?address='+altura+'+'+calle+',+Posadas&key=AIzaSyBiBxXkVyKaLdUmNVzyC9AeyAJNW7eGcLw', function(data) {
        // JSON result in `data` variable
        var latitud;
        var longitud;
        for(i=0; i< data.results.length; i++)
        {
          latitud=(data.results[i].geometry.location.lat);
          longitud=(data.results[i].geometry.location.lng);
        }
        initMap(latitud, longitud);
    });
  }
  // Note: This example requires that you consent to location sharing when
  // prompted by your browser. If you see the error "The Geolocation service
  // failed.", it means you probably did not give permission for the browser to
  // locate you.
  $( document ).ready(function() {
    mostrarMapa();
  });

  function mostrarMapa(){
    map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: -27.373786, lng: -55.901824},
      zoom: 15
    });
  }

  function initMap(latitud, longitud) {

    var pos=new google.maps.LatLng({lat: latitud, lng: longitud}); 

    var marker = new google.maps.Marker({
        position: pos,
        draggable: true,
        animation: google.maps.Animation.DROP,
        map: map,
        icon:'arrow_red.png'          
    });            

    map.setCenter(pos);
    markerCoords(marker);
    $('#lat').val(latitud);
    $('#long').val(longitud);
  }


  function markerCoords(markerobject){
  google.maps.event.addListener(markerobject, 'dragend', function(evt){
  $('#lat').val(evt.latLng.lat());
        $('#long').val(evt.latLng.lng());
  });
}

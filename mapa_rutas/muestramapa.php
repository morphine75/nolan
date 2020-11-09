<html>
    <head> 	   	
    <style>
        #map_canvas { 
			width:100%; 
			height: 100%; 
			z-index: 0; 
		}
		
		.letra_blanca {
			background-color: #000033; 
			color: #FFFFFF; 
			font-size: 12px; 
			font-family: Arial, sans-serif;
		}
		
		#formContent{
			top:-300px;
			position: relative;
			left: 50px;
			width: 300px;
		}	
		
    </style>
	<script src="mapa_rutas/markerwithlabel.js"></script>	
    <script type='text/javascript'>
	
 
    //This javascript will load when the page loads.
    jQuery(document).ready( function($){
 
 			var longi=document.getElementById('longitud').value;
            //Initialize the Google Maps
            var geocoder;
            var map;
            var markersArray = [];
            var infos = [];
 
            geocoder = new google.maps.Geocoder();
            var myOptions = {
                  zoom: 12,
                  mapTypeId: google.maps.MapTypeId.ROADMAP
                }
            //Load the Map into the map_canvas div
            var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
            //Initialize a variable that the auto-size the map to whatever you are plotting
            var bounds = new google.maps.LatLngBounds();
            //Initialize the encoded string       
            var encodedString="";
            //Initialize the array that will hold the contents of the split string
            var stringArray = [];
            //Get the value of the encoded string from the hidden input
            encodedString = document.getElementById("encodedString").value;
			//alert (encodedString);
			//$('#encodedtexto').html(encodedString);

            //Split the encoded string into an array the separates each location
            stringArray = encodedString.split("****");
						

				var condicion=$('#condicion').val();
				if ((condicion=='rdis')||(condicion=='rventa')||(condicion=='fmovi'))
				{
					var x=0;
					var z=0;
					var i;
					var acumulador=0;
					var y=0;
					var cantidad=0;
					for (i = 1; i <= longi; i = i + 1)
					{
						if ( $("#canti_clientes"+i).length ) 
						{
							cantidad=document.getElementById('canti_clientes'+i).value;	
							y = y + parseInt(cantidad);
							if (y>stringArray.length)
							{
								y=stringArray.length;
							}
							//alert ('X '+x);	
							//alert ('Y '+y);	
							//alert ('Longitud Cadena: '+stringArray.length);
								//Create a new marker and info window			
								for (x = z; x < y; x = x + 1)
								{
									//var iconoMarca = new google.maps.icon(G_DEFAULT_ICON);
									var addressDetails = [];
									var marker;
									//Separate each field
									addressDetails = stringArray[x].split("&&&");
									if (typeof stringArray[x] != 'undefined') {									
										//Load the lat, long data
										var lat = new google.maps.LatLng(addressDetails[1], addressDetails[2]);						
										//Imagen del marcador
										var image = "mapa_rutas/punto"+i+".png";								
										marker = new google.maps.Marker({
											map: map, 
											position: lat,
											content: addressDetails[0]+" - Indice ",/*Content is what will show up in the info window*/
											icon: image
										});
										//Pushing the markers into an array so that it's easier to manage them
										markersArray.push(marker);
										google.maps.event.addListener( marker, 'click', function () {
											//closeInfos();
											var info = new google.maps.InfoWindow({content: this.content});
											//On click the map will load the info window
											info.open(map,this);
											infos[0]=info;
										});
									   //Extends the boundaries of the map to include this new location
									   bounds.extend(lat);
									}
								}	
							z = z + parseInt(cantidad);
						}
					}
				}

            //Takes all the lat, longs in the bounds variable and autosizes the map
            map.fitBounds(bounds);
 
           //Manages the info windows
           function closeInfos(){
           if(infos.length > 0){
              infos[0].set("marker",null);
              infos[0].close();
              infos.length = 0;
			}
           }
    });
	
	// Popup window code
	function newPopup(url) {
		var direccion='#'+url;
	   sOptions = 'status=yes,menubar=yes,scrollbars=yes,resizable=yes,toolbar=yes';
	   sOptions = sOptions + ',width=' + (screen.availWidth - 10).toString();
	   sOptions = sOptions + ',height=' + (screen.availHeight - 122).toString();
	   sOptions = sOptions + ',screenX=0,screenY=0,left=0,top=0';	
		popupWindow = window.open(direccion,'popUpWindowVD',sOptions)
		popupWindow.resizeTo( screen.availWidth, screen.availHeight );
	}
	
    </script>
<style type="text/css" media="print">
div.page 
{
	writing-mode: tb-rl;
	height: 80%;
	margin: 10% 0%;
}
</style> 
    </head>
    <body>
    <div id='input'>
 
        <?php
		include("../inc/conexion.php");
		conectar();
         //Initialize your first couple variables
        $encodedString = ""; //This is the string that will hold all your location data
        $x = 0; //This is a trigger to keep the string tidy
		$cantidad_puntos=0;
 
        //Now we do a simple query to the database
		$condicion="rventa";
		?>		
		<input type="hidden" id="condicion" value="<?php echo $condicion?>">
		<?php
		$clientes="";
		$i=0;
	
		if ($condicion=="rventa")
		{
			$cantidad_puntos=0;
			
			$sqlPuntos="SELECT ID_RUTA from rutas where ID_TIPO_RUTA=1";
			$resPuntos=mysqli_query($conn, $sqlPuntos);
			while ($rowPuntos=mysqli_fetch_assoc($resPuntos)){
				$cantidad_puntos++;
			}

			$sqlclientes="select c.ID_CLIENTE, c.NOM_CLIENTE, c.XCOORD, c.YCOORD, c.CALLE, c.ALTURA, cli.ID_RUTA from clientes c, cli_x_ruta cli where c.ID_CLIENTE=cli.ID_CLIENTE order by ID_RUTA";
			
			//echo $sqlclientes;
			
			$sqlCuenta="select count(c.ID_CLIENTE) as CUENTA, cli.ID_RUTA, r.DESCRIPCION from clientes c, cli_x_ruta cli, rutas r where c.ID_CLIENTE=cli.ID_CLIENTE and cli.ID_RUTA=r.ID_RUTA and ID_TIPO_RUTA=1 group by cli.ID_RUTA";
			
			$resCuenta=mysqli_query($conn,$sqlCuenta);
			$j=1;
			while ($rowCuenta=mysqli_fetch_assoc($resCuenta))
			{?>
				<input type="hidden" id="canti_clientes<?php echo $j?>" value="<?php echo $rowCuenta['CUENTA']?>">
			<?php
				$vecCuenta[$j]['ruta']=$rowCuenta['ID_RUTA'];
				$vecCuenta[$j]['d_ruta']=$rowCuenta['DESCRIPCION'];				
				$vecCuenta[$j]['cuenta']=$rowCuenta['CUENTA'];
				$j++;
			}
			
			$result=mysqli_query($conn,$sqlclientes);
			
			//Multiple rows are returned
			while ($row = mysqli_fetch_assoc($result))
			{
				//This is to keep an empty first or last line from forming, when the string is split
				if ( $x == 0 )
				{
					 $separator = "";
				}
				else
				{
					 //Each row in the database is separated in the string by four *'s
					 $separator = "****";
				}
				$cadena="<img onclick='newPopup(".$row['ID_CLIENTE'].")' style='cursor:pointer' src='punto1.png' ";
				//Saving to the String, each variable is separated by three &'s
				
				$calle=str_replace('"', '', $row['CALLE']);

				$encodedString = $encodedString.$separator."<p class='content'>"."RUTA: ".$row['ID_RUTA']."<br>".$row['ID_CLIENTE']."-".$row['NOM_CLIENTE']."<br>".$calle." ".$row['ALTURA']."- ".$cadena."></p>&&&".$row['YCOORD']."&&&".$row['XCOORD'];
				?>
				<input type="hidden" id="cliente<?php echo $x?>" value="<?php echo $row['ID_CLIENTE']?>">
 				<input type="hidden" id="longitud" value="<?php echo $cantidad_puntos?>">					
				<?php
				$x = $x + 1;
			}			
		}
		desconectar();      	
        ?>
        <input type="hidden" id="encodedString" name="encodedString" value="<?php echo $encodedString; ?>" />
    </div>
	<div id="map_canvas"></div>	
	<div id="encodedtexto"></div>
    <page orientation="portrait">
		<?php
		if (($condicion=='rdis')||($condicion=='rventa'))
		{
		?>
			<div id="contiene_tabla">
				<table class="table" style="width:50%">
					<tr class="letra_blanca">
						<td colspan="3" align="center">RUTA</td>
						<td align="center">CANTIDAD DE CLIENTES</td>
					</tr>
					<?php
					for ($i=1;$i<=count($vecCuenta);$i++)
					{?>
							<tr>
								<td><img src="mapa_rutas/punto<?php echo $i?>.png"></td>
								<td><?php echo $vecCuenta[$i]['ruta']?></td>
								<td><?php echo $vecCuenta[$i]['d_ruta']?></td>								
								<td align="center"><?php echo $vecCuenta[$i]['cuenta']?></td>
							</tr>
					<?php
					}
					?>
				</table>
			</div>
		<?php
		}
		?>		
    </page>
    </body>
</html>
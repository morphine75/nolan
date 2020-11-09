<html>
<?php
include("../inc/conexion.php");
conectar();

$sqlMoviles="select * from moviles where anulado=0";
$resMoviles=mysqli_query($conn, $sqlMoviles);
$vecMoviles=array();
$i=0;
while ($rowMoviles=mysqli_fetch_assoc($resMoviles)){
	$vecMoviles[$i]['ID_MOVIL']=$rowMoviles['ID_MOVIL'];
	$vecMoviles[$i]['NOM_MOVIL']=$rowMoviles['NOM_MOVIL'];
	$i++;
}

?>
<head>

<style>	
	#formContent{
        width:15%;
        top:8%;
        left:21%;
        bottom:0px;
        position:fixed;
		opacity: 1;
		background-color: #5c6e9f; 
	}	
</style>
<script src="distribucion/markerwithlabel.js"></script>	
<script type="text/javascript">
	var poly, map;
	var infoWindow;
	var markers = [];
	var markersArray = [];
	var marcadores = [];
	var clientes_guardar = [];
	var path = new google.maps.MVCArray;

	var drawingManager = new google.maps.drawing.DrawingManager({
		drawingMode: google.maps.drawing.OverlayType.POLYGON,
		drawingControl: true,
		drawingControlOptions: {
		  position: google.maps.ControlPosition.TOP_CENTER,
		  drawingModes: [
			google.maps.drawing.OverlayType.POLYGON
		  ]
		},	
		polygonOptions: { editable: true }
	});

	var selectedShape;

    function quitar_poligono(){
   		if (selectedShape) {
		    var image_fuera = "distribucion/punto3.png";
			for (var i = 0; i < markersArray.length; i++) {
		  		if (google.maps.geometry.poly.containsLocation(markersArray[i].getPosition(), selectedShape)){
		  			markersArray[i].setIcon(image_fuera);
		  		}
		  	}
      		selectedShape.setMap(null);
    	}
    }

    function cargar_puntos(){
		<?php
		//Connect to the PROGRESS database that is holding your data, replace the x's with your data

		$sqlClientes="SELECT c.ID_CLIENTE, c.YCOORD, c.XCOORD, c.NOM_CLIENTE, sum(p.total) as TOTAL, sum(a.peso*d.cant) as PESO, floor(sum(cant/cantxcaja)) as BULTOS, cant mod cantxcaja as UNIDADES FROM pedidos p, clientes c, detalle_pedido d, articulos a WHERE c.ID_CLIENTE=p.ID_CLIENTE and a.ID_ARTICULO=d.ID_ARTICULO and d.ID_PEDIDO=p.ID_PEDIDO and p.DISTRIBUIDO=0 group by c.ID_CLIENTE";

		$resClientes=mysqli_query($conn, $sqlClientes);

		$vecClientes=array();
		$i=0;
		while ($row=mysqli_fetch_assoc($resClientes))	
		{
		?>
		  	var image = "distribucion/punto3.png";
			var lat = new google.maps.LatLng(<?php echo $row['YCOORD']?>, <?php echo $row['XCOORD']?>);					
			//Create a new marker and info window
			var markerCliente = new MarkerWithLabel({
				map: map, 
				position: lat,
				icon: image,
				content:'<?php echo $row['ID_CLIENTE']?> - <?php echo $row['NOM_CLIENTE']?>',
				id: <?php echo $row['ID_CLIENTE']?>,
				peso:<?php echo $row['PESO']?>,
				total:<?php echo $row['TOTAL']?>,
				bultos:<?php echo $row['BULTOS']?>,				
				unidades:<?php echo $row['UNIDADES']?>
			});
			//Pushing the markers into an array so that it's easier to manage them
			markersArray.push(markerCliente);
			google.maps.event.addListener( markerCliente, 'click', function () {
					//closeInfos();
					var info = new google.maps.InfoWindow({content: this.content});
					//On click the map will load the info window
					info.open(map,this);
					infos[0]=info;
				});				
		<?php
		}
		?>    	
    }

	$( document ).ready(function() {
		var uluru = new google.maps.LatLng(-27.377519, -55.917612);

		map = new google.maps.Map(document.getElementById("map"), {
		  zoom: 14,
		  center: uluru,
		  mapTypeId: google.maps.MapTypeId.ROADMAP 
		});

		infWindow = new google.maps.InfoWindow();
		drawingManager.setMap(map);	


		cargar_puntos();


		function overlayClickListener(overlay) {
		    google.maps.event.addListener(overlay, "mouseup", function(event){
		        //alert(overlay.getPath().getArray());
				var markerCnt = 0;
				marcadores=[];
				var peso = 0;
				var total = 0;
				var bultos = 0;
				var unidades = 0;			
				var image = "distribucion/punto5.png";
				var image_fuera = "distribucion/punto3.png";
		    	for (var i = 0; i < markersArray.length; i++) {
		      		if (google.maps.geometry.poly.containsLocation(markersArray[i].getPosition(), overlay)) {
		      			markersArray[i].setIcon(image);
		        		marcadores[markerCnt]=markersArray[i].content;
		        		peso = peso + markersArray[i].peso;	        		
		        		total = parseFloat(total) + parseFloat(markersArray[i].total);	
		        		bultos = bultos + markersArray[i].bultos;	
		        		unidades = unidades + markersArray[i].unidades;	
		        		markerCnt++;	        		
		      		}
		      		else{
		      			markersArray[i].setIcon(image_fuera);
		      		}
		      	}
		      	$.confirm({
				    title: 'Confirmar Acción',
				    content: '<b>Clientes Marcados: '+markerCnt+'<hr>Peso de la carga:'+peso+'<hr> Total $ de la Carga:'+parseFloat(total).toFixed(2)+'<hr> Bultos: '+bultos+' Unidades: '+unidades+' </b><hr>Desea guardar?<br><table class="table"><tr><td>Fletero</td><td><select id="fletero_mueve"><?php for ($i=0;$i<count($vecMoviles);$i++){ ?><option value="<?php echo $vecMoviles[$i]['ID_MOVIL'];?>"><?php echo $vecMoviles[$i]['NOM_MOVIL']?></option><?php } ?></select></td></tr></table>',
				    icon: 'glyphicon glyphicon-question-sign',
				    animation: 'scale',
				    closeAnimation: 'scale',
				    opacity: 0.5,
				    buttons: {
				        confirm: {
				            text: 'SI',
				            btnClass: 'btn-green', 
				            action: function () {         
		                		//accion de guardar la distribucion
		             			var j=0;
								for (var i = 0; i < markersArray.length; i++) {
							  		if (google.maps.geometry.poly.containsLocation(markersArray[i].getPosition(), newShape)){
							  			var fletero=$('#fletero_mueve').val();
										clientes_guardar[j]=markersArray[i].id;
										j++;
							  		}
							  	}
								var clientes_json=JSON.stringify(clientes_guardar);
								$.ajax({
									url:'distribucion/guardar_distribucion.php',
									type:'post',
									data:'clientes_json='+clientes_json+'&movil='+fletero,
									success: function (a){
										$.alert(a);
										overlay.setMap(null);
										for (var i = 0; i < markersArray.length; i++) {
									  		if (google.maps.geometry.poly.containsLocation(markersArray[i].getPosition(), overlay)){
									  			markersArray[i].setMap(null);
									  		}
									  	}										
									}
								})
				            }
				        },
				        cancel: {
				            text: 'NO',
				            btnClass: 'btn-red',
				            action: function () {
				              $.alert('Accion Cancelada');
				            }
				        }
				    }
				});
		    });
		}

		function clearSelection() {
	        if (selectedShape) {
	          selectedShape.setEditable(false);
	          selectedShape = null;
	        }
	    }	

	    function setSelection(shape) {
	        clearSelection();
	        selectedShape = shape;
	        shape.setEditable(true);
	    }


		google.maps.event.addListener(drawingManager, "overlaycomplete", function(event) {
			var newShape = event.overlay;
			newShape.type = event.type;
		    newShape.setOptions({
					strokeColor: '#d8b2d8', strokeOpacity: 0.8,
					strokeWeight: 3, fillColor: '#d8b2d8', fillOpacity: 0.35
				});	
				//alert(event.overlay.getPath().getArray());
				var image = "distribucion/punto5.png";			
				marcadores=[];
				var markerCnt = 0;
				var peso = 0;
				var total = 0;
				var bultos = 0;
				var unidades = 0;
				for (var i = 0; i < markersArray.length; i++) {
			  		if (google.maps.geometry.poly.containsLocation(markersArray[i].getPosition(), newShape)){
		      			markersArray[i].setIcon(image);  			
		        		marcadores[markerCnt]=markersArray[i].content;
		        		peso = peso + markersArray[i].peso;
		        		total = parseFloat(total) + parseFloat(markersArray[i].total);	
		        		bultos = bultos + markersArray[i].bultos;	
		        		unidades = unidades + markersArray[i].unidades;		        		
		        		markerCnt++;	        		
			  		}
			  	}
		      	$.confirm({
				    title: 'Confirmar Acción',
				    content: '<b>Clientes Marcados: '+markerCnt+'<hr>Peso de la carga:'+peso+'<hr> Total $ de la Carga:'+parseFloat(total).toFixed(2)+'<hr> Bultos: '+bultos+' Unidades: '+unidades+' </b><hr><b>Desea guardar?</b><table class="table"><tr><td>Fletero</td><td><select id="fletero_mueve"><?php for ($i=0;$i<count($vecMoviles);$i++){ ?><option value="<?php echo $vecMoviles[$i]['ID_MOVIL'];?>"><?php echo $vecMoviles[$i]['NOM_MOVIL']?></option><?php } ?></select></td></tr></table>',
				    icon: 'glyphicon glyphicon-question-sign',
				    animation: 'scale',
				    closeAnimation: 'scale',
				    opacity: 0.5,
				    buttons: {
				        confirm: {
				            text: 'SI',
				            btnClass: 'btn-green', 
				            action: function () {         
		                		//accion de guardar la distribucion
		             			var j=0;
								for (var i = 0; i < markersArray.length; i++) {
							  		if (google.maps.geometry.poly.containsLocation(markersArray[i].getPosition(), newShape)){
							  			var fletero=$('#fletero_mueve').val();
										clientes_guardar[j]=markersArray[i].id;
										j++;
							  		}
							  	}
								var clientes_json=JSON.stringify(clientes_guardar);
								$.ajax({
									url:'distribucion/guardar_distribucion.php',
									type:'post',
									data:'clientes_json='+clientes_json+'&movil='+fletero,
									success: function (a){
										$.alert(a);
										newShape.setMap(null);
										for (var i = 0; i < markersArray.length; i++) {
									  		if (google.maps.geometry.poly.containsLocation(markersArray[i].getPosition(), newShape)){
									  			markersArray[i].setMap(null);
									  		}
									  	}										
									}
								})
				            }
				        },
				        cancel: {
				            text: 'NO',
				            btnClass: 'btn-red',
				            action: function () {
				              $.alert('Accion Cancelada');
				            }
				        }
				    }
				});     	
				overlayClickListener(event.overlay);
			    google.maps.event.addListener(newShape, 'click', function() {
			   	 setSelection(newShape);			   	 
			    });
			    setSelection(newShape);	
			});
	});
</script>
</head>
<body style="margin:0px; padding:0px;">
  <input type="hidden" id="vectorpos" name="vectorpos">
  <div id="map" style="width: 100%; height: 100%;"></div>
	<div id="formContent">
		<div style="top: 50%">
			<table class="table" style="color: #000033; width: 80%; margin: 0 auto;">
				<legend align="center" style="color: #000033">Distribucion</legend>
				<tr>
					<td align="center"><a class="btn btn-primary" style=" width: 100%; margin: 0 auto;" onclick="quitar_poligono()">Quitar Zona de Distribucin</a></td>	
				</tr>
				<?php
				for ($i=0;$i<count($vecMoviles);$i++){
				?>
				<tr>
					<td align="center" id="td_<?php echo $vecMoviles[$i]['ID_MOVIL']?>"><?php echo $vecMoviles[$i]['NOM_MOVIL']?><br><span style="font-size: 48px; color: Black;"><i class="fas fa-truck"></i></span></td>
				</tr>
				<?php
				}
				?>
			</table>
		</div>
	</div>  
</body>
<?php
desconectar();
?>
</html>
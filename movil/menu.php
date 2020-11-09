<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="menu1.css">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/demo.css"/>
  <link rel="stylesheet" type="text/css" href="stylesheet.css" />
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>	  
  <script type="text/javascript" src="jquery.js"></script>
  <script type="text/javascript" src="functions.ajax.js"></script>
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <script>
  function salir()
  {
	var timeSlide = 1000;
	$('#timer').fadeIn(300);
	$('#alertBoxes').html('<div class="box-success"></div>');
	$('.box-success').hide(0).html('Espere un momento&#133;');
	$('.box-success').slideDown(timeSlide);
	setTimeout(function(){window.location.href = "logout.php";},2500);
  }
  </script>
 </head>
<?php
$id=$_REQUEST['id_vendedor'];
?>
<span class="timer" id="timer"></span>
<div id="alertBoxes"></div>
<div class="container-fluid" align="center">
	<div class="row" align="center" style="width:80%;">
		<div class="col-md-12" align="center">
			<div class="row" align="center">
				<div class="col-md-4">
					 <a href="clientes.php?id=<?php echo $id?>"><button class="btn btn-primary btn-lg btn-block" style="height: 100px; font-size: 24px"><i class="fas fa-cart-plus"></i> Nuevo Pedido</button></a>
				</div>
				<hr>
				<div class="col-md-4">
					<a href="control_pedidos.php?id=<?php echo $id?>"><button type="button" class="btn btn-primary btn-block btn-lg" style="height: 100px; font-size: 24px"><i class="fas fa-calculator"></i> 
						Control de Pedidos
					</button></a>
				</div>
				<hr>
				<div class="col-md-4">
					 <a href="#" onclick="salir()"><button class="btn btn-primary btn-block btn-lg" style="height: 100px; font-size: 24px"><i class="fas fa-sign-out-alt"></i> Salir</button></a>
				</div>
			</div>
		</div>
	</div>
</div>
</html>
<script type="text/javascript" src="script.js"></script>
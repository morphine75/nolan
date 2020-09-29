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
<body>
<div class="header">
	<h1>Nolan Pedidos<h1>
</div>
<?php
$id=$_REQUEST['id_vendedor'];
?>
<div class="container">
	<span class="timer" id="timer"></span>
	<div id="alertBoxes"></div>
	<a class="toggleMenu" href="#">Menu</a>
	<ul class="nav">
		<li class="test">
			<a href="#">Comercial</a>
			<ul>
				<li>
					<a href="clientes.php?id=<?php echo $id?>">Nuevo Pedido</a>
					<!--<ul>
						<li><a href="#">Sandals</a></li>
						<li><a href="#">Sneakers</a></li>
						<li><a href="#">Wedges</a></li>
						<li><a href="#">Heels</a></li>
						<li><a href="#">Loafers</a></li>
						<li><a href="#">Flats</a></li>
					</ul>-->
				</li>				
				<li>
					<a href="../tcomerciales/control_venta_diaria.php">Control de Pedidos</a>
					<!--<ul>
						<li><a href="#">Sandals</a></li>
						<li><a href="#">Sneakers</a></li>
						<li><a href="#">Wedges</a></li>
						<li><a href="#">Heels</a></li>
						<li><a href="#">Loafers</a></li>
						<li><a href="#">Flats</a></li>
					</ul>-->
				</li>				
		</li>
	
		<li>
			<a href="#" onclick="salir()">Salir</a>	
		</li>
	</ul>
</div>
<script type="text/javascript" src="script.js"></script>
	
</body>
</html>
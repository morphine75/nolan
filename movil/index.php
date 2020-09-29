<?php 
session_start(); 
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/demo.css"/>
		<link rel="stylesheet" type="text/css" href="stylesheet.css" />		
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.js"></script>		
		<script type="text/javascript" src="jquery.js"></script>
		<script type="text/javascript" src="functions.ajax.js"></script>
	</head>
<body>
<div class="header">
	<h1>Nolan Movil<h1>
</div>
<?php

if ( isset($_SESSION['username']) && isset($_SESSION['userid']) && $_SESSION['username'] != '' && $_SESSION['userid'] != '0')
{
	?>
	<div class="session_on">
		<?php
			$_GET['q'] = $_SESSION['userid'];
			if ($_SESSION['userid'])
			{
				header ("Location: menu.php");
			}
		?>
		<div id="alertBoxes"></div>
		<span class="timer" id="timer"  style="margin-left: 10px;"></span>
	</div>		
	<?php
}
else
{?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
		<div id="alertBoxes"></div>
			<form role="form" method="post" action="">
				<div class="form-group">	 
					<label for="exampleInputEmail1">
						Usuario
					</label>
					<input type="text" class="form-control" name="login_username" id="login_username">
				</div>
				<div class="form-group">
					 
					<label for="exampleInputPassword1">
						Contraseña
					</label>
					<input type="password" class="form-control" name="login_userpass" id="login_userpass">
				</div>
				<span class="timer" id="timer"></span>
				<button type="submit" class="btn btn-default" id="login_userbttn">
					Ingresar
				</button>	
				<button type="button" class="btn btn-default" onclick="<script>window.close()</script>">
					Cerrar
				</button>					
			</form>
		</div>
	</div>
</div>
<?php
}
?>
</body>
</html>
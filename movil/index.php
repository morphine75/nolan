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
	<style type="text/css">
html, body {
    height: 100%;
    margin: 0;
}
#videowrapper{  
    position: relative;
    overflow: hidden;
} 

#fullScreenDiv{
    min-height: 100%; 
    height: 100vh;
    width: 100vw;
    padding:0;
    margin: 0;
    background-color: gray;
    position: relative;
}

#video{    
    width: 100vw; 
    height: auto;
    margin: auto;
    display: block;
}
@media (min-aspect-ratio: 16/9) {
  #video{
    width: 100vw; 
    height:auto;
  }
}

@media (max-aspect-ratio: 16/9) {
  #video {
    height: 100vh; 
    width:auto;
    margin-left: 50vw;
    transform: translate(-50%);
  }
}

#videoMessage{
    width: 100%; 
    height: 100%;
    position: absolute; 
    top: 0; 
    left: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}
	</style>
<body>
<div id="videowrapper">
    <div id="fullScreenDiv">
		<video id="video" preload="" autoplay="" muted="" playsinline loop="">
			<source src="imagenes/neon.webm" type="video/webm">
		</video>
	<?php

	if ( isset($_SESSION['user_name']) && isset($_SESSION['user_id']) && $_SESSION['user_name'] != '' && $_SESSION['user_id'] != '0')
	{
		?>
		<div class="session_on">
			<?php
				$_GET['q'] = $_SESSION['user_id'];
				if ($_SESSION['user_id'])
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
	<div id="videoMessage" class="styling">
		<div class="header">
			<h1>Nolan Movil<h1>
		</div>
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
	</div>	
	<?php
	}
	?>	
	</div>
</div>
</body>
</html>
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


	<?php

	if ( isset($_SESSION['user_name']) && isset($_SESSION['user_id']) && $_SESSION['user_name'] != '' && $_SESSION['user_id'] != '0')
	{
		?>
		<div class="session_on">
			<?php
				if ($_SESSION['user_id'])
				{?>
					<meta http-equiv="refresh" content="0; URL='menu.php?id_vendedor=<?php echo $_SESSION['user_id']?>" />
				<?php
				}
			?>
			<div id="alertBoxes"></div>
			<span class="timer" id="timer"  style="margin-left: 10px;"></span>
		</div>		
		<?php
	}
	else
	{?>
		<div align="center">
			<div class="header" align="center">
				<h1 style="font-size: 36px;">Nolan Movil</h1>
			</div>
			<div class="container-fluid" align="center">
				<div class="row" align="center" style="width:80%;">
					<div id="alertBoxes"></div>
						<form role="form" method="post" action="">
							<div class="form-group" align="center">	 
								<p><label for="exampleInputEmail1" style="font-size: 30px">
									Usuario
								</label></p>
								<input type="text" class="form-control" style="width:70%" name="login_username" id="login_username" style="font-size: 30px">
							</div>
							<div class="form-group">
								<p><label for="exampleInputPassword1" style="font-size: 30px">
									Contraseña
								</label></p>
								<input type="password" class="form-control" style="width:70%" name="login_userpass" id="login_userpass">
							</div>
							<span class="timer" id="timer"></span>
							<button type="submit" class="btn btn-primary btn-lg btn-block" id="login_userbttn" style="font-size: 30px; width:70%">
								Ingresar
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
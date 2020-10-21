<?php
session_start();
?>
<html>
<head> <title>Nolan</title> 
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Administrador</title>
</head>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/functions.ajax.js"></script>
<style type="text/css">
.style2 {color: #656565}

body {
    padding-top: 10%;

}
.panel-login {
	border-color: #ccc;
	-webkit-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
	-moz-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
	box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
}
.panel-login>.panel-heading {
	color: #00415d;
	background-color: #fff;
	border-color: #fff;
	text-align:center;
}
.panel-login>.panel-heading a{
	text-decoration: none;
	color: #666;
	font-weight: bold;
	font-size: 15px;
	-webkit-transition: all 0.1s linear;
	-moz-transition: all 0.1s linear;
	transition: all 0.1s linear;
}
.panel-login>.panel-heading a.active{
	color: #029f5b;
	font-size: 18px;
}
.panel-login>.panel-heading hr{
	margin-top: 10px;
	margin-bottom: 0px;
	clear: both;
	border: 0;
	height: 1px;
	background-image: -webkit-linear-gradient(left,rgba(0, 0, 0, 0),rgba(0, 0, 0, 0.15),rgba(0, 0, 0, 0));
	background-image: -moz-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
	background-image: -ms-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
	background-image: -o-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
}
.panel-login input[type="text"],.panel-login input[type="email"],.panel-login input[type="password"] {
	height: 45px;
	border: 1px solid #ddd;
	font-size: 16px;
	-webkit-transition: all 0.1s linear;
	-moz-transition: all 0.1s linear;
	transition: all 0.1s linear;
}
.panel-login input:hover,
.panel-login input:focus {
	outline:none;
	-webkit-box-shadow: none;
	-moz-box-shadow: none;
	box-shadow: none;
	border-color: #ccc;
}
.btn-login {
	background-color: #59B2E0;
	outline: none;
	color: #fff;
	font-size: 14px;
	height: auto;
	font-weight: normal;
	padding: 14px 0;
	text-transform: uppercase;
	border-color: #59B2E6;
}
.btn-login:hover,
.btn-login:focus {
	color: #fff;
	background-color: #53A3CD;
	border-color: #53A3CD;
}
.forgot-password {
	text-decoration: underline;
	color: #888;
}
.forgot-password:hover,
.forgot-password:focus {
	text-decoration: underline;
	color: #666;
}

.btn-register {
	background-color: #1CB94E;
	outline: none;
	color: #fff;
	font-size: 14px;
	height: auto;
	font-weight: normal;
	padding: 14px 0;
	text-transform: uppercase;
	border-color: #1CB94A;
}
.btn-register:hover,
.btn-register:focus {
	color: #fff;
	background-color: #1CA347;
	border-color: #1CA347;
}

#alertBoxes{
	display: block;
	width: 100%;
	text-align: left;
	margin-bottom: 10px;
	margin-top: 10px;
}

.timer{
	display: inline-block;
	width: 12px;
	height: 12px;
	background-image: url('img/spinner.gif');
	background-position: 50% 50%;
	background-repeat: no-repeat;
}

.box-info, .box-success, .box-alert, .box-error{
	clear: both;
	border-width: 1px;
	border-style: solid;
	margin: 0px;
	padding: 5px;
	background-repeat: no-repeat;
	background-position: 0px 50%;
	text-align: left;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
}
.box-info {
	color: #00529b;
	background-color: #bde5f8;
	border-color: #00529b;
}
.box-success {
	color: #4f8a10;
	background-color: #dff2bf;
	border-color: #4f8a10;
}
.box-alert {
	color: #9f6000;
	background-color: #feefb3;
	border-color: #9f6000;
}
.box-error {
	color: #d8000c;
	background-color: #ffbaba;
	border-color: #d8000c;
}

</style>
<body>  
<?php
	include('inc/conexion.php');
	conectar();
	if ( isset($_SESSION['username']) && isset($_SESSION['userid']) && $_SESSION['username'] != '' && $_SESSION['userid'] != '0' )
	{
	?>
	<div class="session_on">
		<?php
			$_GET['q'] = $_SESSION['userid'];
			if ($_SESSION['userid'])
			{?>
				<script>window.location.href = "menu.php";</script>;
			<?php
			}
		?>
	</div>			
	<?php
	}
	else{	
?>
	<div id="alertBoxes"></div>
	<span class="timer" id="timer"  style="margin-left: 10px;"></span>
	<div class="container">
    	<div class="row">
			<!--<video id="mivideo" autoplay="autoplay" loop>
			  <source src="imagenes/backgr1.mp4" type="video/mp4"></source>
			</video>    		-->
			<div class="col-lg-4">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<a href="#" class="active" id="login-form-link"><h3>Nolan</h3></a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form" action="index.php?login=ok" method="post" role="form" style="display: block;">
									<div class="form-group">
										<input type="text" name="usuario" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
									</div>
									<div class="form-group">
										<input type="password" name="clave" id="userpass" tabindex="2" class="form-control" placeholder="Password">
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
											</div>
										</div>
									</div>								
								</form>							
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php
	}
?>
</body>
</html>

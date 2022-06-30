<?php
	session_start();
	if (!isset($_SESSION['username']) && !isset($_SESSION['userid'])){
		if ($idcnx = @mysqli_connect("localhost", "c1980084_nolan", "MEde87diwu", "c1980084_nolan")){
			$sql = "SELECT id_usuario, nombre FROM usuarios WHERE nombre='".$_REQUEST['username']."' and pass='".$_REQUEST['userpass']."' LIMIT 1";
			
			if ( $res = @mysqli_query($idcnx, $sql) ){
				if ( @mysqli_num_rows($res) == 1 ){
					$user = @mysqli_fetch_assoc($res);		
					$_SESSION['username'] = $user['nombre'];
					$_SESSION['userid']	= $user['id_usuario'];
					if ($_SESSION['userid'])
					{
						echo $_SESSION['userid'];
					}
				}
				else{
					echo 0;
				}
			}
			else{
				echo 0;
			}
		}
		else{
			echo 0;
		}
	}
	else{
		echo 0;
	}
?>
<?php
	session_start();
	if (!isset($_SESSION['username']) && !isset($_SESSION['userid'])){
		if ($idcnx = @mysqli_connect("localhost", "root", "", "nolan")){
			$sql = "SELECT ID_VENDEDOR, NOM_VENDEDOR FROM VENDEDORES WHERE ID_VENDEDOR='".$_REQUEST['login_username']."' && PASS='".$_REQUEST['login_userpass']."' LIMIT 1";
			if ( $res = @mysqli_query($idcnx, $sql) ){
				if ( @mysqli_num_rows($res) == 1 ){
					$user = @mysqli_fetch_assoc($res);		
					$_SESSION['username'] = $user['NOM_VENDEDOR'];
					$_SESSION['userid']	= $user['ID_VENDEDOR'];
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
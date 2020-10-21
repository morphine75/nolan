<?php
	session_start();
	if (!isset($_SESSION['user_name']) && !isset($_SESSION['user-id'])){
		if ($idcnx = @mysqli_connect("localhost", "root", "", "nolan")){
			$sql = "SELECT ID_VENDEDOR, NOM_VENDEDOR FROM VENDEDORES WHERE ID_VENDEDOR='".$_REQUEST['login_username']."' && PASS='".$_REQUEST['login_userpass']."' LIMIT 1";
			if ( $res = @mysqli_query($idcnx, $sql) ){
				if ( @mysqli_num_rows($res) == 1 ){
					$user = @mysqli_fetch_assoc($res);		
					$_SESSION['user_name'] = $user['NOM_VENDEDOR'];
					$_SESSION['user_id']	= $user['ID_VENDEDOR'];
					if ($_SESSION['user_id'])
					{
						echo $_SESSION['user_id'];
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
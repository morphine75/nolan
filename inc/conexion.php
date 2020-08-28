<?php
function conectar(){
	global $conn;
	$conn = @mysqli_connect("localhost", "root", "", "nolan");
	if (!$conn) {
		die('Could not connect: ' . mysqli_error($conn));
	}
	return $conn;
}

function desconectar()
{
	global $conn;
	mysqli_close($conn);
}
?>
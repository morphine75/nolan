<?php
function conectar(){
	global $conn;
	$conn = @mysqli_connect("localhost", "c1980084_nolan", "MEde87diwu", "c1980084_nolan");
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
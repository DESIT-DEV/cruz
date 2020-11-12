<?php
$servername = "localhost";
$username = "root";
$password = "";
$base="busca";

$conexion = new mysqli($servername, $username, $password,$base);
	if ($conexion->connect_error) {
   	 die("No funciono perra " . $conexion->connect_error);
	}
	else{

		$conexion-> select_db('busca');
	}

?>



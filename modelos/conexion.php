<?php 

	$host="localhost";
	$base="support_resource";
	$user="root";
	$pass="";

	$tabla_db1="plazas";

	$conexion=new mysqli($host,$user,$pass,$base);

	if ($conexion->connect_errno) {
		echo "Error no se conecto a la base";
	}





 ?>
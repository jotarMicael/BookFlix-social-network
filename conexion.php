<?php 
	// Parametros a configurar para la conexion de la base de datos 
	$host = "localhost";    // sera el valor de nuestra BD 
	$basededatos = "bookflix";    // sera el valor de nuestra BD 
	$usuariodb = "root";    // sera el valor de nuestra BD 
	$clavedb = "4509221m";    // sera el valor de nuestra BD 

	//Lista de Tablas
	$tabla_db1 = "cuenta"; 	   // tabla de usuarios


	error_reporting(0); //No me muestra errores
	
	$conexion = mysqli_connect($host,$usuariodb,$clavedb,$basededatos);

	
	if ($conexion->connect_errno) {
		echo "Nuestro sitio experimenta fallos....";
		exit();
	}

	

	

?>
<?php
	session_start();

	include('conexion.php');

	if (empty($_POST['nickname'])) {
		$_SESSION['error'] = 'ingresar usuario';
		header('Location: index.php');
		exit;
	}
	if (empty($_POST['contraseña'])) {
		$_SESSION['error'] = 'ingresar contraseña';
		header('Location: index.php');
		exit;
	}
	
	 $result = mysqli_query($conexion, "SELECT * FROM cuentausuario WHERE nombre_Usuario = '" . $_POST['nickname'] . "'");
	 $result2 = mysqli_query($conexion, "SELECT * FROM cuenta WHERE nombre_Usuario = '" . $_POST['nickname'] . "' AND contraseña = '" . $_POST['contraseña'] . "' ");

	if(( mysqli_num_rows($result) == 0 ) || ( mysqli_num_rows($result2) == 0 )){
		$_SESSION['error'] = 'Usuario y/o Contraseña incorrectos';
		header('Location: index.php');
		exit;
	}
	else{
		$_SESSION['usuario'] = mysqli_fetch_array($result2);	
		header('Location: verYCrearPerfiles.php');
		exit;
		}


?>
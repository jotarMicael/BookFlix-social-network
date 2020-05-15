<?php
	session_start();

	if (!empty($_SESSION['error'])) {
		echo $_SESSION['error'];
		unset($_SESSION['error']);
	}
?>
<!DOCTYPE html>
<html>
<head >
	<title>Inicio</title>
	<link href="Estilos.css" rel="stylesheet" type="text/css">
	<link rel="shortcut icon" href="logotipo.jpg"> 
	<script type="text/javascript" src="scriptRegistro.js"></script>
	<?php
		include('conexion.php');
	?>
	<style>
		body{background-color: #4642B8;padding: 15px;font-family: Arial;}
		
		#menu{
			background-color: #000;
			position: relative;
		
		}

		#menu ul{
			list-style: none;
			margin: 0;
			padding: 0;
		}

		#menu ul li{
			display: flex;
		}

		#menu ul li a{
			color: white;
			display: block;
			padding: 10px 5px;
			text-decoration: none;
		}

		#menu ul li a:hover{
			background-color: #42B881;
		}

		.item-r{
			float: right;
		}
	</style>

</head>
<body background="Imagenes/2.jpg">
	<div id="menu">
		<ul>
			<label class="labelWhite">Buscar: </label>
			<input type="text" class="redondeado" autocomplete="on" id="libro" name="libro">
			<li><a href="#">Inicio</a></li>
			<li><a href="#">Mi Perfil</a></li>
			<li><a href="#">Configuracion</a></li>
			<li><a href="#">Cerrar Sesion</a></li>
			
		</ul>
	</div>
	
				<!--En esta parte del codigo hay que consultar a la base de datos todos los libros que tiene cargados, y mostrarlos como un link. Ese link debe redireccionar al libro en concreto-->
				<?php 
					$sql="SELECT * from libros";
					$result=mysqli_query($conexion,$sql);

					while($mostrar=mysqli_fetch_array($result)){
				?>

				<tr>
					<td><?php echo $mostrar['portada'] ?></td>
					<td><?php echo $mostrar['nombre'] ?></td>
					
				</tr>
	<?php 
	}
	 ?>
		   	</div>
    
</body>
</html>
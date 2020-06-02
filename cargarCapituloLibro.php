<?php session_start(); 
include('conexion.php');
 ?>
<!DOCTYPE html>
<html>
<head>
	<link href="Estilos.css" rel="stylesheet" type="text/css">
	<link rel="shortcut icon" href="logotipo.jpg">
	<title>Cargar Capitulo</title>
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

		.nav li ul {
			display:none;
			position:absolute;
			min-width:140px;

		}
		.nav li:hover > ul{

			display:block;
		}
		.nav li ul li{
			position:absolute;
		}
		.nav li ul li ul{
			position:absolute;
			right: -140px;
			top: 0px;
		}
	</style>
</head>
<body background= "Imagenes/2.jpg">
	<div id="menu" class="barraInicio">
			<div class="divBotones">
			<li><a href="Home.php" class="botonInicio">Inicio</a></li>
			</div>
			<div class="divBotones">
			<?php
				$result = mysqli_query($conexion, "SELECT nombre_Usuario FROM cuentaadministrador WHERE nombre_Usuario = '".$_SESSION['usuario']['nombre_Usuario']."' ");
				if(mysqli_num_rows($result) <> 1){
					?>
			<li><a class="botonInicio" href="miPerfil.php?perfil=<?php echo $_GET['perfil'];?>&img=<?php echo $_GET['img'];?>">Mi Perfil</a></li>
			<?php }?>
		    </div>
		    <div class="divBotones">
		    	<img class="imagenBarraSuperior" src="Imagenes\TituloBarraSuperior.png">
		    </div>
				
		    <div class="divBotones">
			<label class="labelWhite">Buscar: </label>
			<input type="text" class="redondeado" autocomplete="on" id="libro" name="libro">
			
		    </div>
			<div class="divBotones">
			<?php
				$result = mysqli_query($conexion, "SELECT nombre_Usuario FROM cuentaadministrador WHERE nombre_Usuario = '".$_SESSION['usuario']['nombre_Usuario']."' ");
				if(mysqli_num_rows($result) <> 1){
					?>
			<li><a class="botonInicio" href="Configuracion.php?perfil=<?php echo $_GET['perfil'];?>&img=<?php echo $_GET['img'];?>">Configuracion</a></li>
			<?php }?>
			</div>
	</div>
			<h2 class="tituloSecundarioConfiguracion" >Ingrese los datos del capitulo</h2>
			<div class="divConfiguracion">
				  <div class="registroConfiguracion">
				  <form action="cargarCapituloLibro.php" method="post" enctype="multipart/form-data">
					<label class="labelWhite">ISBN del libro: </label><br>
					<input type="text" class="redondeado" autocomplete="on" id="ISBN" name="ISBN"><br>
					<label class="labelWhite">Nombre del capitulo: </label><br>
					<input type="text" class="redondeado" autocomplete="on" id="nCap" name="nCap"><br>
					<label class="labelWhite">Seleccionar pdf del capitulo: </label><br>
					<input type="file" class="redondeado" id="pdf" name="pdf" accept="application/pdf"><br>
					<input type="submit" class="boton" value="Ingresar"><br>
					</form>
				  </div>
				
		   	</div>
			<?php 
			
				if (isset($_POST['ISBN'])&&isset($_FILES['pdf'])&&isset($_POST['nCap'])){

					//Consulto en la bbdd si ya existe el capitulo que quiero ingresar
					$sql= "SELECT nombre_Capitulo FROM capitulo WHERE nombre_Capitulo = '".$_POST['nCap']."'";
					$result=mysqli_query($conexion,$sql);
					
					if( mysqli_num_rows($result) == 1 ){
						echo "<font color=white  size='5pt'> El capitulo ya se encuentra cargado </font>";
						//ingreso el capitulo
					}
					else {
						if(isset($_FILES['pdf'])){

							$nombre_pdf = $_FILES['pdf']['name'];
							$tipo_pdf = $_FILES['pdf']['type'];
							$tamagno_pdf = $_FILES['pdf']['size'];
	
							if ($tamagno_pdf<=100000000){
								if($tipo_pdf == 'application/pdf'){
	
									//Ruta de la carpeta destino
									$carpeta_Destino = $_SERVER ['DOCUMENT_ROOT'] . '/BookFlix/pdfs/';
									//Mover imagen del directorio temporal al directorio escogido
									move_uploaded_file($_FILES['pdf']['tmp_name'], $carpeta_Destino.$nombre_pdf);
									//header("Location: cargarLibro.php");
								}
								else {
	
									echo "<font color=white  size='5pt'> Solo se puede subir pdf </font>";
								}
									
							}
							else{
	
								echo "<font color=white  size='5pt'> El tamaño del pdf es demasiado grande </font>";
							}
						}

						$sql3="SELECT id_Libro from libro WHERE ISBN ='" .$_POST['ISBN']."' ";
						$result3=mysqli_query($conexion,$sql3);
						$mostrar=mysqli_fetch_array($result3, MYSQLI_ASSOC);
						
						echo $_POST["nCap"]; echo $mostrar["id_Libro"]; echo $nombre_pdf;
						$sql2="INSERT INTO capitulo(nombre_Capitulo,id_Libro,pdf) VALUES ('".$_POST["nCap"]."','".$mostrar["id_Libro"]."','$nombre_pdf')";
						$result2=mysqli_query($conexion,$sql2);
						echo "<font color=white  size='5pt'> El capitulo se ha cargado correctamente </font>";

					}
					
				}
				else echo "<font color=white  size='5pt'> Deben ingresarse todos los datos, de lo contrario, seguira mostrandose este mensaje </font>";
			?>
	 </div>
		
	<div class="barraFin">
		<p class="textoBarra">Gutierrez Matias 15257/5 - Jotar Micael 15388/6 - Valentin Gallardo 15292/9</p>
    </div>
</body>
</html>
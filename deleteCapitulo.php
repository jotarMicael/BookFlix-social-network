<?php session_start(); 
include('conexion.php');
 ?>
<!DOCTYPE html>
<html>
<head>
	<link href="Estilos.css" rel="stylesheet" type="text/css">
	<link rel="shortcut icon" href="logotipo.jpg">
	<title>Eliminar Capitulo</title>
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
			<h2 class="tituloSecundarioConfiguracion" >Ingrese los datos del capitulo para borrar</h2>
			<div class="divConfiguracion">
				
				  <div class="registroConfiguracion">
				  <form action="deleteCapitulo.php" method="post" enctype="multipart/form-data">
					<label class="labelWhite">ISBN del libro perteneciente al capitulo: </label><br>
					<input type="text" class="redondeado" autocomplete="on" id="ISBN" name="ISBN"><br>
					<label class="labelWhite">Nombre del capitulo: </label><br>
					<input type="text" class="redondeado" autocomplete="on" id="nombreCap" name="nombreCap"><br>
					<input type="submit" class="boton" value="Ingresar"><br>
					</form>
				  </div>
				
		   	</div>
			<?php 
			
				if (!empty($_POST['ISBN'])&&!empty($_POST['nombreCap'])){
					$sql= "SELECT id_Libro FROM libro WHERE ISBN='".$_POST['ISBN']."' ";
					$result=mysqli_query($conexion,$sql);
					$sql2= "SELECT nombre_Capitulo FROM capitulo WHERE nombre_Capitulo='".$_POST['nombreCap']."' ";
					$result2=mysqli_query($conexion,$sql2);
					$mostrar=mysqli_fetch_array($result);
					if((mysqli_num_rows($result)==1)&&(mysqli_num_rows($result2)==1)){  
                            $sql= "DELETE FROM capitulo WHERE '".$mostrar['id_Libro']."'=id_Libro and '".$_POST['nombreCap']."'=nombre_Capitulo ";
					        $result=mysqli_query($conexion,$sql);
                            echo "<font color=white  size='5pt'> Eliminado Correctamente </font>";
                        }
					else {
						echo "<font color=white  size='5pt'> El Libro o Capitulo ingresado no existe </font>";
					}
                }
                else
                    echo "<font color=white  size='5pt'> Debe ingresar nombre del capitulo, e ISBN del libro a borrar </font>";

			?>
	 </div>
		
	<div class="barraFin">
		<p class="textoBarra">Gutierrez Matias 15257/5 - Jotar Micael 15388/6 - Valentin Gallardo 15292/9</p>
    </div>
</body>
</html>
<?php
  include('conexion.php');
  session_start();
  $sql="DELETE FROM cuentausuariotipopremiun WHERE '".$_SESSION['usuario']['nombre_Usuario']."'=nombre_Usuario ";
  $result=mysqli_query($conexion,$sql);
  $_SESSION['error']='Usted posee la licencia basica nuevamente';
  header("Location:Configuracion.php");
  exit;
?>
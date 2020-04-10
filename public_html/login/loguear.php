<?php
session_start();
require 'conexion.php';
$usuario = $_POST['usuario'];
$contraseña = $_POST['password'];


$query = "SELECT COUNT(*) as contar FROM usuarios where usuario = '$usuario' and clave = '$contraseña' ";
$bdconect = mysqli_query($conexion,$query);
$parametros = mysqli_fetch_array($bdconect);
if($parametros['contar']>0){
	$_SESSION['username'] = $usuario;
	$resultado="SELECT tipo from usuarios where usuario='$usuario'";
	$bdconect2 = mysqli_query($conexion,$resultado);
	$parametro = mysqli_fetch_array($bdconect2);
	$tipoUsuario=$parametro[0];
	if($tipoUsuario==1){
		header("location: ../vistaAdministrador.php");
	}elseif ($tipoUsuario==2) {
		header("location: ../vistaProfesor.php");
	}else{
		header("location: ../vistaEstudiante.php");
	}

}else {
    header("location: ../login.php");
}


?>
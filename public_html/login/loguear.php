<?php
session_start();
require 'conexion.php';
$usuario = $_POST['usuario'];
$contraseña = $_POST['password'];


$query = "SELECT COUNT(*) as contar FROM usuarios where idUsuario = '$usuario' and Password = '$contraseña' ";
$bdconect = mysqli_query($conexion,$query);
$parametros = mysqli_fetch_array($bdconect);
if($parametros['contar']>0){
	$_SESSION['username'] = $usuario;
	$resultado="SELECT Rol from usuarios where idUsuario='$usuario'";
	$bdconect2 = mysqli_query($conexion,$resultado);
	$parametro = mysqli_fetch_array($bdconect2);
	$tipoUsuario=$parametro[0];
	$_SESSION['rol']=$tipoUsuario;
	if($tipoUsuario==1){
		header("location: ../vistaAdministrador.php");
	}elseif ($tipoUsuario==2) {
		header("location: ../vistaProfesor.php");
	}else{
		header("location: ../vistaEstudiante.php");
	}

}else {
    header("location: ../login.php?error=1");
}


?>
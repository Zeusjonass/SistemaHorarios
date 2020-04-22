<?php  
session_start();
$usuario= $_SESSION['username'];
$rol=$_SESSION['rol'];
if(!isset($usuario)):
    header("location:login.php");
else:
	if($rol==1):
		require 'login//conexion.php';
		if(isset($_POST['claseElegida'])):
			$claseElegida=$_POST['claseElegida'];
			$clasesQuery="SELECT * FROM clase where idClase='$claseElegida'";
			$queryResult=mysqli_query($conexion,$clasesQuery);
			$datosObtenidos=mysqli_fetch_array($queryResult);
			$borrarQuery="DELETE FROM clase where idClase='$claseElegida'";
			$borrarResult=mysqli_query($conexion,$borrarQuery);
			if($borrarResult):
				header("location:vistaAdministrador.php");
			else:
				echo "Existio un error";
			endif;
		else:
			echo "No se eligio ninguna clase";
		endif;
	else:
		header("location:cerrarSesion.php");
	endif;
endif;

?>
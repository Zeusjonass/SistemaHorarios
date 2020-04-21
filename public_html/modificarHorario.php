<?php  
session_start();
$usuario= $_SESSION['username'];
$rol=$_SESSION['rol'];
if(!isset($usuario)):
    header("location:login.php");
else:
	if($rol==1):
		require 'login//conexion.php';
		$accionElegida=$_POST['opcion'];
		$claseElegida=$_POST['claseElegida'];
		$clasesQuery="SELECT * FROM clase where idClase='$claseElegida'";
		$queryResult=mysqli_query($conexion,$clasesQuery);
		$datosObtenidos=mysqli_fetch_array($queryResult);
		if($accionElegida=="borrar"):
			$borrarQuery="DELETE FROM clase where idClase='$claseElegida'";
			$borrarResult=mysqli_query($conexion,$borrarQuery);
			if($borrarResult):
				header("location:vistaAdministrador.php");
			else:
				echo "Existio un error";
			endif;
		else:

		endif;
	else:
		header("location:cerrarSesion.php");
	endif;
endif;

?>
<?php
	require 'Dao.php';
	require '../Modelos/Usuario.php';
	require '../Modelos/clase.php';  
	session_start();
	switch ($_GET['action']) {

		case 'login':

			$usuario = new Usuario($_POST['usuario'],$_POST['password']);

			$dao = new Dao();

			$dao->login($usuario);

			break;

		case 'registrar':

			$clase = new Clase($_POST['cursos'],$_POST['salon'],$_POST['dia'],$_POST['horaInicio'],$_POST['horaFin']);

			$dao = new Dao();

			$dao->registrarClase($clase);

			break;

		case 'borrar':

			$claseElegida=$_POST['claseElegida'];

			$dao = new Dao();

			$dao->borrarClase($claseElegida);

			break;

		case 'editar':
			
			$clase = new Clase("",$_POST['salon'],$_POST['dia'],$_POST['horaInicio'],$_POST['horaFin']);
			
			$dao = new Dao();

			$dao->editarClase($clase);

			break;

		default:

			break;
	}

?>
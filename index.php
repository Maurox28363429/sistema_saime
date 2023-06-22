<?php
try {
	include('db/conexion.php');
	include('session/session.php');
	include('templates/header.php');
	if($_SESSION['user']==null){
		include('views/login.php');
		exit();
	}

	$router = (isset($_GET['router'])==true)? $_GET['router'] : null;
	if($router=="salir"){
		session_destroy();
		header('Location: /');
		exit();
	}
	if(!$router){
		include('views/home.php');
		include('templates/footer.php');
		exit();
	}
	if($router=="imprimir_desin"){
		include('views/imprirmir_desing.php');
		exit();
	}
	include('templates/navbar.php');
	switch ($router) {
		case 'logs':
			if($_SESSION['user']['admin']!=1){
				header('Location: /');
				exit();
			}
			include("views/logs.php");
			break;
		case 'users':
			if($_SESSION['user']['admin']!=1){
				header('Location: /');
				exit();
			}
			include("views/users.php");
			break;
		case 'user-add':
			if($_SESSION['user']['admin']!=1){
				header('Location: /');
				exit();
			}
			include("views/user-add.php");
			break;
		case 'user-edit':
			if($_SESSION['user']['admin']!=1){
				header('Location: /');
				exit();
			}
			include("views/user-edit.php");
			break;
		case 'pasaportes':
			include("views/pasaportes.php");
			break;
		case 'pasaportes-add':
			include("views/pasaportes-add.php");
			break;
		case 'pasaportes-edit':
			include("views/pasaportes-edit.php");
			break;
		default:
			include("views/dash.php");
			break;
	}
	include('templates/footer.php');
} catch (Exception $e) {
	// Code to handle the exception
	echo "Error: " . $e->getMessage();
	echo "Line: " . $e->getLine();
	echo "File: " . $e->getFile();
}
?>
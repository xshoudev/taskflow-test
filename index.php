<?php 

	include('templates/header.php');

	session_start();
	
	//Si existe una session te muestra el grid
	//O el login dependiendo si ya iniciaste sesión previamente

	if (isset($_SESSION['nombre'])) {
		include 'views/grid.php'; 
	} else {
		include 'views/login-form.php'; 
	}

	include('templates/footer.php');
	

?>
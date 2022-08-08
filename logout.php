<?php
	session_start();
	include('db_connection.php');
	
		
		session_destroy();
		session_unset();
		header('Location: index.php');
?>
<?php
	session_start();
	include('db_connection.php');
	
	if(!$_SESSION['username']){
		header('Location: index.php');
	}
?>
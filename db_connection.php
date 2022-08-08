<?php
	$host = "localhost";
	$user = "root";
	$password = "";
	$dbname = "lms";
	
	$dsn = "mysql:host=$host;dbname=$dbname";
	
	$pdo = new PDO($dsn, $user, $password);
	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
	
	/*$sql = "SELECT * FROM studentsinfo";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$users = $stmt->fetchAll();
	
	foreach($users as $user){
		echo $user->name. " " .$user->address ." " .$user->IDNumber ."<br>";
	}*/
?>
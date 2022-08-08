<?php
	include('security.php');

	if(isset($_POST['submit'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$sql = "SELECT * FROM account WHERE username = ? AND password = ?";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([$username, $password]);
		$user = $stmt->fetch();
		
		if($user){
			$_SESSION['accountId'] = $user->id;
			$_SESSION['username'] = $user->username;
			$_SESSION['accountType'] = $user->accountType;
			if($_SESSION['accountType'] == "admin")
				header('Location: dashboard.php');
			else if($_SESSION['accountType'] == "student")
				header('Location: myBook.php');
		}
		else{
			$_SESSION['status'] = "Email/Password is invalid";
			header('Location: index.php');
		}
	}
	
	if(!$_SESSION['username']){
		header('Location: index.php');
	}
?>
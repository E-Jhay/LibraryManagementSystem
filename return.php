<?php
	include('security.php');
	//date_default_timezone_set('Asia/Manila');
	//$today = date('Y-m-d H:i:s');
	//$borrowId = $_POST['borrowId'];
	//$pdo->query("UPDATE borrow SET status = 'Returned', dateReturned = $today WHERE borrowId = $borrowId");
	
	//header('location: returned-borrowed.php');
	//echo $today. "<br>" .$borrowId;
	
	if(isset($_GET['id'])){
		date_default_timezone_set('Asia/Manila');
		$borrowId = $_GET['id'];
		$today = date('Y-m-d H:i:s');
		$sql = "UPDATE borrow SET dateReturned = ?, status = ? WHERE borrowId = ?";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([$today, 'Returned', $borrowId]);
		
		if($_SESSION['accountType'] == 'student')
			header('location: myBook.php');
		else
			header('location: returned-borrowed.php');
	}
?>
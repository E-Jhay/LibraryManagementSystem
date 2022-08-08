<?php
	include('security.php');

	if(isset($_GET['id'])){
		$bookId = $_GET['id'];
		//write sql query
		$sql = "DELETE FROM book WHERE id= ?";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([$bookId]);
		
		header('Location: book.php');
	}
?>
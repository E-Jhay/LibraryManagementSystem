<?php
	include('security.php');

	if(isset($_GET['id'])){
		$Id = $_GET['id'];
		$accountType = $_GET['accountType'];
		/*write sql query , upon deleting an account,
		 it will also delete the admin or the student in the entire database*/
		$sql = "DELETE FROM account WHERE id= ?";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([$Id]);
		
		if($accountType == "admin"){
			/*if the account deleted is admin it will go back to admin page
				else it will go to the student page*/
			header('Location: admin.php');
		}else
			header('Location: student.php');
	}
?>
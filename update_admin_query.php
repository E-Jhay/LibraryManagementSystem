<?php
	include('security.php');
	if(isset($_POST['update'])){
		$adminId = $_POST['adminId'];
		$name = $_POST['name'];
		$address = $_POST['address'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$gender = $_POST['gender'];
		$accountId = $_POST['accountId'];
		date_default_timezone_set('Asia/Manila');
		$dateModified = date("Y-m-d H:i:s");
		
		//checks if there are similar username upon updating
		$qduplicate = "SELECT * FROM account WHERE username = ? AND id != ?";
		$stmt = $pdo->prepare($qduplicate);
		$stmt->execute([$username, $accountId]);
		if($stmt->rowCount() > 0){
			// if it has similar account, we disrupt the operation
			echo '
				<script type = "text/javascript">
					alert("Username already taken");
					window.location = "admin.php";
				</script>
			';
		}
		else{
			$sql = "UPDATE admin SET name = ?, address = ?, gender = ? WHERE id = ?";
			$stmt = $pdo->prepare($sql);
			$stmt->execute([$name, $address, $gender, $adminId]);
		
			$sql1 = "UPDATE account SET username = ?, password = ?, dateModified = ? WHERE id = ?";
			$stmt = $pdo->prepare($sql1);
			$stmt->execute([$username, $password, $dateModified, $accountId]);
			echo '
				<script type = "text/javascript">
					alert("Save Changes");
					window.location = "admin.php";
				</script>
			';
		}
		
	}
	
?>
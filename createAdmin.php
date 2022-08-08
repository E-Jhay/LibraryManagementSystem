<?php
	include('security.php');
		
	// if the submit button's been clicked, we need to process the inputs
	if(isset($_POST['create_admin'])){
		$name = $_POST['name'];
		$address = $_POST['address'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$gender = $_POST['gender'];
		$accountType = $_POST['accountType'];
		date_default_timezone_set('Asia/Manila');
		$dateCreated = date("Y-m-d H:i:s");
		$qAdmin = "SELECT * FROM account WHERE username = ?";
		$stmt = $pdo->prepare($qAdmin);
		$stmt->execute([$username]);
		// checks if username is already taken there should be no similar username
		if($stmt->rowCount() > 0){
			echo '
				<script type = "text/javascript">
					alert("Username already taken");
					window.location = "admin.php";
				</script>
			';
		}
		else{
		
			$sql = "INSERT INTO account (username, password, accountType, dateCreated) VALUE(?, ?, ?, ?)";
			$stmt = $pdo->prepare($sql);
			$stmt->execute([$username, $password, $accountType, $dateCreated]);
			//lastAccountId stores the last created id of the query
			$lastAccountId = $pdo->lastInsertId();
			
			$sql1 = "INSERT INTO admin (name, address, gender, accountId) VALUE(?, ?, ?, ?)";
			$stmt1 = $pdo->prepare($sql1);
			$stmt1->execute([$name, $address,  $gender, $lastAccountId]);
			
			echo '
				<script type = "text/javascript">
					alert("Admin created successfully");
					window.location = "admin.php";
				</script>
			';
		}
	}
?>
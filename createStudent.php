<?php
	include('security.php');
		
	// if the submit button's been clicked, we need to process the inputs
	if(isset($_POST['create_student'])){
		$name = $_POST['name'];
		$course = $_POST['course'];
		$yearSection = $_POST['yearSection'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$gender = $_POST['gender'];
		$accountType = $_POST['accountType'];
		date_default_timezone_set('Asia/Manila');
		$dateCreated = date("Y-m-d H:i:s");
		$qStudent = "SELECT * FROM account WHERE username = ?";
		$stmt = $pdo->prepare($qStudent);
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
			
			$sql1 = "INSERT INTO student (name, course, yearSection, gender, accountId) VALUE(?, ?, ?, ?, ?)";
			$stmt1 = $pdo->prepare($sql1);
			$stmt1->execute([$name, $course, $yearSection, $gender, $lastAccountId]);
			
			echo '
				<script type = "text/javascript">
					alert("Student created successfully");
					window.location = "student.php";
				</script>
			';
		}
	}
?>
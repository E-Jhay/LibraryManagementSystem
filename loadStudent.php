<?php
	
	include('security.php');
	if(isset($_GET['id'])){
		$studentId = $_GET['id'];
		//write sql query
		if($_SESSION['accountType'] == 'admin'){
			$sql = "SELECT * FROM student WHERE id = ?";
			$stmt = $pdo->prepare($sql);
			$stmt->execute([$studentId]);
			$student = $stmt->fetch();
		}
		else{
			$sql = "SELECT * FROM student WHERE accountId = ?";
			$stmt = $pdo->prepare($sql);
			$stmt->execute([$studentId]);
			$student = $stmt->fetch();
		}
		
		if($student){
			$studentId = $student->id;
			$name = $student->name;
			$course = $student->course;
			$yearSection = $student->yearSection;
			$gender = $student->gender;
			$accountId = $student->accountId;
			//get the account of the admin
			$sql = "SELECT * FROM account WHERE id = ?";
			$stmt = $pdo->prepare($sql);
			$stmt->execute([$accountId]);
			$account = $stmt->fetch();
			$dateModified = $account->dateModified;
			$password = $account->password;
			$username = $account->username;
		}
		else{
			//if the 'id' value is not valid, goes back to student page
			header('location: student.php');
		}
		
	}
?>
<div class = "col-lg-3"></div>
				<div class = "col-lg-6">
					<form method = "POST" action = "update_student_query.php" enctype = "multipart/form-data">
						<div class = "form-group">	
							<label>Name:</label>
							<input type = "text" name = "name" value="<?php echo $name;?>" class = "form-control" />
							<input type="hidden" name="studentId" value="<?php echo $studentId; ?>">
							<input type="hidden" name="accountId" value="<?php echo $accountId; ?>">
						</div>
						<div class = "form-group">	
							<label>Course:</label>
							<input type = "text" name = "course"  value="<?php echo $course;?>" class = "form-control" />
						</div>
						<div class = "form-group">	
							<label>Year&Section:</label>
							<input type = "text" name = "yearSection" value="<?php echo $yearSection;?>" class = "form-control" />
						</div>
						<div class = "form-group">
							<label>Username:</label>
							<input type = "text" name = "username" value="<?php echo $username;?>" class = "form-control" />
						</div>	
						<div class = "form-group">	
							<label>Password:</label>
							<input type = "text" maxlength = "12" name = "password" value="<?php echo $password;?>" class = "form-control" />
						</div>
						<div class = "form-group">
						<label for="gender"> Gender: </label>
							<select name="gender">
								<option value="Male">Male</option>
								<option value="Female">Female</option>
							</select>
						</div>
						<div class = "form-group">	
							<button class = "btn btn-warning" name = "update"><span class="fas fa-download"></span> Save Changes</button>
						</div>
					</form>		
				</div>
<?php
	
	include('security.php');
	if(isset($_GET['id'])){
		$adminId = $_GET['id'];
		//write sql query
		$sql = "SELECT * FROM admin WHERE id = ?";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([$adminId]);
		$admin = $stmt->fetch();
		
		
		if($admin){
			$adminId = $admin->id;
			$name = $admin->name;
			$address = $admin->address;
			$gender = $admin->gender;
			$accountId = $admin->accountId;
			//get the account of the admin
			$sql = "SELECT * FROM account WHERE id = ?";
			$stmt = $pdo->prepare($sql);
			$stmt->execute([$accountId]);
			$account = $stmt->fetch();
			$dateModified = $account->dateModified;
			$password = $account->password;
			$username = $account->username;
			}
		}else{
			//if the 'id' value is not valid, goes back to student page
			header('location: admin.php');
		}
	
?>

<div class = "col-lg-3"></div>
<div class = "col-lg-6">
	<form method = "POST" action = "update_admin_query.php" enctype = "multipart/form-data">
	<div class = "form-group">	
		<label>Name:</label>
		<input type = "text" name = "name" value="<?php echo $name;?>" class = "form-control" />
		<input type="hidden" name="adminId" value="<?php echo $adminId; ?>">
		<input type="hidden" name="accountId" value="<?php echo $accountId; ?>">
	</div>
	<div class = "form-group">	
		<label>Address:</label>
		<input type = "text" name = "address"  value="<?php echo $address;?>" class = "form-control" />
	</div>
	<div class = "form-group">
		<label>Username:</label>
		<input type = "text" name = "username" value="<?php echo $username;?>" class = "form-control" />
	</div>	
	<div class = "form-group">	
		<label>Password:</label>
		<input type = "text" name = "password" value="<?php echo $password;?>" class = "form-control" />
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
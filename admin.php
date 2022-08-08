<?php
	include('security.php');
	if($_SESSION['accountType'] == 'student')
		header('Location: myBook.php');
	//get all the data in the admin with the data in its foreign key
	$sql = "SELECT a.id, a.name, a.address, a.gender, a.accountId, ac.username, ac.password, ac.accountType FROM admin a RIGHT JOIN account ac ON a.accountId = ac.id WHERE accountType = 'admin'";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$admins = $stmt->fetchAll();
?>
<!DOCTYPE html>
<head>
	<title>Admin</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="fontawesome-free-5.15.1-web/css/all.css">
	<link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="DataTables-1.10.23/media/css/jquery.dataTables.min.css"/>
	<script src = "js/jquery-3.5.1.min.js"></script>
</head>
<body>
<div class="container">
	<div class="greetings">
		<img src="teacher.svg" style="width: 250px; height: 120px;">
		<div class = "nav">Admins</div>
	</div>
	<div class = "col-lg-1"></div>
		<div class = "col-lg-9 well" style = "margin-top:200px;margin-left:203px; border:1px solid #000066;  width: 1020px;">
				<button id = "createAdmin" type = "button" class = "btn btn-primary"><span class="fas fa-user-plus"></span> Create Admin</button>
				<button id = "showAdmin" type = "button" style = "display:none;" class = "btn btn-success"><span class ="fas fa-arrow-alt-circle-left"></span> Back</button>
				<br />
				<br />
				<div id = "adminTable">
					<table id = "myTable" class = "table table-striped table-bordered">
						<thead class = "alert-success">
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Address</th>
								<th>Username</th>
								<th>Password</th>
								<th>Gender</th>
								<th style="width: 180px">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach($admins as $admin){ ?>
							<tr>
								<td><?php echo $admin->accountId; ?></td>
								<td><?php echo $admin->name; ?></td>
								<td><?php echo $admin->address; ?></td>
								<td><?php echo $admin->username; ?></td>
								<td><?php echo $admin->password; ?></td>
								<td><?php echo $admin->gender; ?></td>
								<td><a class="btn btn-warning update" value="<?php echo $admin->id;?>"><span class="fas fa-edit"></span> Update</a>
									<a class="btn btn-danger delete" value="<?php echo $admin->accountId;?>"><span class ="fas fa-trash-alt"></span> Delete</a></td>
							</tr>
							<?php
							}
							?>
						</tbody>
					</table>
				</div>
		
		
			<div id = "editForm"></div>
			<div id = "adminForm" style="display: none;">
				<div class = "col-lg-3"></div>
				<div class = "col-lg-6">
					<form method = "POST" action = "createAdmin.php" enctype = "multipart/form-data">
						<div class = "form-group">	
							<label>Name:</label>
							<input type = "text" required = "required" name = "name" class = "form-control" required/>
							<input type="hidden" name="accountType" id="name" value="admin">
						</div>
						<div class = "form-group">	
							<label>Address:</label>
							<input type = "text" required = "required" name = "address" class = "form-control" required/>
						</div>
						<div class = "form-group">
							<label>Username:</label>
							<input type = "text" required = "required" name = "username" class = "form-control" required/>
						</div>	
						<div class = "form-group">	
							<label>Password:</label>
							<input type = "password" maxlength = "12" name = "password" required = "required" class = "form-control" required/>
						</div>
						<div class = "form-group">
						<label for="gender"> Gender: </label>
							<select name="gender">
								<option value="Male">Male</option>
								<option value="Female">Female</option>
							</select>
						</div>
						<div class = "form-group">	
							<button class = "btn btn-primary" name = "create_admin"><span class="fas fa-download"></span> Create</button>
						</div>
					</form>		
				</div>	
			</div>
		</div>
</div>
<nav class="topbar">
	<div class="header">
		<h4>PSU<span class="topText">ACC</span></h4>
	</div>
</nav>
<nav class="sidebar">
	<div>
		<img src="avatar1.svg" class="user_icon"><br><br>
		<label class="name"><?php echo $_SESSION['username']; ?></label><br>
		<p class="user"><?php echo $_SESSION['accountType']; ?></p>
		<hr>
	</div>
		<ul>
		<?php 
		if($_SESSION['accountType'] == 'admin'){ ?>
			<li><a href="dashboard.php">Dashboard</a></li>
			<li><a href="myBook.php">My Books</a></li>
			<li><a href="#" class="acc-btn">Accounts</a>
			<ul class="sub-menu1">
				<li  class=""><a href="admin.php">Admin</a></li>
				<li class=""><a href="student.php">Students</a></li>
			</ul>
			<li><a href="book.php" class="">Books</a></li>
			<li><a href="#" class="tran-btn">Transaction</a>
			<ul class="sub-menu2">
				<li class=""><a href="issueBook.php">Issue Book</a></li>
				<li class=""><a href="returned-borrowed.php">Borrowed / Returned</a></li>
			</ul>
		<?php } 
		else{ ?>
				<li><a href="myBook.php">My Books</a></li>
				<li class=""><a href="issueBook.php">Explore Books</a></li>
				<li><a class="myAccount" value="<?php echo $_SESSION['accountId']; ?>" href="#">My Account</a></li>
		<?php } ?>
			</li>
			<li>
				<a href="logout.php">Logout</a>
			</li>
		</ul>
</nav>
	<script src = "js/sidebar_funtion.js"></script>
	<script src = "js/bootstrap.js"></script>
	<script type="text/javascript" src="DataTables-1.10.23/media/js/jquery.dataTables.min.js"></script>
	<script>
		$(document).ready(function() {
			$('#myTable').DataTable();
		} )
	</script>
	<script type = "text/javascript">
		$(document).ready(function(){
			$('#createAdmin').click(function(){
				$(this).hide();
				$('#showAdmin').show();
				$('#adminTable').slideUp();
				$('#adminForm').slideDown();
				$('#showAdmin').click(function(){
					$(this).hide();
					$('#createAdmin').show();
					$('#adminTable').slideDown();
					$('#adminForm').slideUp();
				});
			});
		});
	</script>
	<script type = "text/javascript">
		$(document).ready(function(){
			$result = $('<center><label>Deleting...</label></center>');
			$('.delete').click(function(){
				$id = $(this).attr('value');
				$accountType = "admin";
				$(this).parents('td').empty().append($result);
				$('.delete').attr('disabled', 'disabled');
				$('.delete').attr('disabled', 'disabled');
				setTimeout(function(){
					window.location = 'deleteAccount.php?id=' + $id + '&accountType=' +  $accountType;
				}, 1000);
			});
			$('.update').click(function(){
				$id = $(this).attr('value');
				$('#showAdmin').show();
				$('#showAdmin').click(function(){
					$(this).hide();
					$('#editForm').empty();
					$('#adminTable').show();
					$('#createAdmin').show();
				});
				$('#adminTable').fadeOut();
				$('#createAdmin').hide();
				$('#editForm').load('loadAdmin.php?id=' + $id);
			});
		});
	</script>
</body>
</html>
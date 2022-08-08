<?php
	include('security.php');
	if($_SESSION['accountType'] == 'student')
		header('Location: myBook.php');
	//get all the data in the student with the data in its foreign key
	$sql = "SELECT stu.id, stu.name, stu.course, stu.yearSection, stu.accountId, ac.username, ac.password, ac.accountType FROM student stu RIGHT JOIN account ac ON stu.accountId = ac.id WHERE accountType = 'student'";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$students = $stmt->fetchAll();
	
?>
<!DOCTYPE html>
<head>
	<title>Students</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="fontawesome-free-5.15.1-web/css/all.css">
	<link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="DataTables-1.10.23/media/css/jquery.dataTables.min.css"/>
	<script src = "js/jquery-3.5.1.min.js"></script>
</head>
<body>
<div class="container">
	<div class="greetings">
		<img src="student.svg" style="width: 250px; height: 120px;">
		<div class = "nav">Students</div>
	</div>
	<div class = "col-lg-1"></div>
		<div class = "col-lg-9 well" style = "margin-top:200px;margin-left:203px; border:1px solid #000066;  width: 1020px;">
				<button id = "createStudent" type = "button" class = "btn btn-primary"><span class="fas fa-user-plus"></span> Create Student</button>
				<button id = "showStudent" type = "button" style = "display:none;" class = "btn btn-success"><span class ="fas fa-arrow-alt-circle-left"></span> Back</button>
				<br />
				<br />
				<div id = "studentTable">
					<table id = "myTable" class = "table table-striped table-bordered">
						<thead style = "color: #fff; background-color: #000066;">
							<tr>
								<th>ID</th>
								<th>Name</th>
								<th>Course</th>
								<th>Year&Section</th>
								<th>Username</th>
								<th>Password</th>
								<th style="width: 180px">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach($students as $student){ ?>
							<tr>
								<td><?php echo $student->accountId; ?></td>
								<td><?php echo $student->name; ?></td>
								<td><?php echo $student->course; ?></td>
								<td><?php echo $student->yearSection; ?></td>
								<td><?php echo $student->username; ?></td>
								<td><?php echo $student->password; ?></td>
								<td><a class="btn btn-warning update" value="<?php echo $student->id;?>"><span class="fas fa-edit"></span> Update</a>
									<a class="btn btn-danger delete" value="<?php echo $student->accountId;?>"><span class ="fas fa-trash-alt"></span> Delete</a></td>
							</tr>
							<?php
							}
							?>
						</tbody>
					</table>
				</div>
		
		
			<div id = "editForm"></div>
			<div id = "studentForm" style="display: none;">
				<div class = "col-lg-3"></div>
				<div class = "col-lg-6">
					<form method = "POST" action = "createStudent.php" enctype = "multipart/form-data">
						<div class = "form-group">	
							<label>Name:</label>
							<input type = "text" required = "required" name = "name" class = "form-control" required/>
							<input type="hidden" name="accountType" id="name" value="student">
						</div>
						<div class = "form-group">	
							<label>Course:</label>
							<input type = "text" required = "required" name = "course" class = "form-control" required/>
						</div>
						<div class = "form-group">	
							<label>Year&Section:</label>
							<input type = "text" required = "required" name = "yearSection" class = "form-control" required/>
						</div>
						<div class = "form-group">
							<label>Username:</label>
							<input type = "text" required = "required" name = "username" class = "form-control" required/>
						</div>	
						<div class = "form-group">	
							<label>Password:</label>
							<input type = "password" maxlength = "12" name = "password" class = "form-control" required/>
						</div>
						<div class = "form-group">
						<label for="gender"> Gender: </label>
							<select name="gender">
								<option value="Male">Male</option>
								<option value="Female">Female</option>
							</select>
						</div>
						<div class = "form-group">	
							<button class = "btn btn-primary" name = "create_student"><span class="fas fa-download"></span> Create</button>
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
			$('#createStudent').click(function(){
				$(this).hide();
				$('#showStudent').show();
				$('#studentTable').slideUp();
				$('#studentForm').slideDown();
				$('#showStudent').click(function(){
					$(this).hide();
					$('#createStudent').show();
					$('#studentTable').slideDown();
					$('#studentForm').slideUp();
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
				$('#showStudent').show();
				$('#showStudent').click(function(){
					$(this).hide();
					$('#editForm').empty();
					$('#studentTable').show();
					$('#createStudent').show();
				});
				$('#studentTable').fadeOut();
				$('#createStudent').hide();
				$('#editForm').load('loadStudent.php?id=' + $id);
			});
		});
	</script>
</body>
</html>
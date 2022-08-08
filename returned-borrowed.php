<?php
	include('security.php');
	if($_SESSION['accountType'] == 'student')
		header('Location: myBook.php');
?>
<!DOCTYPE html>
<head>
	<title>Books</title>
	<link rel="stylesheet" href="fontawesome-free-5.15.1-web/css/all.css">
	<link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css" />
	<link rel = "stylesheet" type = "text/css" href = "css/chosen.min.css" />
	<link rel="stylesheet" type="text/css" href="DataTables-1.10.23/media/css/jquery.dataTables.min.css"/>
	<link rel="stylesheet" href="style.css">
	<script src = "js/jquery-3.5.1.min.js"></script>
</head>
<body>
<div class="container">
	<div class="greetings">
		<img src="transaction.svg" style="width: 250px; height: 120px;">
		<div class = "nav" style="font-size: 14px; width: 140px;">Transaction / Returning - Borrowed Last 5 days</div>
	</div>
	<div class = "col-lg-1"></div>
		<div class = "col-lg-9 well" style = "margin-top:200px;margin-left:203px; border:1px solid #000066;  width: 1020px;">
				<form method = "POST" action = "return.php" enctype = "multipart/form-data">	
					<table id = "myTable" class = "table table-striped table-bordered">
						<thead class = "alert-success">
							<tr>
								<th>Borrow ID</th>
								<th>Account</th>
								<th>Book Title</th>
								<th>Book Author</th>
								<th>Status</th>
								<th>Date Borrowed</th>
								<th>Expiration Date</th>
								<th>Date Returned</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$qReturn = $pdo->query("SELECT * FROM borrow borrow LEFT JOIN book book ON borrow.bookId = book.id LEFT JOIN account account ON borrow.accountId = account.id");
								while($fReturn = $qReturn->fetch()){
									date_default_timezone_set('Asia/Manila');
									$dateBorrowed = $fReturn->dateBorrowed;
									$today = date('Y-m-d H:i:s');
									$expiration = date('Y-m-d H:i:s', strtotime($dateBorrowed. '+2 days'));
									$duration = date('Y-m-d H:i:s', strtotime($dateBorrowed. '+5 days'));
									//lets display the books that has been borrowed only this past 5 days
									if($duration >= $today){
							?>
							<tr>
								<td>
									<?php
										echo $fReturn->borrowId;
									?>
								</td>
								<td>
									<?php
										echo $fReturn->username;
									?>
								</td>
								<td>
									<?php
										echo $fReturn->title;
									?>
								</td>
								<td>
									<?php
										echo $fReturn->author;
									?>
								</td>
								<td><?php echo $fReturn->status; ?></td>
								<td><?php echo $fReturn->dateBorrowed; ?></td>
								<td><?php
										if($today >= $expiration){
											echo "<center><label class = 'text-danger'>Expired</label></center>";
											//the book will expire after 2 days ,we then update the status in the borrowing table from borrowed to returned
											//$returnBook = $pdo->query("UPDATE borrow SET status = 'Returned', dateReturned = $expiration WHERE borrowId = $fReturn->borrowId");
											$sql = "UPDATE borrow SET dateReturned = ?, status = ? WHERE borrowId = ?";
											$stmt = $pdo->prepare($sql);
											$stmt->execute([$expiration, 'Returned', $fReturn->borrowId]);
										}
										else
											echo $expiration;
									?></td>
								<td>
									<?php 
										echo $fReturn->dateReturned;
									?>
								</td>
								<td>
								
									<?php 
										if($fReturn->status == 'Returned'){
										echo '<center><button disabled = "disabled" class = "btn btn-primary" type = "button" href = "#" data-toggle = "modal" data-target = "#return"><span class="fas fa-check-circle"></span> Returned</button></center>';	
										}else{
										echo '<center><a class="btn btn-primary return" value="'.$fReturn->borrowId.'"><span class="fas fa-undo-alt"></span> Return</a></center>';
										}
									?>
								</td>
							</tr>
							<?php
									}
								}
							?>
						</tbody>
					</table>
				</form>	
		
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
	<script src = "js/chosen.jquery.min.js"></script>	
	<script type="text/javascript" src="DataTables-1.10.23/media/js/jquery.dataTables.min.js"></script>

	<script type = "text/javascript">
		$(document).ready(function(){
			$('.return').click(function(){
				$id = $(this).attr('value');
				window.location = 'return.php?id=' + $id;
			});
		});
	</script>
	<script>
		$(document).ready(function() {
			$('#myTable').DataTable();
		} )
	</script>
</body>
</html>
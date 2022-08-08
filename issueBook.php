<?php
	include('security.php');
?>
<!DOCTYPE html>
<head>
	<title>Books</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="fontawesome-free-5.15.1-web/css/all.css">
	<link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css" />
	<link rel = "stylesheet" type = "text/css" href = "css/chosen.min.css" />
	<link rel="stylesheet" type="text/css" href="DataTables-1.10.23/media/css/jquery.dataTables.min.css"/>
	<script src = "js/jquery-3.5.1.min.js"></script>
</head>
<body>
<div class="container">
	<div class="greetings">
		<img src="book.svg" style="width: 250px; height: 120px;">
		<div class = "nav"><?php 
				if($_SESSION['accountType'] == 'admin')
					echo "Transaction / Issue Book";
				else
					echo "Borrow Books";
			?>
		</div>
	</div>
	<div class = "col-lg-1"></div>
		<div class = "col-lg-9 well" style = "margin-top:200px;margin-left:203px; border:1px solid #000066;  width: 1020px;">
			<button id = "showBooks" type = "button" style = "display:none;" class = "btn btn-success"><span class ="fas fa-arrow-alt-circle-left"></span> Back</button>
			<div id="books">
				<form method = "POST" action = "borrow.php" enctype = "multipart/form-data">
					<div class = "form-group pull-left">
					<?php
						if($_SESSION['accountType'] == 'admin'){
					?>
						<label>Accounts:</label>
						<br />
						<select name = "accountId" id = "account">
							<option value = "" selected = "selected" disabled = "disabled">Select an option</option>
							<?php
								$stmt = $pdo->query("SELECT * FROM account ORDER BY accountType");
								while($fBorrow = $stmt->fetch()){
							?>
								<option value = "<?php echo $fBorrow->id?>"><?php echo $fBorrow->username. " - " .$fBorrow->accountType;?></option>
							<?php
								}
							?>
						</select>
					<?php } 
						else{
					?>	
						
						<br>
						<label class="name"><?php echo $_SESSION['username']?></label>
						<br />
						<div style="display: none;">
						<select name = "accountId" id = "account">
							<option value = "<?php echo $_SESSION['accountId'];?>"></option>
						</select>
						</div>
					<?php } ?>
					</div>
					<div class = "form-group pull-right">
						<br>
						<button name = "save_borrow" class = "btn btn-primary"><span class="fas fa-thumbs-up"></span> Borrow</button>
					</div>
					<table id = "myTable" class = "table table-striped table-bordered">
						<thead class = "alert-success">
							<tr>
								<th>Select</th>
								<th>Book Title</th>
								<th>Subject</th>
								<th>Author</th>
								<th>Publisher</th>
								<th>Year Published</th>
								<th>Quantity</th>
								<th>Available</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							//get all the data in the book table with the data in its foreign key 
							$sql = "SELECT * FROM book b LEFT JOIN publisher p ON b.publisherId = p.publisherId RIGHT JOIN bookcount bc ON b.id = bc.bookId";
							$stmt = $pdo->prepare($sql);
							$stmt->execute();
							$books = $stmt->fetchAll();
							
							foreach($books as $book){
							
							$qBorrow = $pdo->query("SELECT SUM(qty) as total FROM borrow WHERE bookId = $book->id && status = 'Borrowed'");
							$borrowedQty = $qBorrow->fetch();
							$available = $book->totalNumber - $borrowedQty->total;
							?>
							<tr>
								<td>
									<?php
										if($available == 0){
											echo "<center><label class = 'text-danger'>Not Available</label></center>";
										}else{
											echo '<center><input type = "checkbox" name = "selector[]" value = "'.$book->id.'"></center>';
										}
									?>
								<td><?php echo $book->title; ?></td>
								<td><?php echo $book->subject; ?></td>
								<td><?php echo $book->author; ?></td>
								<td><?php echo $book->name; ?></td>
								<td><?php echo $book->yearPublished; ?></td>
								<td><?php echo $book->totalNumber; ?></td>
								<td><?php echo $available; ?></td>
								<td><a class="btn btn-success view" value="<?php echo $book->id	;?>"> View <span class="fas fa-arrow-alt-circle-right"></span></a></td>
							</tr>
							<?php
							}
							?>
						</tbody>
					</table>
				</form>	
			</div>
			
			<div id = "editForm"></div>
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
			$("#account").chosen({ width:"150px" });	
		})
	</script>
	<script>
		$(document).ready(function() {
			$('#myTable').DataTable();
		} )
	</script>

	<script type = "text/javascript">
		$(document).ready(function(){
			$('.myAccount').click(function(){
				$id = $(this).attr('value');
				$('#showBooks').show();
				$('#showBooks').click(function(){
					$(this).hide();
					$('#editForm').empty();
					$('#books').show();
				});
				$('#books').slideUp();
				$('#editForm').load('loadStudent.php?id=' + $id);
			});
		});
	</script>
		<script type = "text/javascript">
		$(document).ready(function(){
			$('.view').click(function(){
				$id = $(this).attr('value');
				$('#showBooks').show();
				$('#showBooks').click(function(){
					$(this).hide();
					$('#editForm').empty();
					$('#books').show();
				});
				$('#books').slideUp();
				$('#editForm').load('loadBook.php?id=' + $id);
			});
		});
	</script>
</body>
</html>
<?php
	include('security.php');
	//get all the data in the book table with the data in its foreign key 
	$sql = "SELECT * FROM book b LEFT JOIN publisher p ON b.publisherId = p.publisherId LEFT JOIN bookcount bc ON b.id = bc.bookId";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$books = $stmt->fetchAll();
	
?>
<!DOCTYPE html>
<head>
	<title>Books</title>
	<link rel="stylesheet" href="style.css">
	<link rel="stylesheet" href="fontawesome-free-5.15.1-web/css/all.css">
	<link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css" />
	<link rel="stylesheet" type="text/css" href="DataTables-1.10.23/media/css/jquery.dataTables.min.css"/>
	<script src = "js/jquery-3.5.1.min.js"></script>
</head>
<body>
<div class="container">
	<div class="greetings">
		<img src="book.svg" style="width: 250px; height: 120px;">
		<div class = "nav">Books</div>
	</div>
	<div class = "col-lg-1"></div>
		<div class = "col-lg-9 well" style = "margin-top:200px;margin-left:203px; border:1px solid #000066;  width: 1020px;">
				<button id = "addBook" type = "button" class = "btn btn-primary"><span class="fas fa-plus-circle"></span> Add Book</button>
				<button id = "showBook" type = "button" style = "display:none;" class = "btn btn-success"><span class="fas fa-arrow-alt-circle-left"></span> Back</button>
				<br />
				<br />
				<div id = "bookTable">
					<table id = "myTable" class = "table table-striped table-bordered">
						<thead class = "alert-success">
							<tr>
								<th>Book Title</th>
								<th>Subject</th>
								<th>Author</th>
								<th>Publisher</th>
								<th>Year Published</th>
								<th>Quantity</th>
								<th style="width: 180px">Action</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach($books as $book){ ?>
							<tr>
								<td><?php echo $book->title; ?></td>
								<td><?php echo $book->subject; ?></td>
								<td><?php echo $book->author; ?></td>
								<td><?php echo $book->name; ?></td>
								<td><?php echo $book->yearPublished; ?></td>
								<td><?php echo $book->totalNumber; ?></td>
								<td><a class="btn btn-warning update" value="<?php echo $book->id;?>"><span class="fas fa-edit"></span> Update</a>
									<a class="btn btn-danger delete" value="<?php echo $book->id;?>"><span class="fas fa-trash-alt"></span> Delete</a></td>
							</tr>
							<?php
							}
							?>
						</tbody>
					</table>
				</div>
		
		
			<div id = "editBook"></div>
			<div id = "bookForm" style="display: none;">
				<div class = "col-lg-3"></div>
				<div class = "col-lg-6">
					<form method = "POST" action = "createBook.php" enctype = "multipart/form-data">
						<div class = "form-group">	
							<label>Book Title:</label>
							<input type = "text" required = "required" name = "title" class = "form-control" required/>
						</div>
						<div class = "form-group">	
							<label>Subject:</label>
							<input type = "text" required = "required" name = "subject" class = "form-control" required/>
						</div>
						<div class = "form-group">	
							<label>Author:</label>
							<input type = "text" required = "required" name = "author" class = "form-control" required/>
						</div>
						<div class = "form-group">
							<label>Publisher:</label>
							<input type = "text" required = "required" name = "publisher" class = "form-control" required/>
						</div>	
						<div class = "form-group">	
							<label>Year Published:</label>
							<input type = "number" name = "yearPublished" class = "form-control" required/>
						</div>
						<div class = "form-group">
						<label>Quantity:</label>
							<input type = "number" name = "qty" required = "required" class = "form-control" />
						</div>
						<div class = "form-group">	
							<button class = "btn btn-primary" name = "create_book"><span class="fas fa-download"></span> Create</button>
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
			$('#addBook').click(function(){
				$(this).hide();
				$('#showBook').show();
				$('#bookTable').slideUp();
				$('#bookForm').slideDown();
				$('#showBook').click(function(){
					$(this).hide();
					$('#addBook').show();
					$('#bookTable').slideDown();
					$('#bookForm').slideUp();
				});
			});
		});
	</script>
	<script type = "text/javascript">
		$(document).ready(function(){
			$result = $('<center><label>Deleting...</label></center>');
			$('.delete').click(function(){
				$id = $(this).attr('value');
				$(this).parents('td').empty().append($result);
				$('.delete').attr('disabled', 'disabled');
				$('.delete').attr('disabled', 'disabled');
				setTimeout(function(){
					window.location = 'deleteBook.php?id=' + $id;
				}, 1000);
			});
			$('.update').click(function(){
				$id = $(this).attr('value');
				$('#showBook').show();
				$('#showBook').click(function(){
					$(this).hide();
					$('#editBook').empty();
					$('#bookTable').show();
					$('#addBook').show();
				});
				$('#bookTable').fadeOut();
				$('#addBook').hide();
				$('#editBook').load('loadBook.php?id=' + $id);
			});
		});
	</script>
</body>
</html>
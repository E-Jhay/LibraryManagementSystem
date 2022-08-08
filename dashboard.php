<?php
	include('security.php');
	if($_SESSION['accountType'] == 'student')
		header('Location: myBook.php');
?>
<!DOCTYPE html>
<head>
	<title>Dashboard</title>
	<link rel="stylesheet" href="style.css">
	<link rel = "stylesheet" type = "text/css" href = "css/bootstrap.css" />
	<script src = "js/jquery-3.5.1.min.js"></script>
</head>
<body>
<div class="container">
	<div class="greetings">
		<img class="headerPhoto" src="hello.svg" style="width: 250px; height: 120px;">
		<div class="dashboardNav">DashBoard</div>
	</div>
	<div class="card" id="status">
	<?php 
			$sql = "SELECT * FROM admin";
			$admin = $pdo->prepare($sql);
			$admin->execute();
			
			$sql1 = "SELECT * FROM student";
			$student = $pdo->prepare($sql1);
			$student->execute();
			
			$allBooks = "SELECT SUM(totalNumber) as totalBooks FROM bookcount";
			$allBookQuery = $pdo->prepare($allBooks);
			$allBookQuery->execute();
			$booksTotal = $allBookQuery->fetch();
			
			$qBorrow = $pdo->query("SELECT SUM(qty) as totalBorrowed FROM borrow WHERE status = 'Borrowed'");
			$borrowedQty = $qBorrow->fetch();
			$available = $booksTotal->totalBooks - $borrowedQty->totalBorrowed;
			
			$qRecentBorrow = $pdo->query("SELECT * FROM borrow");
			$fBooks = $qRecentBorrow->fetchAll();
			date_default_timezone_set('Asia/Manila');
			$today = date("Y-m-d H:i:s");
			$recentBorrowedBooks = 0;
			foreach($fBooks as $fBook){
				$dateBorrowed = $fBook->dateBorrowed;
				$duration = date('Y-m-d H:i:s', strtotime($dateBorrowed. '+2 days'));
				if($duration >= $today)
					$recentBorrowedBooks++;
			}
			
			$qRecentStudent = $pdo->query("SELECT * FROM account WHERE accountType = 'student'");
			$fStudents = $qRecentStudent->fetchAll();
			date_default_timezone_set('Asia/Manila');
			$today = date("Y-m-d H:i:s");
			$recentCreatedStudents = 0;
			foreach($fStudents as $fStudent){
				$dateCreated = $fStudent->dateCreated;
				$duration = date('Y-m-d H:i:s', strtotime($dateCreated. '+2 days'));
				if($duration >= $today)
					$recentCreatedStudents++;
			}
		?>
		<strong>Status Report</strong><br><br>
		Number of Books borrowed past 2 days: <span class="numbers"><?php echo $recentBorrowedBooks; ?></span><br><br>	
		Number of created students past 2 days: <span class="numbers"><?php echo $recentCreatedStudents; ?></span>
	</div>
	<div class="card" id="card1">
		<div class="card-inner">
		<a href="student.php"><p>Number of students</p>
		<span class="numbers"><?php echo $student->rowCount(); ?></span></a>
		</div>
	</div>
		
	<div class="card" id="card2">
		<div class="card-inner">
		<a href="admin.php"><p>Number of admins</p>
		<span class="numbers"><?php echo $admin->rowCount(); ?></span></a>
		</div>
	</div>
		
	<div class="card" id="card3">
		<div class="card-inner">
		<a href="book.php"><p>Number of books</p>
		<span class="numbers"><?php echo $booksTotal->totalBooks; ?></span></a>
		</div>
	</div>
	
	<div class="card" id="card4">
		<div class="card-inner">
		<a href="issueBook.php"><p>Number of available books</p>
		<span class="numbers"><?php echo $available; ?></span></a>
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
</body>
</html>
<?php
	include('security.php');
	if(!isset($_POST['accountId'])){	
		echo '
			<script type = "text/javascript">
				alert("Select account first");
				window.location = "issueBook.php";
			</script>
		';
	}else{
		if(!isset($_POST['selector'])){
			echo '
				<script type = "text/javascript">
					alert("Selet a book first!");
					window.location = "issueBook.php";
				</script>
			';
		}else{
			foreach($_POST['selector'] as $key=>$value){
				$bookQty = 1;
				$accountId = $_POST['accountId'];
				$bookId = $value;
				date_default_timezone_set('Asia/Manila');
				$dateBorrowed = date("Y-m-d H:i:s");
				$borrowedAlready = $pdo->query("SELECT * FROM borrow WHERE bookId = $bookId && accountId = $accountId && status = 'Borrowed'");
				//check if the book is already borrowed by the same account
				if($borrowedAlready->rowCount() == 1){
					echo '
						<script type = "text/javascript">
							alert("Account already have this book");
							window.location = "issueBook.php";
						</script>
					';
				}
				else{
					$sql = "INSERT INTO borrow (bookId, accountId, dateBorrowed, qty, status) VALUE(?, ?, ?, ?, ?)";
					$stmt = $pdo->prepare($sql);
					$stmt->execute([$bookId, $accountId, $dateBorrowed, $bookQty, 'Borrowed']);
					
					echo '
						<script type = "text/javascript">
							alert("Book Successfully Borrowed with 2 days validity");
							window.location = "issueBook.php";
						</script>
					';
				}
			}
		}
	}
<?php
	include('security.php');
	if(isset($_POST['update'])){
		$bookId = $_POST['bookId'];
		$title = $_POST['title'];
		$subject = $_POST['subject'];
		$author = $_POST['author'];
		$publisherName = $_POST['publisher'];
		$yearPublished = $_POST['yearPublished'];
		$qty = $_POST['qty'];
		
		$qPublisher = "SELECT * FROM publisher WHERE name = ?";
		$stmt = $pdo->prepare($qPublisher);
		$stmt->execute([$publisherName]);
		$publisher = $stmt->fetch();
		//checks if the publisher is already in the database
		if($stmt->rowCount() == 1){
			//if its in the database, we'll use it as a foreign key
			$sql = "UPDATE book SET title = ?, subject = ?, author = ?, publisherId = ?, yearPublished = ? WHERE id = ?";
			$stmt = $pdo->prepare($sql);
			$stmt->execute([$title, $subject, $author, $publisher->publisherId, $yearPublished, $bookId]);
			$sql = "UPDATE bookcount SET totalNumber = ? WHERE bookId = ?";
			$stmt = $pdo->prepare($sql);
			$stmt->execute([$qty, $bookId]);
			echo '
				<script type = "text/javascript">
					alert("Book Updated Successfully");
					window.location = "book.php";
				</script>
			';
			
		}
		else{
			// if the publisher is not in the database, we'll store it as a new publisher
			$sql1 = "INSERT INTO publisher (name) VALUE(?)";
			$stmt1 = $pdo->prepare($sql1);
			$stmt1->execute([$publisherName]);
			//get the last created id in the publisher table
			$lastPublisherId = $pdo->lastInsertId();
			
			$sql = "UPDATE book SET title = ?, subject = ?, author = ?, publisherId = ?, yearPublished = ? WHERE id = ?";
			$stmt = $pdo->prepare($sql);
			$stmt->execute([$title, $subject, $author, $publisher->publisherId, $yearPublished, $bookId]);
			$sql = "UPDATE bookcount SET totalNumber = ? WHERE bookId = ?";
			$stmt = $pdo->prepare($sql);
			$stmt->execute([$qty, $bookId]);
			echo '
				<script type = "text/javascript">
					alert("Book Updated Successfully");
					window.location = "book.php";
				</script>
			';
		}
		
	}
	
?>
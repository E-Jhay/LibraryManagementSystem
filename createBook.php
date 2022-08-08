<?php
	include('security.php');
		
	// if the submit button's been clicked, we need to process the inputs
	if(isset($_POST['create_book'])){
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
		//if publisher is already in the database we'll gonna use it as a foreign key
		if($stmt->rowCount() == 1){
			$sql = "INSERT INTO book (title, subject, author, publisherId, yearPublished) VALUE(?, ?, ?, ?, ?)";
			$stmt = $pdo->prepare($sql);
			$stmt->execute([$title, $subject, $author, $publisher->publisherId, $yearPublished]);
			//lastId stores the last created id of the query
			$lastId = $pdo->lastInsertId();
			//insert the quantity in bookcount in a separate query
			$sql = "INSERT INTO bookcount (bookId, totalNumber) VALUE(?, ?)";
			$stmt = $pdo->prepare($sql);
			$stmt->execute([$lastId, $qty]);
			
			echo '
				<script type = "text/javascript">
					alert("Book Added Successfully");
					window.location = "book.php";
				</script>
			';
			
		}
		else{
			//if the publisher is not yet in the database we will then create another row in the publisher table
			$sql1 = "INSERT INTO publisher (name) VALUE(?)";
			$stmt1 = $pdo->prepare($sql1);
			$stmt1->execute([$publisherName]);
			//lastId stores the last created id of the query
			$lastPublisherId = $pdo->lastInsertId();;
			
			$sql = "INSERT INTO book (title, subject, author, publisherId, yearPublished) VALUE(?, ?, ?, ?, ?)";
			$stmt = $pdo->prepare($sql);
			$stmt->execute([$title, $subject, $author, $lastPublisherId, $yearPublished]);
			//get the last book id created
			$lastBookId = $pdo->lastInsertId();
			$sql = "INSERT INTO bookcount (bookId, totalNumber) VALUE(?, ?)";
			$stmt = $pdo->prepare($sql);
			$stmt->execute([$lastBookId, $qty]);
			echo '
				<script type = "text/javascript">
					alert("Book Added Successfully");
					window.location = "book.php";
				</script>
			';
		}
	}
?>
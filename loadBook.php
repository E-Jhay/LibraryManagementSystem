<?php
	
	include('security.php');
	if(isset($_GET['id'])){
		$bookId = $_GET['id'];
		//write sql query
		$sql = "SELECT * FROM book b LEFT JOIN publisher p ON b.publisherId = p.publisherId RIGHT JOIN bookcount bc ON b.id = bc.bookId WHERE id = ?";
		$stmt = $pdo->prepare($sql);
		$stmt->execute([$bookId]);
		$book = $stmt->fetch();
		
		
		if($book){
			$bookId = $book->id;
			$title = $book->title;
			$subject = $book->subject;
			$author = $book->author;
			$publisherName = $book->name;
			$yearPublished = $book->yearPublished;
			$qty = $book->totalNumber;
		}
		else{
			//if the 'id' value is not valid, goes back to view page
			header('location: book.php');
		}
		
	}

?>

<?php 
if($_SESSION['accountType'] == 'admin'){ 
?>
<div class = "col-lg-3"></div>
	<div class = "col-lg-6">
	<form method = "POST" action = "update_book_query.php" enctype = "multipart/form-data">
		<div class = "form-group">	
			<label>Book Title:</label>
			<input type = "text" name = "title" value="<?php echo $title;?>" class = "form-control" />
			<input type="hidden" name="bookId" value="<?php echo $bookId; ?>">
		</div>
		<div class = "form-group">	
			<label>Subject:</label>
			<input type = "text" name = "subject" value="<?php echo $subject; ?>" class = "form-control" />
		</div>
		<div class = "form-group">	
			<label>Author:</label>
			<input type = "text" name = "author" value="<?php echo $author; ?>" class = "form-control" />
		</div>
		<div class = "form-group">
			<label>Publisher:</label>
			<input type = "text" name = "publisher" value="<?php echo $publisherName; ?>" class = "form-control" />
		</div>	
		<div class = "form-group">	
			<label>Year Published:</label>
			<input type = "number" name = "yearPublished" value="<?php echo $yearPublished; ?>" class = "form-control" />
		</div>
		<div class = "form-group">
			<label>Quantity:</label>
			<input type = "number" name = "qty" value="<?php echo $qty; ?>" class = "form-control" />
		</div>
		<div class = "form-group">	
			<button class = "btn btn-warning" name = "update"><span class="fas fa-download"></span> Save Changes</button>
		</div>
	</form>		
</div>
<?php } 
else{
?>
<div class = "col-lg-3"></div>
	<div class = "col-lg-6">
	<form method = "POST" action = "update_book_query.php" enctype = "multipart/form-data">
		<div class = "form-group">	
			<label>Book Title:</label>
			<input type = "text" name = "title" value="<?php echo $title;?>" class = "form-control" readonly>
			<input type="hidden" name="bookId" value="<?php echo $bookId; ?>">
		</div>
		<div class = "form-group">	
			<label>Subject:</label>
			<input type = "text" name = "subject" value="<?php echo $subject; ?>" class = "form-control" readonly>
		</div>
		<div class = "form-group">	
			<label>Author:</label>
			<input type = "text" name = "author" value="<?php echo $author; ?>" class = "form-control" readonly>
		</div>
		<div class = "form-group">
			<label>Publisher:</label>
			<input type = "text" name = "publisher" value="<?php echo $publisherName; ?>" class = "form-control" readonly>
		</div>	
		<div class = "form-group">	
			<label>Year Published:</label>
			<input type = "number" name = "yearPublished" value="<?php echo $yearPublished; ?>" class = "form-control" readonly>
		</div>
		<div class = "form-group">
			<label>Quantity:</label>
			<input type = "number" name = "qty" value="<?php echo $qty; ?>" class = "form-control" readonly>
		</div>
	</form>		
</div>	
<?php } ?>
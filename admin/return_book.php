<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Return Book</title>
	<meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
	<link rel="stylesheet" type="text/css" href="../bootstrap-4.4.1/css/bootstrap.min.css">
  	<script type="text/javascript" src="../bootstrap-4.4.1/js/jquery_latest.js"></script>
  	<script type="text/javascript" src="../bootstrap-4.4.1/js/bootstrap.min.js"></script>

	<script type="text/javascript">
		// Function to fetch book details when book name is entered
		function getBookDetails() {
			var bookName = document.getElementById('book_name').value;
			if (bookName !== "") {
				var xhr = new XMLHttpRequest();
				xhr.open('POST', 'fetch_book_details.php', true);
				xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
				xhr.onreadystatechange = function() {
					if (xhr.readyState == 4 && xhr.status == 200) {
						var data = JSON.parse(xhr.responseText);
						if (data.success) {
							document.getElementById('isbn_no').value = data.isbn_no;
							document.getElementById('book_author').value = data.author_name;
						} else {
							alert("Book details not found!");
						}
					}
				};
				xhr.send('book_name=' + bookName);
			}
		}
	</script>
</head>
<body>
	<!-- Navbar code here -->
	<center><h4 style="color:blue;"><b>Return Book</b></h4><br></center>
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<form action="" method="post">
				<div class="form-group">
					<label for="book_name"><b>Book Name:</b></label>
					<input type="text" id="book_name" name="book_name" class="form-control" onkeyup="getBookDetails()" required>
				</div>
				<div class="form-group">
					<label for="book_author"><b>Author Name:</b></label>
					<input type="text" id="book_author" name="book_author" class="form-control" readonly>
				</div>
				<div class="form-group">
					<label for="isbn_no"><b>ISBN Number:</b></label>
					<input type="number" id="isbn_no" name="isbn_no" class="form-control" readonly>
				</div>
				<div class="form-group">
					<label for="user_id"><b>User ID:</b></label>
					<input type="text" name="user_id" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="return_date"><b>Return Date:</b></label>
					<input type="date" name="return_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" required>
				</div>
				<button type="submit" name="return_book" class="btn btn-primary">Return Book</button>
			</form>
		</div>
		<div class="col-md-4"></div>
	</div>
</body>
</html>

<?php
	if(isset($_POST['return_book']))
	{
		$connection = mysqli_connect("localhost", "root", "");
		$db = mysqli_select_db($connection, "lms");

		// Sanitize user input
		$isbn_no = mysqli_real_escape_string($connection, $_POST['isbn_no']);
		$book_name = mysqli_real_escape_string($connection, $_POST['book_name']);
		$book_author = mysqli_real_escape_string($connection, $_POST['book_author']);
		$user_id = mysqli_real_escape_string($connection, $_POST['user_id']);
		$return_date = mysqli_real_escape_string($connection, $_POST['return_date']);

		if(!empty($book_author)) {
			$query = "INSERT INTO returned_books VALUES (null, '$isbn_no', '$book_name', '$book_author', '$user_id', 1, '$return_date')";
			$query_run = mysqli_query($connection, $query);

			if ($query_run) {
				echo '<script>window.onload = function() { alert("Book Returned successfully..."); }</script>';
			} else {
				echo '<script>window.onload = function() { alert("Failed to Return Book"); }</script>';
			}
		} else {
			echo '<script>window.onload = function() { alert("Author name cannot be empty"); }</script>';
		}
	}
?>

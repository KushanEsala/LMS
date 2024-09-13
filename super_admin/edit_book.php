<?php
	session_start();
	// Fetch data from database
	$connection = mysqli_connect("localhost", "root", "");
	$db = mysqli_select_db($connection, "lms");
	$book_name = "";
	$isbn_no = "";
	$author_name = "";
	$cat_name = "";
	$book_price = "";
	$query = "SELECT * FROM books WHERE isbn_no = '$_GET[bn]'";
	$query_run = mysqli_query($connection, $query);
	while ($row = mysqli_fetch_assoc($query_run)) {
		$book_name = $row['book_name'];
		$isbn_no = $row['isbn_no'];
		$author_name = $row['author_name'];
		$cat_name = $row['cat_name'];
		$book_price = $row['book_price'];
		$book_quantity = $row['book_quantity'];
		$book_availability = $row['book_availability'];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Edit Book</title>
	<meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
	<link rel="stylesheet" type="text/css" href="../bootstrap-4.4.1/css/bootstrap.min.css">
  	<script type="text/javascript" src="../bootstrap-4.4.1/js/juqery_latest.js"></script>
  	<script type="text/javascript" src="../bootstrap-4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="super_admin_dashboard.php" style="color: yellow;">Library Management System (LMS)</a>
			</div>
			<font style="color: white"><span><strong>Welcome: <?php echo $_SESSION['name']; ?></strong></span></font>
			<font style="color: white"><span><strong>Email: <?php echo $_SESSION['email']; ?></strong></font>
		    <ul class="nav navbar-nav navbar-right">
		      <li class="nav-item dropdown">
	        	<a class="nav-link dropdown-toggle" data-toggle="dropdown"><b>My Profile</b></a>
	        	<div class="dropdown-menu">
	        		<a class="dropdown-item" href="view_profile.php"><b>View Profile</b></a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="edit_profile.php"><b>Edit Profile</b></a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="change_password.php"><b>Change Password</b></a>
	        	</div>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="../logout.php" style="color: red;"><b>Logout</b></a>
		      </li>
		    </ul>
		</div>
	</nav><br>
	<span><marquee><b>Library Management System | Brought to you by <span style="color: red;">Tech Alliance</span>.</b></marquee></span><br><br>
	<center><h4 style="color: blue;"><b>Edit Book</b></h4><br></center>
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<form action="" method="post">
				<div class="form-group">
					<label for="isbn_no"><b>ISBN Number:</b></label>
					<input type="text" name="isbn_no" value="<?php echo $isbn_no; ?>" class="form-control" disabled required>
				</div>
				<div class="form-group">
					<label for="book_name"><b>Book Name:</b></label>
					<input type="text" name="book_name" value="<?php echo $book_name; ?>" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="author_name"><b>Author Name:</b></label>
					<input type="text" name="author_name" value="<?php echo $author_name; ?>" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="cat_name"><b>Category Name:</b></label>
					<input type="text" name="cat_name" value="<?php echo $cat_name; ?>" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="book_price"><b>Book Price:</b></label>
					<input type="text" name="book_price" value="<?php echo $book_price; ?>" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="book_quantity"><b>Book Quantity:</b></label>
					<input type="text" name="book_quantity" value="<?php echo $book_quantity; ?>" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="book_availability"><b>Book Availability:</b></label>
					<input type="text" name="book_availability" value="<?php echo $book_availability; ?>" class="form-control" required>
				</div>
				<button type="submit" name="update" class="btn btn-primary">Update Book</button>
				<button type="reset" name="reset" class="btn btn-success">Reset</button>
				<button type="button" name="cancel" class="btn btn-danger" onclick="window.location.href='manage_book.php';">Cancel</button>
			</form>
		</div>
		<div class="col-md-4"></div>
	</div>
</body>
</html>

<?php
	if (isset($_POST['update'])) {
		$connection = mysqli_connect("localhost", "root", "");
		$db = mysqli_select_db($connection, "lms");
		$query = "UPDATE books SET book_name = '$_POST[book_name]', author_name = '$_POST[author_name]', cat_id = '$_POST[cat_id]', book_price = '$_POST[book_price]', book_quantity = '$_POST[book_quantity]', book_availability = '$_POST[book_availability]' WHERE isbn_no = '$_GET[bn]'";
		$query_run = mysqli_query($connection, $query);

		if ($query_run) {
			echo '<script>window.onload = function() { alert("Book updated successfully..."); window.location.href="manage_book.php"; }</script>';
		} else {
			echo '<script>window.onload = function() { alert("Error updating book"); }</script>';
		}
	}
?>

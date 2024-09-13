<?php
	require("functions.php");
	session_start();
	#fetch data from database
	$connection = mysqli_connect("localhost","root","");
	$db = mysqli_select_db($connection,"lms");
	$name = "";
	$email = "";
	$mobile = "";
	$query = "select * from super_admin where email = '$_SESSION[email]'";
	$query_run = mysqli_query($connection,$query);
	while ($row = mysqli_fetch_assoc($query_run)){
		$name = $row['name'];
		$email = $row['email'];
		$mobile = $row['mobile'];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add New Book</title>
	<meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
	<link rel="stylesheet" type="text/css" href="../bootstrap-4.4.1/css/bootstrap.min.css">
  	<script type="text/javascript" src="../bootstrap-4.4.1/js/juqery_latest.js"></script>
  	<script type="text/javascript" src="../bootstrap-4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="super_admin_dashboard.php"style=color:yellow;>Library Management System (LMS)</style></a>
			</div>
			<font style="color: white"><span><strong>Welcome: <?php echo $_SESSION['name'];?></strong></span></font>
			<font style="color: white"><span><strong>Email: <?php echo $_SESSION['email'];?></strong></font>
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
		        <a class="nav-link" href="../logout.php"style=color:red;><b>Logout</b></style></a>
		      </li>
		    </ul>
		</div>
	</nav><br>
	<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd">
		<div class="container-fluid">
			
		    <ul class="nav navbar-nav navbar-center">
		      <li class="nav-item">
		        <a class="nav-link" href="super_admin_dashboard.php"><b>Dashboard</b></a>
		      </li>
		      <li class="nav-item dropdown">
	        	<a class="nav-link dropdown-toggle" data-toggle="dropdown"><b>Books </b></a>
	        	<div class="dropdown-menu">
	        		<a class="dropdown-item" href="add_book.php"><b>Add New Book</b></a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="manage_book.php"><b>Manage Books</b></a>
	        	</div>
		      </li>
		      <li class="nav-item dropdown">
	        	<a class="nav-link dropdown-toggle" data-toggle="dropdown"><b>Category </b></a>
	        	<div class="dropdown-menu">
	        		<a class="dropdown-item" href="add_cat.php"><b>Add New Category</b></a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="manage_cat.php"><b>Manage Category</b></a>
	        	</div>
		      </li>
		      <li class="nav-item dropdown">
	        	<a class="nav-link dropdown-toggle" data-toggle="dropdown"><b>Authors</b></a>
	        	<div class="dropdown-menu">
	        		<a class="dropdown-item" href="add_author.php"><b>Add New Author</b></a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="manage_author.php"><b>Manage Author</b></a>
	        	</div>
		      </li>
			  <li class="nav-item dropdown">
	        	<a class="nav-link dropdown-toggle" data-toggle="dropdown"><b>Staff </b></a>
	        	<div class="dropdown-menu">
	        		<a class="dropdown-item" href="add_staff.php"><b>Add New Member</b></a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="manage_staff.php"><b>Manage Members</b></a>
	        	</div>
		      </li>
	          <li class="nav-item">
		        <a class="nav-link" href="issue_book.php"><b>Issue Book</b></a>
		      </li>
			  <li class="nav-item">
		        <a class="nav-link" href="return_book.php"><b>Return Book</b></a>
		      </li>
		    </ul>
		</div>
	</nav><br>
	<span><marquee><b>Library Management System|Brought to you by <span style=color:red;>Tech Alliance</style>.</b></marquee></span><br><br>
		<center><h4 style=color:blue;><u>Add a new Book</u></style></h4><br></center>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<form action="" method="post">
					<div class="form-group">
						<label for="email"><b>Book Name:</b></label>
						<input type="text" name="book_name" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="mobile"><b>Author ID:</b></label>
						<input type="number" name="book_author" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="mobile"><b>Category ID:</b></label>
						<input type="number" name="book_category" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="mobile"><b>ISBN Number:</b></label>
						<input type="number" name="isbn_no" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="mobile"><b>Book Price:</b></label>
						<input type="text" name="book_price" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="mobile"><b>Book Quantity:</b></label>
						<input type="number" name="book_quantity" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="mobile"><b>Book Availability:</b></label>
						<input type="number" name="book_availability" class="form-control" required>
					</div>
					<button type="submit" name="add_book" class="btn btn-primary">Add Book</button>
					<button type="cancel" name="cancel" class="btn btn-danger">Cancel</button>
				</form>
			</div>
			<div class="col-md-4"></div>
		</div>
</body>
</html>
<?php
if (isset($_POST['add_book'])) {
    $connection = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($connection, "lms");

    $book_name = mysqli_real_escape_string($connection, $_POST['book_name']);
    $book_author = mysqli_real_escape_string($connection, $_POST['book_author']);
    $book_category = mysqli_real_escape_string($connection, $_POST['book_category']);
    $isbn_no = mysqli_real_escape_string($connection, $_POST['isbn_no']);
    $book_price = mysqli_real_escape_string($connection, $_POST['book_price']);
	$book_quantity = mysqli_real_escape_string($connection, $_POST['book_quantity']);
	$book_availability = mysqli_real_escape_string($connection, $_POST['book_availability']);

    $query = "INSERT INTO `books`(`book_name`, `author_id`, `cat_id`, `isbn_no`, `book_price`,`book_quantity`, `book_availability`) VALUES ('$book_name', '$book_author', '$book_category', '$isbn_no', '$book_price','$book_quantity', '$book_availability')";
    
    $query_submition = mysqli_query($connection, $query);

    if ($query_submition) {
        echo '<script>window.onload = function() { alert("Book added successfully..."); }</script>';
    } else {
        echo '<script>window.onload = function() { alert("Error adding Book"); }</script>';
    }
}
?>


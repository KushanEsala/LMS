<?php
	session_start();
	#fetch data from database
	$connection = mysqli_connect("localhost","root","");
	$db = mysqli_select_db($connection,"lms");
	$book_name = "";
	$book_no = "";
	$author_id = "";
	$cat_id = "";
	$book_price = "";
	$query = "select * from books where isbn_no = $_GET[bn]";
	$query_run = mysqli_query($connection,$query);
	while ($row = mysqli_fetch_assoc($query_run)){
		$book_name = $row['book_name'];
		$isbn_no = $row['isbn_no'];
		$author_id = $row['author_id'];
		$cat_id = $row['cat_id'];
		$book_price = $row['book_price'];
		$book_quantity = $row['book_quantity'];
		$book_availability = $row['book_availability'];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
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
	<span><marquee><b>Library Management System|Brought to you by <span style=color:red;>Tech Alliance</style>.</b></marquee></span><br><br>
		<center><h4 style=color:blue;><u>Edit Book</u></style></h4><br></center>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<form action="" method="post">
					<div class="form-group">
						<label for="mobile"><b>ISBN Number:</b></label>
						<input type="text" name="isbn_no" value="<?php echo $isbn_no;?>" class="form-control" disabled required>
					</div>
					<div class="form-group">
						<label for="email"><b>Book Name:</b></label>
						<input type="text" name="book_name" value="<?php echo $book_name;?>" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="mobile"><b>Author ID:</b></label>
						<input type="text" name="author_id" value="<?php echo $author_id;?>" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="mobile"><b>Category ID:</b></label>
						<input type="text" name="cat_id" value="<?php echo $cat_id;?>" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="mobile"><b>Book Price:</b></label>
						<input type="text" name="book_price" value="<?php echo $book_price;?>" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="mobile"><b>Book Quantity:</b></label>
						<input type="text" name="book_quantity" value="<?php echo $book_quantity;?>" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="mobile"><b>Book Availability:</b></label>
						<input type="text" name="book_availability" value="<?php echo $book_availability;?>" class="form-control" required>
					</div>
					<button type="submit" name="update" class="btn btn-primary">Update Book</button>
					<button type="refresh" name="refresh" class="btn btn-success">Refresh</button>
					<button type="cancel" name="cancel" class="btn btn-danger">Cancel</button>
				</form>
			</div>
			<div class="col-md-4"></div>
		</div>
</body>
</html>
<?php
	if(isset($_POST['update'])){
		$connection = mysqli_connect("localhost","root","");
		$db = mysqli_select_db($connection,"lms");
		$query = "update books set book_name = '$_POST[book_name]',author_id = $_POST[author_id],cat_id = $_POST[cat_id],book_price = $_POST[book_price],book_quantity = $_POST[book_quantity],book_availability=$_POST[book_availability] where isbn_no = $_GET[bn]";
		$query_run = mysqli_query($connection,$query);
		

		if ($query_run) {
			echo '<script>window.onload = function() { alert("Book Update successfully..."); }</script>';
		} else {
			echo '<script>window.onload = function() { alert("Error Updating Book"); }</script>';
		}
	}
	
?>
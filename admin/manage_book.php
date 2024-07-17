<?php
	require("functions.php");
	session_start();
	// Fetch data from database
	$connection = mysqli_connect("localhost", "root", "");
	$db = mysqli_select_db($connection, "lms");
	$name = "";
	$email = "";
	$mobile = "";
	$query = "SELECT * FROM admins WHERE email = '$_SESSION[email]'";
	$query_run = mysqli_query($connection, $query);
	while ($row = mysqli_fetch_assoc($query_run)) {
		$name = $row['name'];
		$email = $row['email'];
		$mobile = $row['mobile'];
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Manage Book</title>
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../bootstrap-4.4.1/css/bootstrap.min.css">
  	<script type="text/javascript" src="../bootstrap-4.4.1/js/juqery_latest.js"></script>
  	<script type="text/javascript" src="../bootstrap-4.4.1/js/bootstrap.min.js"></script>
  	<script type="text/javascript">
  		function alertMsg() {
  			alert("Book added successfully...");
  			window.location.href = "admin_dashboard.php";
  		}
  	</script>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="admin_dashboard.php" style="color: yellow;">Library Management System (LMS)</a>
			</div>
			<font style="color: white;"><span><strong>Welcome: <?php echo $_SESSION['name']; ?></strong></span></font>
			<font style="color: white;"><span><strong>Email: <?php echo $_SESSION['email']; ?></strong></font>
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
	<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd">
		<div class="container-fluid">
		    <ul class="nav navbar-nav navbar-center">
		      <li class="nav-item">
		        <a class="nav-link" href="admin_dashboard.php"><b>Dashboard</b></a>
		      </li>
		      <li class="nav-item dropdown">
	        	<a class="nav-link dropdown-toggle" data-toggle="dropdown"><b>Books</b></a>
	        	<div class="dropdown-menu">
	        		<a class="dropdown-item" href="add_book.php"><b>Add New Book</b></a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="manage_book.php"><b>Manage Books</b></a>
	        	</div>
		      </li>
		      <li class="nav-item dropdown">
	        	<a class="nav-link dropdown-toggle" data-toggle="dropdown"><b>Category</b></a>
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
	        	<a class="nav-link dropdown-toggle" data-toggle="dropdown"><b>Staff</b></a>
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
	<span><marquee><b>Library Management System | Brought to you by <span style="color: red;">Tech Alliance</span>.</b></marquee></span><br><br>
	<center><h4 style="color: blue;"><b>Manage Books</b></h4><br></center>
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-12">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>Name</th>
						<th>Author Name</th>
						<th>Category</th>
						<th>ISBN No.</th>
						<th>Price</th>
						<th>Book Quantity</th>
						<th>Book Availability</th>
						<th>Action</th>
					</tr>
				</thead>
				<?php
					$connection = mysqli_connect("localhost", "root", "");
					$db = mysqli_select_db($connection, "lms");
					$query = "SELECT books.*, category.cat_name FROM books JOIN category ON books.cat_id = category.cat_id";
					$query_run = mysqli_query($connection, $query);
					while ($row = mysqli_fetch_assoc($query_run)) {
				?>
					<tr>
						<td><?php echo $row['book_name']; ?></td>
						<td><?php echo $row['author_name']; ?></td>
						<td><?php echo $row['cat_name']; ?></td>
						<td><?php echo $row['isbn_no']; ?></td>
						<td><?php echo $row['book_price']; ?></td>
						<td><?php echo $row['book_quantity']; ?></td>
						<td><?php echo $row['book_availability']; ?></td>
						<td>
							<button class="btn btn-warning"><a href="edit_book.php?bn=<?php echo $row['isbn_no']; ?>" style="color: black;">Edit</a></button>
							<button class="btn btn-danger"><a href="delete_book.php?bn=<?php echo $row['isbn_no']; ?>" style="color: white;">Delete</a></button>
						</td>
					</tr>
				<?php
					}
				?>
			</table>
		</div>
		<div class="col-md-2"></div>
	</div>
</body>
</html>

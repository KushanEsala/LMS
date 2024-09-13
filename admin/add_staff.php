<?php
	require("functions.php");
	session_start();
	#fetch data from database
	$connection = mysqli_connect("localhost","root","");
	$db = mysqli_select_db($connection,"lms");
	$name = "";
	$email = "";
	$mobile = "";
	$query = "select * from admins where email = '$_SESSION[email]'";
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
	<title>Add New staff</title>
	<meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
	<link rel="stylesheet" type="text/css" href="../bootstrap-4.4.1/css/bootstrap.min.css">
  	<script type="text/javascript" src="../bootstrap-4.4.1/js/juqery_latest.js"></script>
  	<script type="text/javascript" src="../bootstrap-4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="admin_dashboard.php"style=color:yellow;>Library Management System (LMS)</style></a>
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
		        <a class="nav-link" href="admin_dashboard.php"><b>Dashboard</b></a>
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
	          <li class="nav-item">
		        <a class="nav-link" href="issue_book.php"><b>Issue Book</b></a>
		      </li>
			  <li class="nav-item">
		        <a class="nav-link" href="return_book.php"><b>Return Book</b></a>
		      </li>
			  <li class="nav-item dropdown">
	        	<a class="nav-link dropdown-toggle" data-toggle="dropdown"><b>Staff </b></a>
	        	<div class="dropdown-menu">
	        		<a class="dropdown-item" href="add_staff.php"><b>Add New Member</b></a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="manage_staff.php"><b>Manage Members</b></a>
	        	</div>
		      </li>
		    </ul>
		</div>
	</nav><br>
	<span><marquee><b>Library Management System|Brought to you by <span style=color:red;>Tech Alliance</style>.</b></marquee></span><br><br>
		<center><h4 style=color:blue;><b>Add a New Staff Member</b></style></h4><br></center>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<form action="" method="post">
                <div class="form-group">
					<label for="name"><b>Full Name:</b></label>
					<input type="text" name="name" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="email"><b>Email:</b></label>
					<input type="text" name="email" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="password"><b>Password:</b></label>
					<input type="password" name="password" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="mobile"><b>Mobile:</b></label>
					<input type="text" name="mobile" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="address"><b>Address:</b></label>
					<textarea name="address" class="form-control" required></textarea> 
				</div>
                <div class="form-group">
					<label for="job_role"><b>Job Role:</b></label>
					<input type="text" name="job_role" class="form-control" required>
				</div>
                <div class="form-group">
						<label for="mobile"><b>Salary:</b></label>
						<input type="text" name="salary" class="form-control" required>
					</div>
					<button type="submit" name="add_staff" class="btn btn-primary">Add</button>
					<button type="cancel" name="cancel" class="btn btn-danger">Cancel</button>
				</form>
			</div>
			<div class="col-md-4"></div>
		</div>
</body>
</html>
<?php
if (isset($_POST['add_staff'])) {
    $connection = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($connection, "lms");

    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $password = mysqli_real_escape_string($connection, $_POST['password']);
    $mobile = mysqli_real_escape_string($connection, $_POST['mobile']);
    $address = mysqli_real_escape_string($connection, $_POST['address']);
    $job_role = mysqli_real_escape_string($connection, $_POST['job_role']);
    $salary = mysqli_real_escape_string($connection, $_POST['salary']);

    $query = "INSERT INTO `staff`(`name`, `email`, `password`, `mobile`, `address`, `job_role`, `salary`) VALUES ('$name', '$email', '$password', '$mobile', '$address', '$job_role', '$salary')";
    
    $query_submition = mysqli_query($connection, $query);

    if ($query_submition) {
        echo '<script>window.onload = function() { alert("Member added successfully..."); }</script>';
    } else {
        echo '<script>window.onload = function() { alert("Error adding Member"); }</script>';
    }
}
?>


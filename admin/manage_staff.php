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
	<title>Manage Staff</title>
	<meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
	<link rel="stylesheet" type="text/css" href="../bootstrap-4.4.1/css/bootstrap.min.css">
  	<script type="text/javascript" src="../bootstrap-4.4.1/js/juqery_latest.js"></script>
  	<script type="text/javascript" src="../bootstrap-4.4.1/js/bootstrap.min.js"></script>
  	<script type="text/javascript">
  		function alertMsg(){
  			alert('Staff added successfully...');
  			window.location.href = "admin_dashboard.php";
  		}
  	</script>
	<style>
		/* Custom table header style */
		thead {
			background-color: #3366ff;
			color: white;
		}
		
		/* Custom action buttons */
		.btn-edit {
			background-color: #ffcc00;
			color: black;
			border: none;
			padding: 5px 10px;
			cursor: pointer;
		}

		.btn-delete {
			background-color: #ff3333;
			color: white;
			border: none;
			padding: 5px 10px;
			cursor: pointer;
		}

		/* Add hover effect for buttons */
		.btn-edit:hover, .btn-delete:hover {
			opacity: 0.8;
		}
	</style>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="admin_dashboard.php" style="color:yellow;">Library Management System (LMS)</a>
			</div>
			<font style="color: white"><span><strong>Welcome: <?php echo $_SESSION['name'];?></strong></span></font>
			<font style="color: white"><span><strong>Email: <?php echo $_SESSION['email'];?></strong></span></font>
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
		        <a class="nav-link" href="../logout.php" style="color:red;"><b>Logout</b></a>
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
	        	<a class="nav-link dropdown-toggle" data-toggle="dropdown"><b>Books</b> </a>
	        	<div class="dropdown-menu">
	        		<a class="dropdown-item" href="add_book.php"><b>Add New Book</b></a>
	        		<div class="dropdown-divider"></div>
	        		<a class="dropdown-item" href="manage_book.php"><b>Manage Books</b></a>
	        	</div>
		      </li>
		      <li class="nav-item dropdown">
	        	<a class="nav-link dropdown-toggle" data-toggle="dropdown"><b>Category</b> </a>
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
	<center><h4 style="color:blue;"><b>Manage Staff Members</b></h4><br></center>
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-12">
			<table class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>Name</th>
						<th>Email</th>
						<th>Mobile</th>
						<th>Address</th>
						<th>Job Role</th>
						<th>Salary</th>
                        <th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$connection = mysqli_connect("localhost","root","");
						$db = mysqli_select_db($connection,"lms");
						$query = "select * from staff";
						$query_run = mysqli_query($connection,$query);
						while ($row = mysqli_fetch_assoc($query_run)){
							?>
							<tr>
								<td><?php echo $row['name'];?></td>
								<td><?php echo $row['email'];?></td>
								<td><?php echo $row['mobile'];?></td>
								<td><?php echo $row['address'];?></td>
								<td><?php echo $row['job_role'];?></td>
								<td><?php echo $row['salary'];?></td>
								<td>
									<button class="btn btn-edit"><a href="edit_staff.php?bn=<?php echo $row['s_id'];?>" style="color:black;">Edit</a></button>
									<button class="btn btn-delete"><a href="delete_staff.php?bn=<?php echo $row['s_id'];?>" style="color:white;">Delete</a></button>
								</td>
							</tr>
							<?php
						}
					?>
				</tbody>
			</table>
		</div>
		<div class="col-md-2"></div>
	</div>
</body>
</html>

<?php
	session_start();
	#fetch data from database
	$connection = mysqli_connect("localhost","root","");
	$db = mysqli_select_db($connection,"lms");
	$cat_name = "";
	
	// Default query
	$query = "SELECT * FROM category";

	// Search functionality
	if(isset($_GET['search']) && !empty($_GET['search'])) {
		$search = $_GET['search'];
		// Modify query to include search criteria
		$query .= " WHERE cat_name LIKE '%$search%'";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Book's Category</title>
	<meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
	<link rel="stylesheet" type="text/css" href="../bootstrap-4.4.1/css/bootstrap.min.css">
  	<script type="text/javascript" src="../bootstrap-4.4.1/js/juqery_latest.js"></script>
  	<script type="text/javascript" src="../bootstrap-4.4.1/js/bootstrap.min.js"></script>
</head>
<style>
		table {
			width: 100%;
			border-collapse: collapse;
			background-color: #f8f9fa;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
			border-radius: 8px;
			overflow: hidden;
		}
		th {
			background-color: #6c757d;
			color: white;
			font-weight: bold;
			padding: 10px;
			text-align: left;
			border-bottom: 2px solid #dee2e6;
		}
		td {
			padding: 10px;
			border-bottom: 1px solid #dee2e6;
		}
		tr:nth-child(even) {
			background-color: #f2f2f2;
		}
		tr:hover {
			background-color: #e9ecef;
		}
		thead {
			background-color: #5d78ff;
			color: white;
		}
		td a {
			text-decoration: none;
			color: white;
		}
		.btn-warning a {
			color: black;
		}
		thead th {
			background-color: #4a73ff;
		}
	</style>
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
		        <a class="nav-link" href="../logout.php"style=color:red;><b>Logout</b></a>
		      </li>
		    </ul>
		</div>
	</nav>
	<!-- Search Form -->
	<div class="container-fluid">
	    <div class="row">
	        <div class="col-md-3">
	            <form method="GET" action="">
	                <div class="input-group mt-3">
	                    <input type="text" class="form-control" name="search" placeholder="Search Category">
	                    <div class="input-group-append">
	                        <button class="btn btn-dark" type="submit">Search</button>
	                    </div>
	                </div>
	            </form>
	        </div>
	        <div class="col-md-9">
	            <!-- Search results table -->
	        </div>
	    </div>
	</div>
	<br>
		<center><h4 style=color:blue;><b>Registered Book's Category</b></style></h4><br></center>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<form>
					<table class="table-bordered" width="900px" style="text-align: center">
						<tr>
						<th><center><h5>Category Name</h5></center></th>
						</tr>
				
					<?php
						$query_run = mysqli_query($connection,$query);
						while ($row = mysqli_fetch_assoc($query_run)){
							?>
							<tr>
							<td><?php echo $row['cat_name'];?></td>
						</tr>

					<?php
						}
					?>	
				</table>
				</form>
			</div>
			<div class="col-md-2"></div>
		</div>
</body>
</html>

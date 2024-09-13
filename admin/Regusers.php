<?php
	session_start();
	#fetch data from database
	$connection = mysqli_connect("localhost","root","");
	$db = mysqli_select_db($connection,"lms");
	$name = "";
	$email = "";
	$password = "";
	$mobile = "";
	$address = "";
	$query = "select * from users";
?>
<!DOCTYPE html>
<html>
<head>
	<title>All Reg Users</title>
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
	</nav>
	<a href="admin_dashboard.php" class="btn btn-light" style="border: 2px solid black;"><b>Back</b></a>
	<!--search-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <!-- Search form -->
                <form method="GET" action="">
                    <div class="input-group mt-3">
                        <input type="text" class="form-control" name="search" placeholder="Search by User Name or ID">
                        <div class="input-group-append">
                            <button class="btn btn-dark" type="submit">Search</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-9">
                <!-- Table for displaying search results -->
                <!-- Your existing table code -->
                <!-- Ensure to embed PHP for displaying filtered results here -->
            </div>
        </div>
    </div>
    <!-- Your footer content -->

<?php
$query = "SELECT id, name, email, password, mobile, address, reg_date FROM users WHERE role = 'user'";

if(isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $_GET['search'];
    $query .= " WHERE name LIKE '%$search%' OR email LIKE '%$search%'";
}
?>
<?php
    $query_run = mysqli_query($connection, $query);
    while ($row = mysqli_fetch_assoc($query_run)){
        // ... existing code to display the table rows
    }
?>
	<br>
	<span><marquee><b>Library Management System|Brought to you by <span style=color:red;>Tech Alliance</style>.</b></marquee></span><br><br>
		<center><h4 style=color:blue;><u>Registered Users Detail</u></h4><br></center>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<form>
					<table class="table-bordered" width="900px" style="text-align: center">
						<tr>
							<th>Name</th>
							<th>Mobile</th>
							<th>Email</th>
							<th>Address</th>
							<th>Registration Date</th>
						</tr>
				
					<?php
						$query_run = mysqli_query($connection,$query);
						while ($row = mysqli_fetch_assoc($query_run)){
							$name = $row['name'];
							$email = $row['email'];
							$mobile = $row['mobile'];
							$address = $row['address'];
							$reg_date = $row['reg_date'];
					?>
						<tr>
							<td><?php echo $name;?></td>
							<td><?php echo $email;?></td>
							<td><?php echo $mobile;?></td>
							<td><?php echo $address;?></td>
							<td><?php echo $reg_date;?></td>
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

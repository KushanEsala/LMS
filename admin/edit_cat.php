<?php
	session_start();
	#fetch data from database
	$connection = mysqli_connect("localhost","root","");
	$db = mysqli_select_db($connection,"lms");
	$cat_id = "";
	$cat_name = "";
	$query = "select * from category where cat_id = $_GET[cid]";
	$query_run = mysqli_query($connection,$query);
	while ($row = mysqli_fetch_assoc($query_run)){
		$cat_name = $row['cat_name'];
		$cat_id = $row['cat_id'];
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
	<span><marquee><b>Library Management System|Brought to you by <span style=color:red;>Tech Alliance</style>.</b></marquee></span><br><br>
		<center><h4 style=color:blue;><b>Edit Book</b></style></h4><br></center>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<form action="" method="post">
					<div class="form-group">
						<label for="name"><b>Category Name:</b></label>
						<input type="text" class="form-control" name="cat_name" value="<?php echo $cat_name; ?>" required>
					</div>
					<button type="submit" name="update_cat" class="btn btn-primary">Update</button>
					<button type="refresh" name="refresh_cat" class="btn btn-success">Refresh</button>
					<button type="cancel" name="cancel_cat" class="btn btn-danger">Cancel</button>
				</form>
			</div>
			<div class="col-md-4"></div>
		</div>
</body>
</html>
<?php
	if(isset($_POST['update_cat'])){
		$connection = mysqli_connect("localhost","root","");
		$db = mysqli_select_db($connection,"lms");
		$query = "update category set cat_name = '$_POST[cat_name]' where cat_id = $_GET[cid]";
		$query_run = mysqli_query($connection,$query);

		if ($query_run) {
			echo '<script>window.onload = function() { alert("Category Update successfully..."); }</script>';
		} else {
			echo '<script>window.onload = function() { alert("Error Updating Category"); }</script>';
		}
	}
?>
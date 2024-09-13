<?php
	require("functions.php");
	session_start();
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
		        <a class="nav-link" href="../logout.php"style=color:red;><b>Logout</b></a>
		      </li>
		    </ul>
		</div>
	</nav><br>
	<span><marquee><b>Library Management System|Brought to you by <span style=color:red;>Tech Alliance</style>.</b></marquee></span><br><br>
		<center><h4 style=color:blue;><b>Change Admin Password</b></style></h4><br></center>
		<div class="row">
			<div class="col-md-4"></div>
			<div class="col-md-4">
			<form action="update_password.php" method="post"> 
			<input type="text" class="form-control" name="adminEmail" id="adminEmail" value="<?php echo $_SESSION['email']; ?>" hidden>
					<div class="form-group">
						<label for="password"><b>Enter Password:</b></label>
						<input type="password" class="form-control" name="old_password">
					</div>
					<div class="form-group">
						<label for="New Password"><b>Enter New Password:</b></label>
						<input type="password" name="new_password" class="form-control">
					</div>
					<button type="submit" name="update" class="btn btn-primary">Update Password</button>
					<button type="cancel" name="Cancel" class="btn btn-danger">cancel</button>

				</form>
			</div>
			<div class="col-md-4"></div>
		</div>
</body>
</html>

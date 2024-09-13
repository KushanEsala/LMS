<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
	<title>LMS</title>
	<meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
	<link rel="stylesheet" type="text/css" href="bootstrap-4.4.1/css/bootstrap.min.css">
	<script type="text/javascript" src="bootstrap-4.4.1/js/juqery_latest.js"></script>
	<script type="text/javascript" src="bootstrap-4.4.1/js/bootstrap.min.js"></script>
</head>
<style type="text/css">
	#main_content {
		padding: 50px;
		background-color: whitesmoke;
	}

	#side_bar {
		background-color: whitesmoke;
		padding: 50px;
		width: 300px;
		height: 450px;
	}
</style>

<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="index.php" style=color:yellow;>Library Management System (LMS)</style></a>
			</div>
			<ul class="nav navbar-nav navbar-right">
				<li class="nav-item">
					<a class="nav-link" href="about.php" style=color:white;><b>About Us</b></style></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="help.php" style=color:white;><b>Help/Support</b></style></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="signup.php" style=color:#00C957;></span><b>Register</b></style></a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="index.php" style=color:#00C957;><b>Login</b></style></a>
				</li>
			</ul>
		</div>
	</nav>
	<br>
	<span>
		<marquee><b>Library Management System|Brought to you by <span style=color:red;>Tech Alliance</style>.</b></marquee>
	</span><br><br>
	<div class="row">
		<div class="col-md-4" id="side_bar">
			<h5>Library Timing</h5>
			<ul>
				<li>Opening: 8:00 AM</li>
				<li>Closing: 5:00 PM</li>
				<li>(Sunday Off)</li>
			</ul>
			<h5>What We provide ?</h5>
			<ul>
				<li>Free Wi-fi</li>
				<li>News Papers</li>
				<li>Discussion Room</li>
				<li>Peacefull Environment</li>
			</ul>
		</div>
		<div class="col-md-8" id="main_content">
			<center>
				<h3 style=color:blue;><b>Login Form</b></style></h3>
			</center>
			<form action="" method="post">
				<div class="form-group">
					<label for="email"><b>Email ID:</b></label>
					<input type="text" name="email" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="password"><b>Password:</b></label>
					<input type="password" name="password" class="form-control" required>
				</div>
				<button type="submit" name="login" class="btn btn-success">Login</button>
				<a href="signup.php" style=color:red;><b>Not registered yet ? </b></style></a>|
				<a href="forgot_password.php" style=color:blue;><u>Forgot Password</u></style></a>|
			</form>
			<?php
			if (isset($_POST['login'])) {
				$connection = mysqli_connect("localhost", "root", "");
				$db = mysqli_select_db($connection, "lms");
				$query = "select * from users where email = '$_POST[email]'";
				$query_run = mysqli_query($connection, $query);
				while ($row = mysqli_fetch_assoc($query_run)) {
					if ($row['email'] == $_POST['email']) {
						if ($row['password'] == $_POST['password']) {
							$_SESSION['name'] =  $row['name'];
							$_SESSION['email'] =  $row['email'];
							$_SESSION['id'] =  $row['id'];
							$_SESSION['role'] =  $row['role'];
							// header("Location: user_dashboard.php");
							// echo $_SESSION['role'];
							if ($_SESSION['role'] == "super_admin") {
								header("Location: super_admin/super_admin_dashboard.php");
							} else if ($_SESSION['role'] == "admin") {
								header("Location: admin/admin_dashboard.php");
							} else {
								header("Location: user_dashboard.php");
							}
						} else {
			?>
							<br><br>
							<center><span class="alert-danger">Wrong Password !!</span></center>
			<?php
						}
					}
				}
			}
			?>
		</div>
	</div>
</body>

</html>
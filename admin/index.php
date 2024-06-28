<?php
	session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>LMS | Login</title>
	<meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
	<link rel="stylesheet" type="text/css" href="../bootstrap-4.4.1/css/bootstrap.min.css">
  	<script type="text/javascript" src="./bootstrap-4.4.1/js/juqery_latest.js"></script>
  	<script type="text/javascript" src="./bootstrap-4.4.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<style type="text/css">
	#main_content{
		padding: 50px;
		background-color: whitesmoke;
	}
	#side_bar{
		background-color: whitesmoke;
		padding: 50px;
		width: 300px;
		height: 450px;
	}
	.social-icons3 li {
            display: inline;
            margin: 0 5px;
        }

        .social-icons3 a {
            color: #fff;
            font-size: 24px;
        }
.social-icons3 li a.fab.fa-facebook.icon-border.facebook{
	 background:#4D669C;
}
.social-icons3 li a.fab.fa-whatsapp.icon-border.whatsapp{
	 background:#48f21d;
} 
.social-icons3 li a.fab.fa-google-plus.icon-border.googleplus{
	 background:#d34836;
}
.social-icons3 li a.fas.fa-map-marker-alt.icon-border.map-marker-alt{
	 background:black;
}
</style>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="index.php"style=color:yellow;>Library Management System (LMS)</style></a>
			</div>
	
		    <ul class="nav navbar-nav navbar-right">
			<li class="nav-item">
			<a class="nav-link"href="about.php"style=color:white;><b>About Us</b></style></a>
			</li>
			<li class="nav-item">
			<a class="nav-link"href="help.php"style=color:white;><b>Help/Support</b></style></a>
			</li>
			<li class="nav-item">
		        <a class="nav-link" href="../super_admin/index.php"style=color:#00C957;><b>Super Admin Login</b></style></a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="index.php"style=color:#00C957;><b>Admin Login</style></b></a>
		      </li>
		      <li class="nav-item">
		        <a class="nav-link" href="../index.php"style=color:#00C957;><b>User Login</b></style></a>
		      </li>
		    </ul>
		</div>
	</nav><br>
	<span><marquee><b>Library Management System|Brought to you by <span style=color:red;>Tech Alliance</style>.</b></marquee></span><br><br>
	<div class="row">
		<div class="col-md-4" id="side_bar">
			<h5>Library Timing</h5>
			<ul>
				<li>Opening: 8:00 AM</li>
				<li>Closing: 8:00 PM</li>
				<li>(Sunday Off)</li>
			</ul>
			<h5>What We provide ?</h5>
			<ul>
				<li>Free Wi-fi</li>
				<li>News Papers</li>
				<li>Discussion Room</li>
				<li>Peacefull Environment</li>
			</ul>
		
			<ul class="social-icons3">
			<li><a href="https://www.facebook.com/" class="fab fa-facebook icon-border facebook"></a></li>
            <li><a href="https://web.whatsapp.com/" class="fab fa-whatsapp icon-border whatsapp"></a></li>
            <li><a href="https://plus.google.com/u/0/" class="fab fa-google-plus icon-border googleplus"></a></li>
			<li><a href="https://maps.app.goo.gl/9iLd8p8gGq3mbjNj7" class="fas fa-map-marker-alt icon-border map-marker-alt"style=color:yellow;></style></a></li>

			</ul>
		</div>
		<div class="col-md-8" id="main_content">
			<center><h3 style=color:blue;><u>Admin Login Form</u></style></h3></center>
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
			</form>
			<?php 
				if(isset($_POST['login'])){
					$connection = mysqli_connect("localhost","root","");
					$db = mysqli_select_db($connection,"lms");
					$query = "select * from admins where email = '$_POST[email]'";
					$query_run = mysqli_query($connection,$query);
					while ($row = mysqli_fetch_assoc($query_run)) {
						if($row['email'] == $_POST['email']){
							if($row['password'] == $_POST['password']){
								$_SESSION['name'] =  $row['name'];
								$_SESSION['email'] =  $row['email'];
								header("Location: admin_dashboard.php");
							}
							else{
								?>
								<br><br><center><span class="alert-danger">Wrong Password !!</span></center>
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

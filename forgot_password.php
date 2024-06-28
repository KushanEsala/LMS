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
</style>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="index.php"style=color:yellow;>Library Management System (LMS)</style></a>
			</div>
	</nav>
	<br>
	<span><marquee><b>Library Management System|Brought to you by <span style=color:red;>Tech Alliance</style>.</b></marquee></span><br><br>
     <!-- Similar structure as your other HTML/Bootstrap content -->
<!-- Add a form for password reset -->
<form action="" method="post">
    <div class="form-group">
        <label for="email"><b>Email Address</Address>:</b></label>
        <input type="text" name="email" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="password"><b>New Password:</b></label>
        <input type="password" name="new_password" class="form-control" required>
    </div>
    <button type="submit" name="update_password" class="btn btn-primary">Update Password</button>
</form>

<!-- forgot_password.php -->
<!-- ... (your form structure) -->

<?php
if(isset($_POST['update_password'])){
    $connection = mysqli_connect("localhost","root","");
    $db = mysqli_select_db($connection,"lms");
    $email = $_POST['email'];
    $new_password = $_POST['new_password'];

    // Check if the email exists in the database
    $query = "SELECT * FROM users WHERE email = '$email'";
    $query_run = mysqli_query($connection,$query);

    if(mysqli_num_rows($query_run) > 0){
        // Update the password for the given email
        $update_query = "UPDATE users SET password = '$new_password' WHERE email = '$email'";
        $update_query_run = mysqli_query($connection,$update_query);

        if($update_query_run){
            echo '<br><br><center>Password updated successfully!</center>';
        } else {
            echo '<br><br><center>Failed to update password!</center>';
        }
    } else {
        echo '<br><br><center>Email does not exist!</center>';
    }
}
?>

</body>
</html>

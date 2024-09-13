<?php
    require("functions.php");
    session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Staff Members</title>
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
    <br>
    <span><marquee><b>Library Management System|Brought to you by <span style=color:red;>Tech Alliance</style>.</b></marquee></span><br><br>
    <div class="container">
        <center><h2 style=color:blue><u>Staff Members</u></style></h2></center><br>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Address</th>
                    <th>Job Role</th>
                    <th>Salary</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $connection = mysqli_connect("localhost", "root", "");
                    $db = mysqli_select_db($connection, "lms");

                    $query = "SELECT * FROM staff";
                    $query_run = mysqli_query($connection, $query);

                    if ($query_run) {
                        while ($row = mysqli_fetch_assoc($query_run)) {
                            echo "<tr>";
                            echo "<td>" . $row['name'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['mobile'] . "</td>";
                            echo "<td>" . $row['address'] . "</td>";
                            echo "<td>" . $row['job_role'] . "</td>";
                            echo "<td>" . $row['salary'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo '<tr><td colspan="7">No staff members found</td></tr>';
                    }
                ?>
            </tbody>
        </table>
   
    </div>
</body>
</html>

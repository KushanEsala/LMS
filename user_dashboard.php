<?php
	session_start();
	function get_user_issue_book_count(){
		$connection = mysqli_connect("localhost","root","");
		$db = mysqli_select_db($connection,"lms");
		$user_issue_book_count = 0;
		$query = "select count(*) as user_issue_book_count from issued_books where user_id = $_SESSION[id]";
		$query_run = mysqli_query($connection,$query);
		while ($row = mysqli_fetch_assoc($query_run)){
			$user_issue_book_count = $row['user_issue_book_count'];
		}
		return($user_issue_book_count);
	}

	function get_user_return_book_count(){
		$connection = mysqli_connect("localhost","root","");
		$db = mysqli_select_db($connection,"lms");
		$user_return_book_count = 0;
		$query = "select count(*) as user_return_book_count from returned_books where user_id = $_SESSION[id]";
		$query_run = mysqli_query($connection,$query);
		while ($row = mysqli_fetch_assoc($query_run)){
			$user_return_book_count = $row['user_return_book_count'];
		}
		return($user_return_book_count);
	}

	function get_book_count(){
		$connection = mysqli_connect("localhost","root","");
		$db = mysqli_select_db($connection,"lms");
		$book_count = 0;
		$query = "select count(*) as book_count from books";
		$query_run = mysqli_query($connection,$query);
		while ($row = mysqli_fetch_assoc($query_run)){
			$book_count = $row['book_count'];
		}
		return($book_count);
	}
	
	function get_user_profile_photo($user_id){
		$connection = mysqli_connect("localhost","root","");
		$db = mysqli_select_db($connection,"lms");
		$query = "SELECT photo FROM users WHERE id = $user_id";
		$query_run = mysqli_query($connection,$query);
		$photo_path = "";
		while ($row = mysqli_fetch_assoc($query_run)){
			$photo_path = $row['photo'];
		}
		return $photo_path;
	}
	
	$user_id = $_SESSION['id']; // Get the logged-in user's ID
	$user_photo = get_user_profile_photo($user_id); // Get the user's photo dynamically
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
	<link rel="stylesheet" type="text/css" href="bootstrap-4.4.1/css/bootstrap.min.css">
	<script type="text/javascript" src="bootstrap-4.4.1/js/juqery_latest.js"></script>
	<script type="text/javascript" src="bootstrap-4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<div class="navbar-header">
			<?php
if(!empty($user_photo)) {
    echo '<img src="' . $user_photo . '" alt="Profile Photo" style="width: 40px; height: 40px; border-radius: 50%;">';
} else {
    echo '<img src="default_profile_photo.jpg" alt="Default Profile" style="width: 40px; height: 40px; border-radius: 50%;">';
}
?>
 <?php
        $user_id = $_SESSION['id']; // Get the logged-in user's ID
        $user_photo = get_user_profile_photo($user_id); // Get the user's photo dynamically
        ?>
				<a class="navbar-brand" href="user_dashboard.php" style="color:yellow;">Library Management System (LMS)</a>
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
		        <a class="nav-link" href="logout.php"style=color:red;><b>Logout</b></style></a>
		      </li>
		    </ul>
		</div>
	</nav><br>
	<div class="row">
		<div class="col-md-3" style="margin: 0px">
			<div class="card bg-light" style="width: 300px">
				<div class="card-header"><b>Total Books</b></div>
				<div class="card-body">
					<p class="card-text">No of books Available: <?php echo get_book_count();?></p>
					<a class="btn btn-success" href="Regbooks.php">View All Books</a>
				</div>
			</div>
		</div>
		<div class="col-md-3" style="margin: 0px">
			<div class="card bg-light" style="width: 300px">
				<div class="card-header"><b>Books Issued</b></div>
				<div class="card-body">
					<p class="card-text">No of books issued: <?php echo get_user_issue_book_count();?></p>
					<a class="btn btn-secondary" href="view_issued_book.php">View Issued Books</a>
				</div>
			</div>
		</div>
		<div class="col-md-3" style="margin: 0px">
			<div class="card bg-light" style="width: 300px">
				<div class="card-header"><b>Books Returned</b></div>
				<div class="card-body">
					<p class="card-text">No of books returned: <?php echo get_user_return_book_count();?></p>
					<a class="btn btn-info" href="view_returned_book.php">View Returned Books</a>
				</div>
			</div>
		</div>
		
		<!-- Card for Selecting Books to Borrow -->
		<div class="col-md-3" style="margin: 0px">
			<div class="card bg-light" style="width: 300px">
				<div class="card-header"><b>Select Books to Borrow</b></div>
				<div class="card-body">
					<p class="card-text">Borrow from a variety of books!</p>
					<a class="btn btn-warning" href="select_books.php">Select Books</a>
				</div>
			</div>
		</div>
		<!-- End of Card for Selecting Books to Borrow -->
	</div>
</body>
</html>

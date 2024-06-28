<?php
	session_start();
	if (!isset($_SESSION['id'])) {
		header("Location: login.php");
		exit();
	}

	// Function to handle book request
	if (isset($_POST['request_book'])) {
		$connection = mysqli_connect("localhost","root","");
		$db = mysqli_select_db($connection,"lms");
		$book_id = $_POST['book_id'];
		$book_name = $_POST['book_name'];
		$user_name = $_SESSION['name'];
		$request_date = date("Y-m-d H:i:s");
		$query = "INSERT INTO request_book (user_id, book_id, user_name, book_name, request_date) VALUES ('$_SESSION[id]', '$book_id', '$user_name', '$book_name', '$request_date')";
		$query_run = mysqli_query($connection, $query);
		if ($query_run) {
			echo "<script>alert('Book requested successfully!');</script>";
		} else {
			echo "<script>alert('Failed to request book. Please try again.');</script>";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Select Books</title>
	<meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
	<link rel="stylesheet" type="text/css" href="bootstrap-4.4.1/css/bootstrap.min.css">
  	<script type="text/javascript" src="bootstrap-4.4.1/js/juqery_latest.js"></script>
  	<script type="text/javascript" src="bootstrap-4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="user_dashboard.php"style=color:yellow;>Library Management System (LMS)</style></a>
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
		        <a class="nav-link" href="logout.php"style=color:red;><b>Logout</b></a>
		      </li>
		    </ul>
		</div>
	</nav><br>
	<div class="container">
	<center><h4 style=color:blue;><b>Select Books to Borrow</b></style></h4><br></center>
		<div class="card bg-light" style="padding: 20px;">
			<div class="card-header"><b>Available Books</b></div>
			<div class="card-body">
				<table class="table table-bordered table-hover">
					<thead>
						<tr>
							<th>Book ID</th>
							<th>Book Name</th>
							<th>Author Name</th>
							<th>Category ID</th>
							<th>ISBN No</th>
							<th>Book Price</th>
							<th>Book Quantity</th>
							<th>Book Availability</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$connection = mysqli_connect("localhost","root","");
						$db = mysqli_select_db($connection,"lms");
						$query = "SELECT * FROM books";
						$query_run = mysqli_query($connection,$query);
						while ($row = mysqli_fetch_assoc($query_run)){
							?>
							<tr>
								<td><?php echo $row['book_id']; ?></td>
								<td><?php echo $row['book_name']; ?></td>
								<td><?php echo $row['author_name']; ?></td>
								<td><?php echo $row['cat_id']; ?></td>
								<td><?php echo $row['isbn_no']; ?></td>
								<td><?php echo $row['book_price']; ?></td>
								<td><?php echo $row['book_quantity']; ?></td>
								<td><?php echo $row['book_availability']; ?></td>
								<td>
									<form method="post" action="">
										<input type="hidden" name="book_id" value="<?php echo $row['book_id']; ?>">
										<input type="hidden" name="book_name" value="<?php echo $row['book_name']; ?>">
										<?php if($row['book_availability'] > 0) { ?>
											<button type="submit" name="request_book" class="btn btn-primary">Rent</button>
										<?php } else { ?>
											<button type="button" class="btn btn-secondary" disabled>Unavailable</button>
										<?php } ?>
									</form>
								</td>
							</tr>
							<?php
						}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</body>
</html>
<?php
	session_start();
	if (!isset($_SESSION['id'])) {
		header("Location: login.php");
		exit();
	}

	// Function to handle book request
	if (isset($_POST['request_book'])) {
		$connection = mysqli_connect("localhost", "root", "", "lms");
		if (!$connection) {
			die("Database connection failed: " . mysqli_connect_error());
		}
		$book_id = $_POST['book_id'];
		$book_name = $_POST['book_name'];
		$user_name = $_SESSION['name'];
		$request_date = date("Y-m-d H:i:s");

		// Insert book request with status set to 0 (pending)
		$query = "INSERT INTO request_book (user_id, book_id, user_name, book_name, request_date, status) 
		          VALUES ('$_SESSION[id]', '$book_id', '$user_name', '$book_name', '$request_date', '0')";
		$query_run = mysqli_query($connection, $query);

		if ($query_run) {
			echo "<script>alert('Book requested successfully!');</script>";
		} else {
			echo "<script>alert('Failed to request book. Please try again.');</script>";
		}
		mysqli_close($connection);
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
				<a class="navbar-brand" href="user_dashboard.php" style="color:yellow;">Library Management System (LMS)</a>
			</div>
			<font style="color: white"><span><strong>Welcome: <?php echo htmlspecialchars($_SESSION['name']);?></strong></span></font>
			<font style="color: white"><span><strong>Email: <?php echo htmlspecialchars($_SESSION['email']);?></strong></font>
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
		        <a class="nav-link" href="logout.php" style="color:red;"><b>Logout</b></a>
		      </li>
		    </ul>
		</div>
	</nav><br>
	<div class="container">
	<center><h4 style="color:blue;"><b>Select Books to Borrow</b></h4><br></center>
		<div class="card bg-light" style="padding: 20px;">
			<div class="card-header"><b>Available Books</b></div>
			<div class="card-body">
				<div class="row">
					<?php
					$connection = mysqli_connect("localhost", "root", "", "lms");
					if (!$connection) {
						die("Database connection failed: " . mysqli_connect_error());
					}

					// Fetch book details with category name
					$query = "
						SELECT books.*, category.cat_name 
						FROM books 
						LEFT JOIN category ON books.cat_id = category.cat_id
					";
					$query_run = mysqli_query($connection, $query);
					while ($row = mysqli_fetch_assoc($query_run)){
					?>
					<div class="col-md-3">
						<div class="card" style="margin-bottom: 20px;">
							<img class="card-img-top" src="super_admin/uploads/<?php echo htmlspecialchars($row['book_image']); ?>" alt="Book Image" style="height:200px; object-fit:cover;">
							<div class="card-body">
								<h5 class="card-title"><?php echo htmlspecialchars($row['book_name']); ?></h5>
								<p class="card-text"><strong>Author:</strong> <?php echo htmlspecialchars($row['author_name']); ?></p>
								<p class="card-text"><strong>Category:</strong> <?php echo htmlspecialchars($row['cat_name']); ?></p>
								<p class="card-text"><strong>ISBN:</strong> <?php echo htmlspecialchars($row['isbn_no']); ?></p>
								<p class="card-text"><strong>Price:</strong> Rs. <?php echo htmlspecialchars($row['book_price']); ?></p>
								<p class="card-text"><strong>Quantity:</strong> <?php echo htmlspecialchars($row['book_quantity']); ?></p>
								<p class="card-text"><strong>Availability:</strong> <?php echo ($row['book_availability'] > 0) ? 'Available' : 'Unavailable'; ?></p>
								<form method="post" action="">
									<input type="hidden" name="book_id" value="<?php echo htmlspecialchars($row['book_id']); ?>">
									<input type="hidden" name="book_name" value="<?php echo htmlspecialchars($row['book_name']); ?>">
									<?php if($row['book_availability'] > 0) { ?>
										<button type="submit" name="request_book" class="btn btn-primary">Rent</button>
									<?php } else { ?>
										<button type="button" class="btn btn-secondary" disabled>Unavailable</button>
									<?php } ?>
								</form>
							</div>
						</div>
					</div>
					<?php
					}
					mysqli_close($connection);
					?>
				</div>
			</div>
		</div>
	</div>
</body>
</html>

<?php
	session_start();
	#fetch data from database
	$connection = mysqli_connect("localhost", "root", "");
	$db = mysqli_select_db($connection, "lms");
	$book_name = "";
	$author = "";
	$category = "";
	$book_no = "";
	$price = "";
	$query = "SELECT books.book_name, books.isbn_no, books.book_price, books.book_quantity, books.book_availability, authors.author_name 
	          FROM books 
	          LEFT JOIN authors ON books.author_name = authors.author_name";
?>
<!DOCTYPE html>
<html>
<head>
	<title>All Reg Books</title>
	<meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
	<link rel="stylesheet" type="text/css" href="bootstrap-4.4.1/css/bootstrap.min.css">
	<script type="text/javascript" src="bootstrap-4.4.1/js/juqery_latest.js"></script>
	<script type="text/javascript" src="bootstrap-4.4.1/js/bootstrap.min.js"></script>
</head>
<style type="text/css">
	/* CSS */
.not-available {
    color: red;
    margin-right: 5px; /* Adjust margin as needed */
}

.available {
    color: green;
}
<style>
		table {
			width: 100%;
			border-collapse: collapse;
			background-color: #f8f9fa;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
			border-radius: 8px;
			overflow: hidden;
		}
		th {
			background-color: #6c757d;
			color: white;
			font-weight: bold;
			padding: 10px;
			text-align: left;
			border-bottom: 2px solid #dee2e6;
		}
		td {
			padding: 10px;
			border-bottom: 1px solid #dee2e6;
		}
		tr:nth-child(even) {
			background-color: #f2f2f2;
		}
		tr:hover {
			background-color: #e9ecef;
		}
		thead {
			background-color: #5d78ff;
			color: white;
		}
		td a {
			text-decoration: none;
			color: white;
		}
		.btn-warning a {
			color: black;
		}
		thead th {
			background-color: #4a73ff;
		}
	</style>

</style>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="admin_dashboard.php" style="color:yellow;">Library Management System (LMS)</a>
			</div>
			<font style="color: white"><span><strong>Welcome: <?php echo $_SESSION['name']; ?></strong></span></font>
			<font style="color: white"><span><strong>Email: <?php echo $_SESSION['email']; ?></strong></font>
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
		        <a class="nav-link" href="../logout.php" style="color:red;"><b>Logout</b></a>
		      </li>
		    </ul>
		</div>
	</nav>
	<!--search-->
	<div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <!-- Search form -->
                <form method="GET" action="">
                    <div class="input-group mt-3">
                        <input type="text" class="form-control" name="search" placeholder="Search by Book Name or ISBN">
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
if(isset($_GET['search']) && !empty($_GET['search'])) {
    $search = mysqli_real_escape_string($connection, $_GET['search']);
    $query .= " WHERE books.book_name LIKE '%$search%' OR books.isbn_no LIKE '%$search%'";
}
?>
<?php
    $query_run = mysqli_query($connection, $query);
    if ($query_run) {
        while ($row = mysqli_fetch_assoc($query_run)){
            // Display the table rows
        }
    } else {
        echo '<div class="alert alert-danger">Error executing query: ' . mysqli_error($connection) . '</div>';
    }
?>
	<br>
	<center><h4 style="color:blue;"><b>Registered Book's Details</b></h4><br></center>
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<form>
				<table class="table-bordered" width="900px" style="text-align: center">
					<tr>
						<th>Name</th>
						<th>Author</th>
						<th>Price</th>
						<th>ISBN Number</th>
						<th>Book Quantity</th>
						<th>Book Availability</th>
					</tr>
					<?php
						$query_run = mysqli_query($connection, $query);
						while ($row = mysqli_fetch_assoc($query_run)){
							?>
							<tr>
								<td><?php echo $row['book_name']; ?></td>
								<td><?php echo $row['author_name']; ?></td>
								<td><?php echo $row['book_price']; ?></td>
								<td><?php echo $row['isbn_no']; ?></td>
								<td><?php echo $row['book_quantity']; ?></td>
								<td>
									<?php
										if ($row['book_availability'] == 0) {
											echo '<span class="not-available"><b>Not Available</b></span>';
										} elseif ($row['book_availability'] == 1) {
											echo '<span class="available"><b>Available</b></span>';
										} else {
											echo "Status Unknown";
										}
									?>
								</td>
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

<?php
	session_start();
	// Connect to the database
	$connection = mysqli_connect("localhost", "root", "", "lms");
	if (!$connection) {
		die("Database connection failed: " . mysqli_connect_error());
	}

	// Initialize variables
	$book_name = "";
	$isbn_no = "";
	$author_name = "";
	$cat_id = ""; // Use cat_id instead of cat_name
	$book_price = "";
	$book_quantity = "";
	$book_availability = "";
	$book_image = ""; // New variable for book image

	// Fetch authors and categories for dropdowns
	$authors_query = "SELECT author_name FROM authors";
	$authors_result = mysqli_query($connection, $authors_query);
	$authors = [];
	while ($author_row = mysqli_fetch_assoc($authors_result)) {
		$authors[] = $author_row;
	}

	// Fetch book details
	if (isset($_GET['bn'])) {
		$query = "SELECT * FROM books WHERE isbn_no = '$_GET[bn]'";
		$query_run = mysqli_query($connection, $query);

		if ($query_run) {
			while ($row = mysqli_fetch_assoc($query_run)) {
				$book_name = $row['book_name'];
				$isbn_no = $row['isbn_no'];
				$author_name = $row['author_name'];
				$cat_id = $row['cat_id']; // Fetch cat_id
				$book_price = $row['book_price'];
				$book_quantity = $row['book_quantity'];
				$book_availability = $row['book_availability'];
				$book_image = $row['book_image']; // Fetch current book image
			}
		} else {
			echo "Error: " . mysqli_error($connection);
		}
	}

	// Fetch category options for the dropdown
	$categories_query = "SELECT cat_id, cat_name FROM category";
	$categories_result = mysqli_query($connection, $categories_query);
	$categories = [];
	while ($category_row = mysqli_fetch_assoc($categories_result)) {
		$categories[] = $category_row;
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Edit Book</title>
	<meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="../bootstrap-4.4.1/css/bootstrap.min.css">
  	<script type="text/javascript" src="../bootstrap-4.4.1/js/jquery_latest.js"></script>
  	<script type="text/javascript" src="../bootstrap-4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand" href="admin_dashboard.php" style="color: yellow;">Library Management System (LMS)</a>
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
		        <a class="nav-link" href="../logout.php" style="color: red;"><b>Logout</b></a>
		      </li>
		    </ul>
		</div>
	</nav><br>
	<center><h4 style="color: blue;"><b>Edit Book</b></h4><br></center>
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4">
			<form action="" method="post" enctype="multipart/form-data"> <!-- Added enctype for file upload -->
				<div class="form-group">
					<label for="isbn_no"><b>ISBN Number:</b></label>
					<input type="text" name="isbn_no" value="<?php echo htmlspecialchars($isbn_no); ?>" class="form-control" disabled required>
				</div>
				<div class="form-group">
					<label for="book_name"><b>Book Name:</b></label>
					<input type="text" name="book_name" value="<?php echo htmlspecialchars($book_name); ?>" class="form-control" required>
				</div>
				<div class="form-group">
                    <label for="book_author"><b>Author Name:</b></label>
                    <select name="book_author" class="form-control" required>
                        <?php
                            foreach ($authors as $author) {
                                $selected = ($author['author_name'] == $author_name) ? 'selected' : '';
                                echo "<option value='".htmlspecialchars($author['author_name'])."' $selected>".htmlspecialchars($author['author_name'])."</option>";
                            }
                        ?>
                    </select>
                </div>
				<div class="form-group">
					<label for="cat_id"><b>Category Name:</b></label>
					<select name="cat_id" class="form-control" required>
						<?php
							foreach ($categories as $category) {
								$selected = ($category['cat_id'] == $cat_id) ? 'selected' : '';
								echo "<option value='".htmlspecialchars($category['cat_id'])."' $selected>".htmlspecialchars($category['cat_name'])."</option>";
							}
						?>
					</select>
				</div>
				<div class="form-group">
					<label for="book_price"><b>Book Price:</b></label>
					<input type="text" name="book_price" value="<?php echo htmlspecialchars($book_price); ?>" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="book_quantity"><b>Book Quantity:</b></label>
					<input type="text" name="book_quantity" value="<?php echo htmlspecialchars($book_quantity); ?>" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="book_availability"><b>Book Availability:</b></label>
					<input type="text" name="book_availability" value="<?php echo htmlspecialchars($book_availability); ?>" class="form-control" required>
				</div>
				<div class="form-group">
					<label for="book_image"><b>Book Image:</b></label><br>
					<img src="../super_admin/uploads/<?php echo htmlspecialchars($book_image); ?>" alt="Book Image" style="width:100px;"><br><br> <!-- Display current image -->
					<input type="file" name="book_image" class="form-control">
				</div>
				<button type="submit" name="update" class="btn btn-primary">Update Book</button>
				<button type="reset" name="reset" class="btn btn-success">Reset</button>
				<button type="button" name="cancel" class="btn btn-danger" onclick="window.location.href='manage_book.php';">Cancel</button>
			</form>
		</div>
		<div class="col-md-4"></div>
	</div>
</body>
</html>

<?php
	if (isset($_POST['update'])) {
		// Handle the book image upload
		$book_image_name = $_FILES['book_image']['name'];
		$book_image_tmp = $_FILES['book_image']['tmp_name'];
		$book_image_folder = '../super_admin/uploads/' . $book_image_name;

		if (!empty($book_image_name)) {
			move_uploaded_file($book_image_tmp, $book_image_folder);
		} else {
			// If no new image is uploaded, keep the old one
			$book_image_name = $book_image;
		}

		// Update the book details in the database
		$query = "UPDATE books SET 
					book_name = '$_POST[book_name]', 
					author_name = '$_POST[book_author]', 
					cat_id = '$_POST[cat_id]', 
					book_price = '$_POST[book_price]', 
					book_quantity = '$_POST[book_quantity]', 
					book_availability = '$_POST[book_availability]', 
					book_image = '$book_image_name'
				  WHERE isbn_no = '$_GET[bn]'";

		$query_run = mysqli_query($connection, $query);

		if ($query_run) {
			echo "<script>alert('Book updated successfully!');</script>";
			echo "<script>window.location.href='manage_book.php';</script>";
		} else {
			echo "<script>alert('Error: " . mysqli_error($connection) . "');</script>";
		}
	}
?>

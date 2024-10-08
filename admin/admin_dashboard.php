<?php
require("functions.php");
session_start();

// Function to call stored procedures and get the result
function get_count_from_procedure($procedure_name) {
    $connection = mysqli_connect("localhost", "root", "", "lms");
    if (!$connection) {
        die("Database connection failed: " . mysqli_connect_error());
    }

	
    
    $query = "CALL $procedure_name()";
    $result = mysqli_query($connection, $query);
    $count = 0;
    
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $count = array_values($row)[0]; // Get the first value in the associative array
    }

    mysqli_close($connection);
    return $count;
}

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
                <a class="navbar-brand" href="admin_dashboard.php" style=color:yellow;>Library Management System (LMS)</a>
            </div>
            <font style="color: white"><span><strong>Welcome: <?php echo $_SESSION['name'];?></strong></span></font>
            <font style="color: white"><span><strong>Email: <?php echo $_SESSION['email'];?></strong></span></font>
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
    </nav><br>

    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd">
        <div class="container-fluid">
            <ul class="nav navbar-nav navbar-center">
                <li class="nav-item"><a class="nav-link" href="admin_dashboard.php"><b>Dashboard</b></a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown"><b>Books</b></a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="add_book.php"><b>Add New Book</b></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="manage_book.php"><b>Manage Books</b></a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown"><b>Category</b></a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="add_cat.php"><b>Add New Category</b></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="manage_cat.php"><b>Manage Category</b></a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown"><b>Authors</b></a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="add_author.php"><b>Add New Author</b></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="manage_author.php"><b>Manage Authors</b></a>
                    </div>
                </li>
                <li class="nav-item"><a class="nav-link" href="issue_book.php"><b>Issue Book</b></a></li>
                <li class="nav-item"><a class="nav-link" href="return_book.php"><b>Return Book</b></a></li>
            </ul>
        </div>
    </nav><br>

    <span><marquee><b>Library Management System|Brought to you by <span style="color:red;">Tech Alliance</span>.</b></marquee></span><br><br>

    <div class="row">
        <div class="col-md-3">
            <div class="card bg-light" style="width: 300px">
                <div class="card-header"><b>Registered User</b></div>
                <div class="card-body">
                    <p class="card-text">No of total Users: <?php echo get_count_from_procedure('GetUserCount'); ?></p>
                    <a class="btn btn-danger" href="Regusers.php">View Registered Users</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-light" style="width: 300px">
                <div class="card-header"><b>Total Books</b></div>
                <div class="card-body">
                    <p class="card-text">No of books Available: <?php echo get_count_from_procedure('GetBookCount'); ?></p>
                    <a class="btn btn-success" href="Regbooks.php">View All Books</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-light" style="width: 300px">
                <div class="card-header"><b>Book Categories</b></div>
                <div class="card-body">
                    <p class="card-text">No of Book's Categories: <?php echo get_count_from_procedure('GetCategoryCount'); ?></p>
                    <a class="btn btn-warning" href="Regcat.php">View Categories</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-light" style="width: 300px">
                <div class="card-header"><b>No of Authors</b></div>
                <div class="card-body">
                    <p class="card-text">No of Authors: <?php echo get_count_from_procedure('GetAuthorCount'); ?></p>
                    <a class="btn btn-primary" href="Regauthor.php">View Authors</a>
                </div>
            </div>
        </div>
    </div><br><br>

    <div class="row">
        <div class="col-md-3">
            <div class="card bg-light" style="width: 300px">
                <div class="card-header"><b>Issued Book's</b></div>
                <div class="card-body">
                    <p class="card-text">No of Issued Book's: <?php echo get_count_from_procedure('GetIssueBookCount'); ?></p>
                    <a class="btn btn-info" href="view_issued_book.php">View Issued books</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-light" style="width: 300px">
                <div class="card-header"><b>Returned Book's</b></div>
                <div class="card-body">
                    <p class="card-text">No of Returned Book's: <?php echo get_count_from_procedure('GetReturnBookCount'); ?></p>
                    <a class="btn btn-danger" href="view_returned_book.php">View Returned Books</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-light" style="width: 300px">
                <div class="card-header"><b>Total Staff Members</b></div>
                <div class="card-body">
                    <p class="card-text">No of Staff Members: <?php echo get_count_from_procedure('GetStaffCount'); ?></p>
                    <a class="btn btn-warning" href="view_add_staff.php">View All Staff Members</a>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card bg-light" style="width: 300px">
                <div class="card-header"><b>Total Book Requests</b></div>
                <div class="card-body">
                    <p class="card-text">No of Requests: <?php echo get_count_from_procedure('GetRequestCount'); ?></p>
                    <a class="btn btn-success" href="view_book_request.php">View Requests</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>

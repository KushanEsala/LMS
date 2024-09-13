<?php
    require('functions.php');
    session_start();

    $connection = mysqli_connect("localhost", "root", "", "lms");

    if (isset($_GET['action']) && isset($_GET['id'])) {
        $request_id = $_GET['id'];
        $action = $_GET['action'];
        
        if ($action == 'accept') {
            acceptRequest($request_id);
        } elseif ($action == 'decline') {
            declineRequest($request_id);
        }
        header("Location: view_book_request.php");
        exit(); // Ensure no further code execution after redirect
    }

    // Fetch all book requests from the database
    $query = "SELECT * FROM request_book";
    $result = mysqli_query($connection, $query);
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Book Requests</title>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../bootstrap-4.4.1/css/bootstrap.min.css">
    <script type="text/javascript" src="../bootstrap-4.4.1/js/jquery_latest.js"></script>
    <script type="text/javascript" src="../bootstrap-4.4.1/js/bootstrap.min.js"></script>

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
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="navbar-header">
                <img src="img.jpg" alt="Default Profile" style="width: 40px; height: 40px; border-radius: 50%;">
                <a class="navbar-brand" href="admin_dashboard.php" style="color:yellow;">Library Management System (LMS)</a>
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
                    <a class="nav-link" href="../logout.php" style="color:red;"><b>Logout</b></a>
                </li>
            </ul>
        </div>
    </nav><br>
    <div class="container">
        <center><h4 style=color:blue;><b>Book Requests</b></style></h4><br></center>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Request ID</th>
                    <th>Book Title</th>
                    <th>User</th>
                    <th>Date Requested</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        $status = $row['status'];
                        $requestId = $row['rb_id'];
                        
                        // Determine if the buttons should be enabled or disabled
                        $acceptButtonClass = $status == 0 ? 'btn btn-success' : 'btn btn-success disabled';
                        $declineButtonClass = $status == 0 ? 'btn btn-danger' : 'btn btn-danger disabled';
                        
                        // Determine if buttons should be clickable
                        $acceptButtonDisabled = $status != 0 ? 'disabled' : '';
                        $declineButtonDisabled = $status != 0 ? 'disabled' : '';

                        echo "<tr>";
                        echo "<td>" . $requestId . "</td>";
                        echo "<td>" . $row['book_name'] . "</td>";
                        echo "<td>" . $row['user_name'] . "</td>";
                        echo "<td>" . $row['request_date'] . "</td>";
                        echo "<td>" . ($status == 0 ? 'Pending' : ($status == 1 ? 'Accepted' : 'Declined')) . "</td>";
                        echo "<td>
                                <a href='view_book_request.php?action=accept&id=" . $requestId . "' class='$acceptButtonClass' $acceptButtonDisabled>Accept</a>
                                <a href='view_book_request.php?action=decline&id=" . $requestId . "' class='$declineButtonClass' $declineButtonDisabled>Decline</a>
                              </td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

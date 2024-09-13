<?php
    require('functions.php');
    session_start();
    // Fetch all book requests from the database
    $connection = mysqli_connect("localhost","root","");
	$db = mysqli_select_db($connection,"lms");
    $query = "SELECT * FROM request_book";
    $result = mysqli_query($connection, $query);

    if (isset($_GET['action']) && isset($_GET['id'])) {
        $request_id = $_GET['id'];
        $action = $_GET['action'];
        
        if ($action == 'accept') {
            acceptRequest($request_id);
        } elseif ($action == 'decline') {
            declineRequest($request_id);
        }
        header("Location: view_book_request.php");
    }

    $query = "SELECT * FROM request_book";
    $result = mysqli_query($connection, $query);
    
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Book Requests</title>
    <meta charset="utf-8" name="viewport" content="width=device-width,intial-scale=1">
    <link rel="stylesheet" type="text/css" href="../bootstrap-4.4.1/css/bootstrap.min.css">
    <script type="text/javascript" src="../bootstrap-4.4.1/js/jquery_latest.js"></script>
    <script type="text/javascript" src="../bootstrap-4.4.1/js/bootstrap.min.js"></script>
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
        <h2>Book Requests</h2>
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
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>".$row['rb_id']."</td>";
                        echo "<td>".$row['user_id']."</td>";
                        echo "<td>".$row['user_name']."</td>";
                        echo "<td>".$row['request_date']."</td>";
                        echo "<td>".$row['book_name']."</td>";
                        echo "<td>".$row['status']."</td>";
                        echo "<td>
                                <a href='view_book_request.php?action=accept&id=".$row['rb_id']."' class='btn btn-success'>Accept</a>
                                <a href='view_book_request.php?action=decline&id=".$row['rb_id']."' class='btn btn-danger'>Decline</a>
                              </td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>

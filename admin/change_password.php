<?php
require("functions.php");
session_start();

// Check if the user is logged in and has the correct role
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

if (isset($_POST['update'])) {
    // Get the input values
    $adminEmail = $_POST['adminEmail'];
    $oldPassword = $_POST['old_password'];
    $newPassword = $_POST['new_password'];

    // Database connection
    $connection = mysqli_connect("localhost", "root", "", "lms");

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        exit();
    }

    // Prepare the query to fetch the user record
    $query = "SELECT password FROM users WHERE email = ?";
    $stmt = mysqli_prepare($connection, $query);
    mysqli_stmt_bind_param($stmt, "s", $adminEmail);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $hashedPassword);
    mysqli_stmt_fetch($stmt);
    mysqli_stmt_close($stmt);

    // Verify the old password
    if (password_verify($oldPassword, $hashedPassword)) {
        // Validate the new password
        $passwordPattern = '/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';

        if (preg_match($passwordPattern, $newPassword)) {
            // Hash the new password
            $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

            // Update the password
            $updateQuery = "UPDATE users SET password = ? WHERE email = ?";
            $updateStmt = mysqli_prepare($connection, $updateQuery);
            mysqli_stmt_bind_param($updateStmt, "ss", $newHashedPassword, $adminEmail);
            $success = mysqli_stmt_execute($updateStmt);
            mysqli_stmt_close($updateStmt);

            if ($success) {
                echo '<script type="text/javascript">';
                echo 'alert("Password updated successfully!");';
                echo 'window.location.href = "admin_dashboard.php";';
                echo '</script>';
            } else {
                echo '<script type="text/javascript">';
                echo 'alert("Error updating password!");';
                echo '</script>';
            }
        } else {
            echo '<script type="text/javascript">';
            echo 'alert("New password must contain at least one uppercase letter, one number, and one special character.");';
            echo 'window.location.href = "change_password.php";';
            echo '</script>';
        }
    } else {
        echo '<script type="text/javascript">';
        echo 'alert("Old password is incorrect!");';
        echo '</script>';
    }

    mysqli_close($connection);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
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
    <center><h4 style="color: blue;"><b>Change Admin Password</b></h4><br></center>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form action="change_password.php" method="post">
                <input type="text" class="form-control" name="adminEmail" id="adminEmail" value="<?php echo $_SESSION['email']; ?>" hidden>
                <div class="form-group">
                    <label for="old_password"><b>Enter Old Password:</b></label>
                    <input type="password" class="form-control" name="old_password" required>
                </div>
                <div class="form-group">
                    <label for="new_password"><b>Enter New Password:</b></label>
                    <input type="password" name="new_password" class="form-control" required>
                </div>
                <button type="submit" name="update" class="btn btn-primary">Update Password</button>
                <a href="admin_dashboard.php" class="btn btn-danger">Cancel</a>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
</body>
</html>

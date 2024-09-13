<?php
session_start();

$connection = mysqli_connect("localhost", "root", "", "lms");

if (isset($_POST['reset_password'])) {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_SESSION['email'];

    // Validate new password
    $passwordPattern = '/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';

    if ($new_password !== $confirm_password) {
        echo '<center><div class="alert alert-danger">Passwords do not match!</div></center>';
    } elseif (!preg_match($passwordPattern, $new_password)) {
        echo '<center><div class="alert alert-danger">Password must be at least 8 characters long, contain at least one uppercase letter, one number, and one special character.</div></center>';
    } else {
        // Update password
        $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $update_query = "UPDATE users SET password = '$new_hashed_password' WHERE email = '$email'";
        $update_query_run = mysqli_query($connection, $update_query);

        if ($update_query_run) {
            echo '<center><div class="alert alert-success">Password updated successfully!</div></center>';
        } else {
            echo '<center><div class="alert alert-danger">Failed to update password!</div></center>';
        }
    }
}
if (isset($_POST['reset_password'])) {
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];
    $email = $_SESSION['email'];

    // Validate new password
    $passwordPattern = '/^(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';

    if ($new_password !== $confirm_password) {
        echo '<center><div class="alert alert-danger mt-3">Passwords do not match!</div></center>';
    } elseif (!preg_match($passwordPattern, $new_password)) {
        echo '<center><div class="alert alert-danger mt-3">Password must be at least 8 characters long, contain at least one uppercase letter, one number, and one special character.</div></center>';
    } else {
        // Update password
        $new_hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $update_query = "UPDATE users SET password = '$new_hashed_password' WHERE email = '$email'";
        $update_query_run = mysqli_query($connection, $update_query);

        if ($update_query_run) {
            // Display success message and redirect
            echo '
            <center>
                <div class="alert alert-success mt-3" role="alert" style="font-size: 18px; max-width: 500px;">
                    <strong>Password updated successfully!</strong><br>
                    You will be redirected to the homepage in a few seconds...
                    <div class="spinner-border text-success" role="status" style="margin-top: 10px;">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </center>';
            header("refresh:3;url=index.php"); // Redirect after 3 seconds to index.php
            exit(); // Ensure script stops executing after redirection
        } else {
            echo '<center><div class="alert alert-danger mt-3">Failed to update password!</div></center>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Reset Password</title>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap-4.4.1/css/bootstrap.min.css">
    <script src="bootstrap-4.4.1/js/jquery_latest.js"></script>
    <script src="bootstrap-4.4.1/js/bootstrap.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 500px;
            margin-top: 50px;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        h2 {
            text-align: center;
            color: #343a40;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-control {
            border-radius: 5px;
        }

        .btn-primary {
            width: 100%;
            background-color: #007bff;
            border: none;
            padding: 10px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .alert {
            margin-top: 20px;
            font-size: 14px;
            text-align: center;
        }

        .navbar-brand {
            font-weight: bold;
            font-size: 1.5em;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php" style="color:yellow;">Library Management System (LMS)</a>
        </div>
    </nav>
    <br>
    <div class="container">
        <h2>Reset Password</h2>
        <form action="" method="post" onsubmit="return validatePasswords();">
            <div class="form-group">
                <label for="new_password"><b>New Password:</b></label>
                <input type="password" name="new_password" id="new_password" class="form-control" required placeholder="Enter new password">
            </div>
            <div class="form-group">
                <label for="confirm_password"><b>Confirm Password:</b></label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" required placeholder="Confirm new password">
            </div>
            <button type="submit" name="reset_password" class="btn btn-primary">Reset Password</button>
        </form>
    </div>

    <script>
        function validatePasswords() {
            var newPassword = document.getElementById('new_password').value;
            var confirmPassword = document.getElementById('confirm_password').value;

            if (newPassword !== confirmPassword) {
                alert("Passwords do not match!");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>

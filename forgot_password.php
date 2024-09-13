<?php
require 'vendor/autoload.php';
require 'send_otp.php'; // Include the send_otp.php file

session_start();

$connection = mysqli_connect("localhost", "root", "", "lms");

if (isset($_POST['send_otp'])) {
    $email = $_POST['email'];
    $query = "SELECT * FROM users WHERE email = '$email'";
    $query_run = mysqli_query($connection, $query);

    if (mysqli_num_rows($query_run) > 0) {
        // Generate OTP
        $otp = rand(100000, 999999);
        $_SESSION['otp'] = $otp;
        $_SESSION['email'] = $email;

        // Send OTP
        if (sendOTP($email, $otp)) {
            echo '<center><div class="alert alert-success">OTP sent to your email!</div></center>';
        } else {
            echo '<center><div class="alert alert-danger">Failed to send OTP!</div></center>';
        }
    } else {
        echo '<center><div class="alert alert-danger">Email does not exist!</div></center>';
    }
}

if (isset($_POST['verify_otp'])) {
    $enteredOtp = $_POST['otp'];
    $email = $_SESSION['email'];

    if ($enteredOtp == $_SESSION['otp']) {
        echo '<center><div class="alert alert-success">OTP verified! You can now reset your password.</div></center>';
        // Redirect to the password reset form
        header("Location: reset_password.php");
    } else {
        echo '<center><div class="alert alert-danger">Invalid OTP!</div></center>';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="bootstrap-4.4.1/css/bootstrap.min.css">
    <script type="text/javascript" src="bootstrap-4.4.1/js/jquery_latest.js"></script>
    <script type="text/javascript" src="bootstrap-4.4.1/js/bootstrap.min.js"></script>
    <style>
        body {
            background-color: #f4f7f6;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 500px;
            margin-top: 50px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h2 {
            text-align: center;
            color: #343a40;
            margin-bottom: 30px;
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
        <h2>Forgot Password</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="email"><b>Email Address:</b></label>
                <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
            </div>
            <button type="submit" name="send_otp" class="btn btn-primary">Send OTP</button>
        </form>

        <br>

        <form action="" method="post">
            <div class="form-group">
                <label for="otp"><b>Enter OTP:</b></label>
                <input type="text" name="otp" class="form-control" placeholder="Enter the OTP" required>
            </div>
            <button type="submit" name="verify_otp" class="btn btn-primary">Verify OTP</button>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('form').on('submit', function() {
                // Optional: You can add a loading spinner or disable the button while processing
                $(this).find('button').attr('disabled', true).text('Processing...');
            });
        });
    </script>
</body>
</html>

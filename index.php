<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>LMS</title>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="bootstrap-4.4.1/css/bootstrap.min.css">
    <script type="text/javascript" src="bootstrap-4.4.1/js/jquery_latest.js"></script>
    <script type="text/javascript" src="bootstrap-4.4.1/js/bootstrap.min.js"></script>
    <style type="text/css">
        /* Add background image with blur */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('books2.jpg');
            background-size: cover;
            background-position: center;
            filter: blur(10px);
            opacity: 0.6;
            z-index: -1;
        }

        #main_content {
            padding: 50px;
            background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent background for readability */
        }

        #side_bar {
            background-color: rgba(255, 255, 255, 0.9); /* Matching semi-transparent background */
            padding: 20px;
        }

        #login_form {
            background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent background for readability */
            padding: 50px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="index.php" style="color:white;"><b>Library Management System (LMS)</b></a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item">
                    <a class="nav-link" href="about.php" style="color:white;"><b>About Us</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="help.php" style="color:white;"><b>Help/Support</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="signup.php" style="color:#00C957;"><b>Register</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php" style="color:#00C957;"><b>Login</b></a>
                </li>
            </ul>
        </div>
    </nav>
    <br>
    <br><br>
    <div class="container">
        <div class="row">
            <!-- Left side image -->
            <div class="col-md-6">
                <img src="books.jpg" class="img-fluid" alt="Library Image" />
            </div>

            <!-- Right side login form -->
            <div class="col-md-6" id="login_form">
                <center>
                    <h3 style="color:blue;"><b>Login Form</b></h3>
                </center>
                <form action="authenticate.php" method="post">
                    <div class="form-group">
                        <label for="email"><b>Email:</b></label>
                        <input type="text" name="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="password"><b>Password:</b></label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" name="login" class="btn btn-success">Login</button>
                    <a href="signup.php" style="color:red;"><b>Not registered yet?</b></a> |
                    <a href="forgot_password.php" style="color:blue;"><u>Forgot Password</u></a>
                </form>
                <!-- Library timing and services -->
                <div id="side_bar">
                    <h5>Library Timing</h5>
                    <ul>
                        <li>Opening: 8:00 AM</li>
                        <li>Closing: 5:00 PM</li>
                        <li>(Sunday Off)</li>
                    </ul>
                    <h5>What We Provide?</h5>
                    <ul>
                        <li>Free Wi-fi</li>
                        <li>News Papers</li>
                        <li>Discussion Room</li>
                        <li>Peaceful Environment</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="bootstrap-4.4.1/css/bootstrap.min.css">
    <script type="text/javascript" src="bootstrap-4.4.1/js/jquery_latest.js"></script>
    <script type="text/javascript" src="bootstrap-4.4.1/js/bootstrap.min.js"></script>
    <script>
        function validatePassword() {
            var password = document.getElementById("new_password").value;
            var message = "";
            var hasUpperCase = /[A-Z]/.test(password);
            var hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password);
            var hasNumber = /[0-9]/.test(password);

            if (!hasUpperCase) {
                message += "Password must contain at least one uppercase letter.\n";
            }
            if (!hasSpecialChar) {
                message += "Password must contain at least one special character.\n";
            }
            if (!hasNumber) {
                message += "Password must contain at least one number.\n";
            }
            if (message) {
                alert(message);
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="user_dashboard.php" style="color: yellow;">Library Management System (LMS)</a>
            </div>
            <font style="color: white">
                <span><strong>Welcome: <?php echo $_SESSION['name']; ?></strong></span>
            </font>
            <font style="color: white">
                <span><strong>Email: <?php echo $_SESSION['email']; ?></strong></span>
            </font>
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
                    <a class="nav-link" href="logout.php" style="color: red;"><b>Logout</b></a>
                </li>
            </ul>
        </div>
    </nav><br>
    <center><b><h4 style="color: blue;">Change User Password</h4></b><br></center>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form action="update_password.php" method="post" onsubmit="return validatePassword()">
                <div class="form-group">
                    <label for="old_password"><b>Enter Old Password:</b></label>
                    <input type="password" class="form-control" name="old_password" required>
                </div>
                <div class="form-group">
                    <label for="new_password"><b>Enter New Password:</b></label>
                    <input type="password" name="new_password" class="form-control" id="new_password" required>
                </div>
                <button type="submit" name="update" class="btn btn-primary">Update Password</button>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>LMS</title>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="bootstrap-4.4.1/css/bootstrap.min.css">
    <script type="text/javascript" src="bootstrap-4.4.1/js/jquery_latest.js"></script>
    <script type="text/javascript" src="bootstrap-4.4.1/js/bootstrap.min.js"></script>
</head>
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
        background-image: url('reg.jpg'); /* Replace with your image path */
        background-size: cover;
        background-position: center;
        filter: blur(10px);
        opacity: 0.8;
        z-index: -1;
    }

    #main_content {
        padding: 50px;
        background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent background for readability */
        border-radius: 10px;
    }

    .navbar-brand {
        color: yellow;
    }

    .navbar-nav .nav-link {
        color: white;
    }

    .navbar-nav .nav-link:hover {
        color: #00C957;
    }

    .btn-primary {
        background-color: #00C957;
        border-color: #00C957;
    }

    .btn-primary:hover {
        background-color: #028a40;
        border-color: #028a40;
    }

    .form-column {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .image-column img {
        max-width: 100%;
        height: auto;
        border-radius: 10px;
    }

    .form-container {
        width: 100%;
        max-width: 600px; /* Optional: Limit the maximum width of the form container */
    }
</style>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="signup.php"><b>Library Management System (LMS)</b></a>
            </div>
            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item">
                    <a class="nav-link" href="about.php"><b>About Us</b></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="help.php"><b>Help/Support</b></a>
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
    <div class="container">
        <div class="row">
            <!-- Left column with image -->
            <div class="col-md-6 image-column">
                <img src="reg.jpg" alt="Library Image"> <!-- Replace with your image path -->
            </div>

            <!-- Right column with form -->
            <div class="col-md-6 form-column">
                <div id="main_content" class="form-container">
                    <center>
                        <h3 style="color:blue;"><b>User Registration Form</b></h3>
                    </center>
                    <form action="register.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                        <div class="form-group">
                            <label for="name"><b>Full Name:</b></label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email"><b>Email:</b></label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password"><b>Password:</b></label>
                            <input type="password" id="password" name="password" class="form-control" required>
                            <small id="passwordHelp" class="form-text text-muted">Password must be at least 8 characters long, contain one uppercase letter, and one special character.</small>
                        </div>
                        <div class="form-group">
                            <label for="mobile"><b>Mobile:</b></label>
                            <input type="text" name="mobile" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="address"><b>Address:</b></label>
                            <textarea name="address" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="photo">Photo:</label>
                            <input type="file" name="photo" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="reg_date"><b>Registration Date:</b></label>
                            <input type="date" id="reg_date" name="reg_date" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            var today = new Date().toISOString().split('T')[0];
            document.getElementById('reg_date').value = today;
            document.getElementById('reg_date').setAttribute('min', today);
            document.getElementById('reg_date').setAttribute('max', today);
        });

        function validateForm() {
            var password = document.getElementById('password').value;
            var passwordPattern = /^(?=.*[A-Z])(?=.*[\W_]).{8,}$/; // At least one uppercase letter, one special character, and 8 characters long
            
            if (!passwordPattern.test(password)) {
                alert('Password must be at least 8 characters long, contain one uppercase letter, and one special character.');
                return false; // Prevent form submission
            }
            return true; // Allow form submission
        }
    </script>
</body>
</html>

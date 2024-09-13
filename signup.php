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
    #main_content {
        padding: 50px;
        background-color: whitesmoke;
    }
    #side_bar {
        background-color: whitesmoke;
        padding: 50px;
        width: 300px;
        height: 450px;
    }
</style>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="signup.php" style="color:yellow;">Library Management System (LMS)</a>
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
    </nav><br>
    <span><marquee><b>Library Management System | Brought to you by <span style="color:red;">Tech Alliance</span>.</b></marquee></span><br><br>
    <div class="row">
        <div class="col-md-4" id="side_bar">
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
        <div class="col-md-8" id="main_content">
            <center><h3 style="color:blue;">User Registration Form</h3></center>
            <form action="register.php" method="post" enctype="multipart/form-data">
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
                    <input type="password" name="password" class="form-control" required>
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
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            var today = new Date().toISOString().split('T')[0];
            document.getElementById('reg_date').value = today;
            document.getElementById('reg_date').setAttribute('min', today);
            document.getElementById('reg_date').setAttribute('max', today);
        });
    </script>
</body>
</html>
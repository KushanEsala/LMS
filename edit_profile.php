<?php
session_start();

$connection = mysqli_connect("localhost", "root", "", "lms");
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch user data
$name = $email = $mobile = $address = $photo = "";
$query = "SELECT * FROM users WHERE email = ?";
$stmt = mysqli_prepare($connection, $query);
mysqli_stmt_bind_param($stmt, "s", $_SESSION['email']);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    $name = $row['name'];
    $email = $row['email'];
    $mobile = $row['mobile'];
    $address = $row['address'];
    $photo = $row['photo']; // Current profile photo
}

mysqli_stmt_close($stmt);
mysqli_close($connection);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Edit Profile</title>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="bootstrap-4.4.1/css/bootstrap.min.css">
    <script type="text/javascript" src="bootstrap-4.4.1/js/jquery_latest.js"></script>
    <script type="text/javascript" src="bootstrap-4.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="user_dashboard.php" style="color: yellow;">Library Management System(LMS)</a>
            </div>
            <font style="color: white;"><span><strong>Welcome: <?php echo $_SESSION['name']; ?></strong></span></font>
            <font style="color: white;"><span><strong>Email: <?php echo $_SESSION['email']; ?></strong></span></font>
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
    <center>
        <h4 style="color: blue;"><b>Edit Profile</b></h4><br>
    </center>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form action="update_profile.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="name"><b>Name:</b></label>
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>" required>
                </div>
                <div class="form-group">
                    <label for="email"><b>Email:</b></label>
                    <input type="email" name="email" class="form-control" value="<?php echo $email; ?>" required>
                </div>
                <div class="form-group">
                    <label for="mobile"><b>Mobile:</b></label>
                    <input type="text" name="mobile" class="form-control" value="<?php echo $mobile; ?>" required>
                </div>
                <div class="form-group">
                    <label for="address"><b>Address:</b></label>
                    <textarea rows="3" cols="40" name="address" class="form-control"
                        required><?php echo $address; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="photo"><b>Current Photo:</b></label><br>
                    <?php if (!empty($photo)): ?>
                        <img src="<?php echo $photo; ?>" alt="Current Photo" style="max-width: 200px; max-height: 200px;">
                    <?php else: ?>
                        <p>No photo uploaded.</p>
                    <?php endif; ?>
                    <br><br>
                    <label for="new_photo"><b>New Photo:</b></label>
                    <input type="file" name="new_photo" class="form-control-file">
                </div>
                <button type="submit" name="update" class="btn btn-primary">Update</button>
            </form>

        </div>
        <div class="col-md-4"></div>
    </div>
</body>

</html>
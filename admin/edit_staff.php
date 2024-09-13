<?php
session_start();

$connection = mysqli_connect("localhost", "root", "", "lms");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$book_name = "";
$book_no = "";
$author_id = "";
$cat_id = "";
$book_price = "";

if (isset($_GET['bn'])) {
    $query = "SELECT * FROM staff WHERE s_id = {$_GET['bn']}";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        while ($row = mysqli_fetch_assoc($query_run)) {
            $name = $row['name'];
            $email = $row['email'];
            $mobile = $row['mobile'];
            $address = $row['address'];
            $job_role = $row['job_role'];
            $salary = $row['salary'];
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Staff Members</title>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../bootstrap-4.4.1/css/bootstrap.min.css">
    <script type="text/javascript" src="../bootstrap-4.4.1/js/jquery_latest.js"></script>
    <script type="text/javascript" src="../bootstrap-4.4.1/js/bootstrap.min.js"></script>
</head>
<body>
    <!-- Your navigation bar -->
    <!-- ... -->

    <center><h4 style="color: blue;"><b>Edit Staff Members</b></h4><br></center>
    <div class="row">
        <div class="col-md-4"></div>
        <div class="col-md-4">
            <form action="" method="post">
                <div class="form-group">
                    <label for="name"><b>Name:</b></label>
                    <input type="text" name="name" value="<?php echo $name; ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email"><b>Email:</b></label>
                    <input type="text" name="email" value="<?php echo $email; ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="mobile"><b>Mobile:</b></label>
                    <input type="text" name="mobile" value="<?php echo $mobile; ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="address"><b>Address:</b></label>
                    <textarea name="address" class="form-control" required><?php echo $address; ?></textarea>
                </div>
                <div class="form-group">
                    <label for="job_role"><b>Job Role:</b></label>
                    <input type="text" name="job_role" value="<?php echo $job_role; ?>" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="salary"><b>Salary:</b></label>
                    <input type="text" name="salary" value="<?php echo $salary; ?>" class="form-control" required>
                </div>
                <button type="submit" name="update" class="btn btn-primary">Update Staff</button>
                <button type="refresh" name="refresh" class="btn btn-success">Refresh</button>
                <a href="admin_dashboard.php" class="btn btn-danger">Cancel</a>
            </form>
        </div>
        <div class="col-md-4"></div>
    </div>
</body>
</html>

<?php
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $job_role = $_POST['job_role'];
    $salary = $_POST['salary'];

    $query = "UPDATE staff SET name = '$name', email = '$email', mobile = '$mobile', address = '$address', job_role = '$job_role', salary = '$salary' WHERE s_id = {$_GET['bn']}";
    $query_run = mysqli_query($connection, $query);

    if ($query_run) {
        echo '<script>window.onload = function() { alert("Member updated successfully."); }</script>';
    } else {
        echo '<script>window.onload = function() { alert("Error updating member."); }</script>';
    }
}

mysqli_close($connection);
?>

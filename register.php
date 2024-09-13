<?php
$connection = mysqli_connect("localhost", "root", "", "lms");

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Handle the uploaded file
$photo_name = $_FILES['photo']['name'];
$photo_tmp_name = $_FILES['photo']['tmp_name'];
$photo_size = $_FILES['photo']['size'];
$photo_error = $_FILES['photo']['error'];
$photo_type = $_FILES['photo']['type'];

$photo_ext = explode('.', $photo_name);
$photo_actual_ext = strtolower(end($photo_ext));
$allowed = array('jpg', 'jpeg', 'png', 'gif');

if (in_array($photo_actual_ext, $allowed)) {
    if ($photo_error === 0) {
        if ($photo_size < 5000000) {
            $photo_name_new = uniqid('', true) . "." . $photo_actual_ext;
            $photo_destination = 'uploads/' . $photo_name_new;
            move_uploaded_file($photo_tmp_name, $photo_destination);
        } else {
            echo "Your file is too big!";
            exit();
        }
    } else {
        echo "There was an error uploading your file!";
        exit();
    }
} else {
    echo "You cannot upload files of this type!";
    exit();
}

// Hash the password
$hashed_password = password_hash($_POST['password'], PASSWORD_BCRYPT);

// Prepare INSERT statement
$query = "INSERT INTO users (name, email, password, mobile, address, photo, reg_date, role) VALUES (?, ?, ?, ?, ?, ?, ?, 'user')";
$stmt = mysqli_prepare($connection, $query);

// Bind parameters
mysqli_stmt_bind_param($stmt, "sssssss", $_POST['name'], $_POST['email'], $hashed_password, $_POST['mobile'], $_POST['address'], $photo_destination, $_POST['reg_date']);

// Execute statement
$success = mysqli_stmt_execute($stmt);

// Check for success
if ($success) {
    echo '<script type="text/javascript">';
    echo 'alert("Registration successful... You may login now!");';
    echo 'window.location.href = "index.php";';
    echo '</script>';
} else {
    echo "Error: " . mysqli_error($connection);
}

// Clean up
mysqli_stmt_close($stmt);
mysqli_close($connection);
?>

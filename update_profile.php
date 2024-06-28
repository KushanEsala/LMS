<?php
session_start();

$connection = mysqli_connect("localhost", "root", "", "lms");
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    $new_photo = '';

    // Debugging statements
    echo "Name: $name<br>";
    echo "Email: $email<br>";
    echo "Mobile: $mobile<br>";
    echo "Address: $address<br>";
    echo "Session Email: " . $_SESSION['email'] . "<br>";

    // Handle file upload (new photo)
    if ($_FILES['new_photo']['name'] != '') {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["new_photo"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is an actual image or fake image
        $check = getimagesize($_FILES["new_photo"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".<br>";
            $uploadOk = 1;
        } else {
            echo "File is not an image.<br>";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.<br>";
            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["new_photo"]["size"] > 500000) {
            echo "Sorry, your file is too large.<br>";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.<br>";
        } else {
            if (move_uploaded_file($_FILES["new_photo"]["tmp_name"], $target_file)) {
                $new_photo = $target_file;
                echo "New photo uploaded: " . $new_photo . "<br>"; // Debugging output
            } else {
                echo "Sorry, there was an error uploading your file.<br>";
            }
        }
    }

    // Update user profile including photo if a new photo was uploaded
    if ($new_photo != '') {
        $query = "UPDATE users SET name=?, email=?, mobile=?, address=?, photo=? WHERE email=?";
        $stmt = mysqli_prepare($connection, $query);
        if ($stmt === false) {
            echo "Error preparing statement: " . mysqli_error($connection) . "<br>";
        }
        mysqli_stmt_bind_param($stmt, "ssssss", $name, $email, $mobile, $address, $new_photo, $_SESSION['email']);
    } else {
        $query = "UPDATE users SET name=?, email=?, mobile=?, address=? WHERE email=?";
        $stmt = mysqli_prepare($connection, $query);
        if ($stmt === false) {
            echo "Error preparing statement: " . mysqli_error($connection) . "<br>";
        }
        mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $mobile, $address, $_SESSION['email']);
    }

    if (mysqli_stmt_execute($stmt)) {
        echo '<script>alert("Profile updated successfully."); window.location.href="view_profile.php";</script>';
    } else {
        echo "Error updating profile: " . mysqli_stmt_error($stmt) . "<br>";
    }

    mysqli_stmt_close($stmt);
}

mysqli_close($connection);
?>

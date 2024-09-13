<?php
session_start();
$connection = mysqli_connect("localhost", "root", "", "lms");

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

$email = mysqli_real_escape_string($connection, $_SESSION['email']);
$oldPassword = mysqli_real_escape_string($connection, $_POST['old_password']);
$newPassword = mysqli_real_escape_string($connection, $_POST['new_password']);

// Fetch user data
$query = "SELECT * FROM users WHERE email = '$email'";
$query_run = mysqli_query($connection, $query);

if ($row = mysqli_fetch_assoc($query_run)) {
    $passwordFromDB = $row['password'];

    // Verify the old password
    if (password_verify($oldPassword, $passwordFromDB)) {
        // Validate new password
        $hasUpperCase = preg_match('/[A-Z]/', $newPassword);
        $hasSpecialChar = preg_match('/[!@#$%^&*(),.?":{}|<>]/', $newPassword);
        $hasNumber = preg_match('/[0-9]/', $newPassword);

        if ($hasUpperCase && $hasSpecialChar && $hasNumber) {
            // Hash new password
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $updateQuery = "UPDATE users SET password = '$hashedPassword' WHERE email = '$email'";
            $updateQuery_run = mysqli_query($connection, $updateQuery);

            if ($updateQuery_run) {
                // Password updated successfully
                echo '<script type="text/javascript">
                    alert("Password updated successfully");
                    window.location.href = "user_dashboard.php";
                </script>';
            } else {
                // Failed to update password
                echo '<script type="text/javascript">
                    alert("Failed to update password");
                    window.location.href = "change_password.php";
                </script>';
            }
        } else {
            // New password validation failed
            echo '<script type="text/javascript">
                alert("New password must contain at least one uppercase letter, one special character, and one number.");
                window.location.href = "change_password.php";
            </script>';
        }
    } else {
        // Old password does not match
        echo '<script type="text/javascript">
            alert("Old password is incorrect.");
            window.location.href = "change_password.php";
        </script>';
    }
} else {
    // No user found with the provided email
    echo '<script type="text/javascript">
        alert("User not found.");
        window.location.href = "change_password.php";
    </script>';
}

mysqli_close($connection);
?>

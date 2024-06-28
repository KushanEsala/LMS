<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $connection = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($connection, "lms");

    // Retrieve form data
    $adminEmail = $_POST['adminEmail'];
    $oldPassword = $_POST['old_password'];
    $newPassword = $_POST['new_password'];

    // Verify the old password for security
    $query = "SELECT * FROM admins WHERE email = '$adminEmail' AND password = '$oldPassword'";
    $result = mysqli_query($connection, $query);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        // Old password matches, update the password
        $updateQuery = "UPDATE admins SET password = '$newPassword' WHERE email = '$adminEmail'";
        $updateResult = mysqli_query($connection, $updateQuery);

        if ($updateResult) {
            echo "<script>alert('Password updated successfully.');
            window.location.href = 'change_password.php';</script>";
            // Redirect the user after displaying the alert message
        } else {
            echo "<script>alert('Failed to update password.');
            window.location.href = 'change_password.php';</script>";
            // Redirect the user after displaying the alert message
        }
    } else {
        echo "<script>alert('Old password is incorrect.');
        window.location.href = 'change_password.php';</script>";
        // Redirect the user after displaying the alert message
    }

    mysqli_close($connection);
}
?>

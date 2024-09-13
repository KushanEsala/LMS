<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $connection = mysqli_connect("localhost", "root", "", "lms");

    // Retrieve form data
    $adminEmail = $_POST['adminEmail'];
    $oldPassword = $_POST['old_password'];
    $newPassword = $_POST['new_password'];

    // Verify the old password for security in the admins table
    $query = "SELECT * FROM admins WHERE email = '$adminEmail' AND password = '$oldPassword'";
    $result = mysqli_query($connection, $query);
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        // Old password matches, update the password in the admins table
        $updateQuery = "UPDATE admins SET password = '$newPassword' WHERE email = '$adminEmail'";
        $updateResult = mysqli_query($connection, $updateQuery);

        // Update the password in the users table where role is 'admin'
        $updateUserQuery = "UPDATE users SET password = '$newPassword' WHERE email = '$adminEmail' AND role = 'admin'";
        $updateUserResult = mysqli_query($connection, $updateUserQuery);

        if ($updateResult && $updateUserResult) {
            echo "<script>alert('Password updated successfully.');
            window.location.href = 'change_password.php';</script>";
        } else {
            echo "<script>alert('Failed to update password.');
            window.location.href = 'change_password.php';</script>";
        }
    } else {
        echo "<script>alert('Old password is incorrect.');
        window.location.href = 'change_password.php';</script>";
    }

    mysqli_close($connection);
}
?>

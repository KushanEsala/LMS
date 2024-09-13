<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lms";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare and execute query
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Verify password
        if (password_verify($password, $row['password'])) {
            // Password is correct, start session and redirect
            session_start();
            $_SESSION['name'] = $row['name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['role'] = $row['role'];

            if ($_SESSION['role'] == "super_admin") {
                header("Location: super_admin/super_admin_dashboard.php");
            } else if ($_SESSION['role'] == "admin") {
                header("Location: admin/admin_dashboard.php");
            } else {
                header("Location: user_dashboard.php");
            }
            exit();
        } else {
            echo '<br><br><center><span class="alert-danger">Wrong Password !!</span></center>';
        }
    } else {
        echo '<br><br><center><span class="alert-danger">No user found with this email!</span></center>';
    }

    $stmt->close();
}

$conn->close();
?>

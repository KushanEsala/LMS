<?php
	session_start();
	$connection = mysqli_connect("localhost","root","");
	$db = mysqli_select_db($connection,"lms");

	$email = mysqli_real_escape_string($connection, $_SESSION['email']);
	$newPassword = mysqli_real_escape_string($connection, $_POST['new_password']);

	$query = "SELECT * FROM users WHERE email = '$email'";
	$query_run = mysqli_query($connection,$query);

	if ($row = mysqli_fetch_assoc($query_run)) {
		$passwordFromDB = $row['password'];

		// Verify if the entered password matches the one in the database
		if(password_verify($newPassword, $passwordFromDB)) {
			// Password matches - redirect to dashboard or perform necessary actions
			?>
			<script type="text/javascript">
				alert("Please enter a different password from the current one.");
				window.location.href = "change_password.php";
			</script>
			<?php
		} else {
			// Proceed to update the password
			$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
			$updateQuery = "UPDATE users SET password = '$newPassword' WHERE email = '$email'";
			$updateQuery_run = mysqli_query($connection, $updateQuery);

			if ($updateQuery_run) {
				// Password updated successfully
				?>
				<script type="text/javascript">
					alert("Password updated successfully");
					window.location.href = "user_dashboard.php";
				</script>
				<?php
			} else {
				// Failed to update password
				?>
				<script type="text/javascript">
					alert("Failed to update password");
					window.location.href = "change_password.php";
				</script>
				<?php
			}
		}
	} else {
		// No user found with the provided email
		?>
		<script type="text/javascript">
			alert("User not found");
			window.location.href = "change_password.php";
		</script>
		<?php
	}
?>


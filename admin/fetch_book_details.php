<?php
$connection = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connection, "lms");

if (isset($_POST['book_name'])) {
	$book_name = mysqli_real_escape_string($connection, $_POST['book_name']);
	$query = "SELECT isbn_no, author_name FROM books WHERE book_name = '$book_name'";
	$query_run = mysqli_query($connection, $query);
	$result = mysqli_fetch_assoc($query_run);

	if ($result) {
		// Return success and book details as JSON
		echo json_encode([
			'success' => true,
			'isbn_no' => $result['isbn_no'],
			'author_name' => $result['author_name']
		]);
	} else {
		// If no book details are found
		echo json_encode(['success' => false]);
	}
}
?>

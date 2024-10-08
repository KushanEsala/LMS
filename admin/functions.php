<?php
	function get_author_count(){
		$connection = mysqli_connect("localhost","root","");
		$db = mysqli_select_db($connection,"lms");
		$author_count = 0;
		$query = "select count(*) as author_count from authors";
		$query_run = mysqli_query($connection,$query);
		while ($row = mysqli_fetch_assoc($query_run)){
			$author_count = $row['author_count'];
		}
		return($author_count);
	}

	function get_user_count(){
		$connection = mysqli_connect("localhost","root","");
		$db = mysqli_select_db($connection,"lms");
		$user_count = 0;
		$query = "select count(*) as user_count from users";
		$query_run = mysqli_query($connection,$query);
		while ($row = mysqli_fetch_assoc($query_run)){
			$user_count = $row['user_count'];
		}
		return($user_count);
	}

	function get_book_count(){
		$connection = mysqli_connect("localhost","root","");
		$db = mysqli_select_db($connection,"lms");
		$book_count = 0;
		$query = "select count(*) as book_count from books";
		$query_run = mysqli_query($connection,$query);
		while ($row = mysqli_fetch_assoc($query_run)){
			$book_count = $row['book_count'];
		}
		return($book_count);
	}

	function get_issue_book_count(){
		$connection = mysqli_connect("localhost","root","");
		$db = mysqli_select_db($connection,"lms");
		$issue_book_count = 0;
		$query = "select count(*) as issue_book_count from issued_books";
		$query_run = mysqli_query($connection,$query);
		while ($row = mysqli_fetch_assoc($query_run)){
			$issue_book_count = $row['issue_book_count'];
		}
		return($issue_book_count);
	}

	function get_category_count(){
		$connection = mysqli_connect("localhost","root","");
		$db = mysqli_select_db($connection,"lms");
		$cat_count = 0;
		$query = "select count(*) as cat_count from category";
		$query_run = mysqli_query($connection,$query);
		while ($row = mysqli_fetch_assoc($query_run)){
			$cat_count = $row['cat_count'];
		}
		return($cat_count);
	}

	function get_return_book_count(){
		$connection = mysqli_connect("localhost","root","");
		$db = mysqli_select_db($connection,"lms");
		$return_book_count = 0;
		$query = "select count(*) as return_book_count from returned_books";
		$query_run = mysqli_query($connection,$query);
		while ($row = mysqli_fetch_assoc($query_run)){
			$return_book_count = $row['return_book_count'];
		}
		return($return_book_count);
	}

	function get_staff_count(){
		$connection = mysqli_connect("localhost","root","");
		$db = mysqli_select_db($connection,"lms");
		$staff_count = 0;
		$query = "select count(*) as staff_count from staff";
		$query_run = mysqli_query($connection,$query);
		while ($row = mysqli_fetch_assoc($query_run)){
			$staff_count = $row['staff_count'];
		}
		return($staff_count);
	}
	function get_request_count(){
		$connection = mysqli_connect("localhost","root","");
		$db = mysqli_select_db($connection,"lms");
		$staff_count = 0;
		$query = "select count(*) as request_count from request_book";
		$query_run = mysqli_query($connection,$query);
		while ($row = mysqli_fetch_assoc($query_run)){
			$staff_count = $row['request_count'];
		}
		return($staff_count);
	}
	
	function acceptRequest($request_id) {
		$connection = mysqli_connect("localhost", "root", "", "lms");
		
		// Get the book request details
		$query = "SELECT * FROM request_book WHERE rb_id = '$request_id'";
		$result = mysqli_query($connection, $query);
		$row = mysqli_fetch_assoc($result);
		
		$book_name = $row['book_name'];
		$user_id = $row['user_id'];
		$issue_date = date("Y-m-d"); // Set current date as the issue date
		
		// Fetch ISBN number and author from the books table using the book name
		$book_query = "SELECT isbn_no, author_name FROM books WHERE book_name = '$book_name'";
		$book_result = mysqli_query($connection, $book_query);
		$book_row = mysqli_fetch_assoc($book_result);
		$isbn_no = $book_row['isbn_no'];
		$author = $book_row['author_name'];
		
		// Insert the issued book into issued_books table
		$insert_query = "INSERT INTO issued_books (isbn_no, book_name, book_author, user_id, status, issue_date)
						 VALUES ('$isbn_no', '$book_name', '$author', '$user_id', 1, '$issue_date')";
		mysqli_query($connection, $insert_query);
		
		// Update the request_book status to 'Accepted'
		$update_query = "UPDATE request_book SET status = 'Accepted' WHERE rb_id = '$request_id'";
		mysqli_query($connection, $update_query);
		
		mysqli_close($connection);
	}

	function declineRequest($request_id) {
		$connection = mysqli_connect("localhost", "root", "", "lms");
		$query = "UPDATE request_book SET status = 'Declined' WHERE rb_id = '$request_id'";
		mysqli_query($connection, $query);
		mysqli_close($connection);
	}
	
?>

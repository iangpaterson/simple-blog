<?php
	require('config/config.php');
	require('config/db.php');

	// Check for submit
	if(isset($_POST['submit'])) {
		//echo 'Submitted<br>';
		// Get form data
		$title = mysqli_real_escape_string($conn, $_POST['title']);
		$body = mysqli_real_escape_string($conn, $_POST['body']);
		$author = mysqli_real_escape_string($conn, $_POST['author']);

		$query = "
			INSERT INTO posts(title, body, author)
			VALUES('$title', '$body', '$author')
		";

		if (mysqli_query($conn, $query)) {
			header('Location: ' . ROOT_URL . '');
		} else {
			echo 'ERROR: ' . mysqli_error($conn);
		}
	}

?>
	<?php include('inc/header.php'); ?>
		<div class="container">
			<h1>Add Post</h1>
			<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
				<div class="form-group">
					<label>Title</label>
					<input class="form-control" type="text" name="title">
				</div>
				<div class="form-group">
					<label>Author</label>
					<input class="form-control" type="text" name="author">
				</div>
				<div class="form-group">
					<label>Body</label>
					<textarea class="form-control" name="body"></textarea>
				</div>
				<input class="btn btn-default" type="submit" name="submit" value="Submit">
			</form>
		</div>
	<?php include('inc/footer.php'); ?>
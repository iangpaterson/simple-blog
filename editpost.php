<?php
	require('config/config.php');
	require('config/db.php');

	// Check for submit
	if(isset($_POST['submit'])) {
		//echo 'Submitted<br>';
		// Get form data
		$update_id = mysqli_real_escape_string($conn, $_POST['update_id']);
		$title = mysqli_real_escape_string($conn, $_POST['title']);
		$body = mysqli_real_escape_string($conn, $_POST['body']);
		$author = mysqli_real_escape_string($conn, $_POST['author']);

		$query = "
			UPDATE posts SET
			title = '$title',
			body = '$body',
			author = '$author'
				WHERE id = {$update_id}
		";

		if (mysqli_query($conn, $query)) {
			header('Location: ' . ROOT_URL . '');
		} else {
			echo 'ERROR: ' . mysqli_error($conn);
		}
	}

	// Get id
	$id = mysqli_real_escape_string($conn, $_GET['id']); // Escapes special characters in a string for use in an SQL statement; a security measure

	// Create query
	$query = 'SELECT * FROM posts WHERE id = ' . $id;

	// Get result
	$result = mysqli_query($conn, $query);

	// Fetch data
	$post = mysqli_fetch_assoc($result);
	//var_dump($posts);

	// Free result
	mysqli_free_result($result);

	// Close connection
	mysqli_close($conn);

?>
	<?php include('inc/header.php'); ?>
		<div class="container">
			<h1>Add Post</h1>
			<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
				<div class="form-group">
					<label>Title</label>
					<input class="form-control" type="text" name="title" value="<?php echo $post['title']; ?>">
				</div>
				<div class="form-group">
					<label>Author</label>
					<input class="form-control" type="text" name="author" value="<?php echo $post['author']; ?>">
				</div>
				<div class="form-group">
					<label>Body</label>
					<textarea class="form-control" name="body"><?php echo $post['body']; ?></textarea>
				</div>
				<input type="hidden" name="update_id" value="<?php echo $post['id']; ?>">
				<input class="btn btn-default" type="submit" name="submit" value="Submit">
			</form>
		</div>
	<?php include('inc/footer.php'); ?>
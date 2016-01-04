<html>
	<head>
		<meta charset="UTF-8"/>
	</head>

	<body>
		<?php
		include "./auth/isLoggedIn.php";
		include "./database/connection.php";

		if( isLoggedIn() ) {
			
			$username = $_COOKIE["username"];
			$post_id = $_GET['id'];

			if(isset($_POST['update'])) {
				$title = $_POST['title'];
				$caption = $_POST['caption'];

				$query = "UPDATE posts SET title='$title', caption='$caption' WHERE post_id = $post_id";

				$retval = mysqli_query($mysqli, $query);

				if(! $retval ) {
					die('Could not update data: '.$mysqli->error);
				}

			} else {



				$query = "SELECT * FROM posts WHERE post_id = '$post_id';";
				$result = mysqli_query($mysqli, $query);

				$line = $result->fetch_object();
				$title = $line->title;
				$caption = $line->caption;

				?>
				<form id="updatePost" method="POST" action="<?php $_PHP_SELF ?>">
					<input type="text" id="title" name="title" value="<?php echo($title) ?>" />
					<input type="text" id="caption" name="caption" value="<?php echo($caption) ?>" />
					<input type="submit" id="update" name="update" value="Update"/>
				</form>

			<?php
			}

		}
		$mysqli->close();

		?>

	</body>
</html>



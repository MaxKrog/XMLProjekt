<!DOCTYPE html>
<html>
	<head>
		<title>Krizfeed </title>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
	</head>
	<body>

		<section class="container-fluid">
			<form action="../auth/login.php" type="POST">
				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" class="form-control" id="username" name="username">
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" class="form-control" id="password" name="password">
				</div>

				<button class="btn btn-warning">Back</button>
				<button type="submit" class="btn btn-success">Login</button>
			</form>
	
		</section>



		<script src="jquery.min.js" type="text/javascript"></script>
		<script src="upload.js" type="text/javascript"></script>

	</body>
</html>

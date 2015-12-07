<!DOCTYPE html>
<html>
	<head>
		<title>Krizfeed </title>
		<meta charset="UTF-8">
		<link rel="stylesheet" type="text/css" href="bootstrap.min.css">
	</head>
	<body>

		<section class="container-fluid">

			<header class="row">
				<nav class="navbar navbar-inverse navbar-static-top">
					<div class="container">
						<div class="navbar-header">
							<a class="navbar-brand" href="#">
								Krizfeed
							</a>
						</div>
						<nav class="nav navbar-nav">
							<li class="active"><a href="#"> Main</a></li>
							<li><a href="#"> Users</a> </li>
							<li><a href="#"> Tags</a>  </li>
						</nav>

						<ul class="nav navbar-nav navbar-right">
							
							<?php
								include "../auth/isLoggedIn.php";
								if(isLoggedIn()) { ?>
									<li><button type="button" class="btn btn-primary navbar-btn" id="addImage">Add Image</button></li>
									<li><button type="button" class="btn btn-primary navbar-btn">Logout</button></li>
								<?php } else { ?>
							<li><button type="button" class="btn btn-primary navbar-btn">Sign in</button></li>
							<?php } ?>
						</ul>
					</div>
				</nav>
			</header>


			<section class="row">
				<div class="container">
					<!-- LEFT COLUMN -->
					<div class="col-md-4">
						<div class="list-group">
							<a href="#" class="list-group-item active"> Cras justo odid</a>
							<a href="#" class="list-group-item">Dapibus ac facilisis in</a>
							<a href="#" class="list-group-item">Morbi leo risus</a>
							<a href="#" class="list-group-item">Porta ac consectetur ac</a>
							<a href="#" class="list-group-item">Vestibulum at eros</a>
						</div>
					</div>
					<!-- RIGHT (MAP) COLUMN -->
					<div class="col-md-8" id="map" style="min-height:500px">
					</div>
				</div>
			</section>
		</section>
		
		<div class="modal fade" tabindex="-1" role="dialog" id="addImageModal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Add Image</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" id="imageForm" enctype="multipart/form-data" method="POST" action="../imageupload.php" >
							<section class="form-group">	
								<label class="col-sm-2 control-label">Title</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="title" name="title" placeholder="Car on fire in rinkeby">
									</div>
							</section>
							<section class="form-group">
								<label for="inputPassword3" class="col-sm-2 control-label">Caption</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" id="caption" placeholder="The car is about to blow up!">
								</div>
							</section>
							<section class="form-group">
								<label for="image" class="col-sm-2 control-label">Choose Image</label>
								<div class="col-sm-10">
									<input type="file" id="image">
								</div>
							</section>
							<section class="form-group" id="form-tags">
								<label for="image" class="col-sm-2 control-label">Choose Tags</label>
								<div class="col-sm-10">
									<span class="label label-success" style="cursor: pointer;">Katter</span>
									<span class="label label-success" style="cursor: pointer;">Rinkeby</span>
									<span class="label label-default" style="cursor: pointer;">Katastrof</span>
									<span class="label label-default" style="cursor: pointer;">Uppror</span>
								</div>
							</section>
							<section class="form-group">
								<label class="col-sm-2 control-label">Position</label>
								<div class="col-sm-10" style="min-height: 130px" id="locationMap">
									
								</div>
							</section>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary" id="submit" > Submit </button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->


		<script src="jquery.min.js" type="text/javascript"></script>
		<script src="bootstrap.min.js" type="text/javascript"></script>
		<script src="app.js" type="text/javascript"></script>
		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5QnhfpQAZ6ZKD-4KR5gQVn4N3pcIs0cc&callback=createMainMap"></script>
	</body>
</html>

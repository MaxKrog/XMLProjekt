<?xml version="1.0"?>
<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="tags">

	<html>
		<head>
			<title>Krizfeed </title>
			<meta charset="UTF-8" />
			<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css"/>
		</head>
		<body>

			<section class="container-fluid">

				<div class="modal-header">
					<h4 class="modal-title">Add Image</h4>
				</div>

			<div class="modal-body">
				<form class="form-horizontal" id="imageForm" enctype="multipart/form-data" method="POST" action="../imageupload.php" >
					<section class="form-group">	
						<label class="col-sm-2 control-label">Title</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="title" name="title" placeholder="Car on fire in rinkeby" />
						</div>
					</section>
					<section class="form-group">
						<label for="inputPassword3" class="col-sm-2 control-label">Caption</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="caption" placeholder="The car is about to blow up!" />
						</div>
					</section>
					<section class="form-group">
						<label for="image" class="col-sm-2 control-label">Choose Image</label>
						<div class="col-sm-10">
							<input type="file" id="image" />
						</div>
					</section>
					<section class="form-group" id="form-tags">
						<label for="image" class="col-sm-2 control-label">Choose Tags</label>
						<div class="col-sm-10" id="tags">
							<xsl:apply-templates select="tag" />
						</div>
					</section>
					<section class="form-group">
						<label class="col-sm-2 control-label">Position</label>
						<div class="col-sm-10" style="min-height: 130px" id="locationMap"></div>
					</section>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default"><a href="http://xml.csc.kth.se/~mkrog/DM2517/projekt/index.php" >Back to startpage</a></button>
				<button type="button" class="btn btn-primary" id="submit" > Upload image </button>
			</div>



			<script src="./js/jquery.min.js" type="text/javascript"></script>
			<script src="./js/upload.js" type="text/javascript"></script>
			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5QnhfpQAZ6ZKD-4KR5gQVn4N3pcIs0cc&amp;callback=createLocationMap"></script>
			</section>
		</body>
</html>

	</xsl:template>

	<xsl:template match="tag">
		<span class="label label-default" style="cursor: pointer;"><xsl:value-of select="." /></span>
	</xsl:template>

</xsl:stylesheet>

<?xml version="1.0"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">


<xsl:template match="kriz">
	<html>
		<head>
			<title>Krizfeed </title>
			<meta charset="UTF-8" />
			<link rel="stylesheet" type="text/css" href="../vendor/bootstrap.min.css"/>
		</head>
		<body>
			<script src="../vendor/jquery.min.js" type="text/javascript"></script>
			<script src="../vendor/bootstrap.min.js" type="text/javascript"></script>
			<script src="../vendor/upload.js" type="text/javascript"></script>

			<section class="container-fluid">

				<!-- TEMPLATE -->
				<xsl:apply-templates select="userinfo" />

				<div class="jumbotron">
					<h4 class="text-center" style="margin-bottom:30px">Add Post</h4>
					<form class="form-horizontal" id="imageForm" enctype="multipart/form-data">
						<section class="form-group">	
							<label class="col-sm-2 control-label">Title</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="title" name="title" placeholder="Car on fire" />
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
								<input class="control-label" type="file" id="image" />
							</div>
						</section>
						<section class="form-group" id="form-tags">
							<label for="image" class="col-sm-2 control-label">Choose Tags</label>
							<div class="col-sm-10" id="tags">
								<!-- TEMPLATE -->
								<h4 style="line-height:30px"> <xsl:apply-templates select="tags/tag" /> </h4>
							</div>
						</section>
						<section class="form-group">
							
							<div class="col-sm-12" style="min-height: 350px;padding:0;margin:0 15px" id="locationMap"></div>
						</section>
						<section class="form-group">
							<div class="col-sm-12 text-center">
								<button type="button" class="btn btn-primary" id="submit" > Upload image </button>
							</div>
						</section>
					</form>
				</div>
					

			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA5QnhfpQAZ6ZKD-4KR5gQVn4N3pcIs0cc&amp;callback=createLocationMap"></script>
			</section>
		</body>
</html>

	</xsl:template>

	<!-- IMPORTING TEMPLATES -->
	<xsl:include href="header.xsl" />

	<xsl:template match="tag">
		<span class="label label-default" style="cursor: pointer;"><xsl:value-of select="." /></span> <xsl:text> </xsl:text>
	</xsl:template>

</xsl:stylesheet>

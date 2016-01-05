<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

	<xsl:template match="kriz">
		<html>
			<head>
				<title>Krizfeed </title>
				<meta charset="UTF-8"/>
				<meta name="viewport" content="width=device-width initial-scale=1" />

				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous" />

				<script src="http://maps.googleapis.com/maps/api/js"></script>

			</head>

			<body>
				<script src="../vendor/jquery.min.js" type="text/javascript"></script>
				<script src="../vendor/bootstrap.min.js" type="text/javascript"></script>
				<script src="../vendor/index.js"></script>

				<section class="container-fluid">

					<!-- TEMPLATE -->
					<xsl:apply-templates select="userinfo"/>

					<section class="row">
						<div class="container">

							<div class="col-md-6">

								<form class="input-group" method="get">
									<span class="input-group-btn">
										<button class="btn btn-default" type="submit">Go!</button>
									</span>
									<input type="text" class="form-control" name="searchstring"/>
								</form><!-- /input-group -->

								<ul class="list-group" id="posts" style="overflow-y:scroll">
									<!-- TEMPLATE -->
									<xsl:apply-templates select="posts/post"/>
								</ul>
							</div>
							<div class="col-md-6" id="googleMap">

							</div>
						</div>
					</section>
				</section>

			<div class="modal" tabindex="-1" role="dialog" id="updatemodal">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
							<h4 class="modal-title">Update post</h4>
						</div>

						<div class="modal-body">

							<form class="form-horizontal" id="imageForm">
								<section class="form-group">	
									<label class="col-sm-2 control-label">Title</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="title" name="title"/>
									</div>
								</section>

								<section class="form-group">
									<label for="inputPassword3" class="col-sm-2 control-label">Caption</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="caption"/>
									</div>
								</section>
							</form>

						</div>

						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal" >Cancel</button>
							<button type="button" class="btn btn-success" id="save">Save Changes</button>
						</div>

					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->

			</body>
		</html>

	</xsl:template>

	<!-- IMPORTING TEMPLATES -->
	<xsl:include href="header.xsl" />
	<xsl:include href="posts.xsl" />
    
</xsl:stylesheet>

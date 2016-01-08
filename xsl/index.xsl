<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

	<xsl:variable name="usernameoradmin"> <!-- Takes value 'admin' if admin, 'username' if logged in but not admin '' if not logged in. -->
		<xsl:choose>
			<xsl:when test="kriz/userinfo/role = 'admin'">admin</xsl:when>
			<xsl:when test="kriz/userinfo/username"><xsl:value-of select="/kriz/userinfo/username" /></xsl:when>
			<xsl:otherwise></xsl:otherwise>
		</xsl:choose>
	</xsl:variable>

	<xsl:template match="kriz">
		<html>
			<head>
				<title>Krizfeed</title>
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

								<ul class="list-group" id="posts" style="overflow-y:scroll;">
									<!-- TEMPLATE -->
									<xsl:apply-templates select="posts/post">
										<xsl:with-param name="username" select="userinfo/u" />
									</xsl:apply-templates>
								</ul>
							</div>
							<div class="col-md-6" id="googleMap">

							</div>
						</div>
					</section>
				</section>

			<!-- IMPORTING UPDATEMODAL -->
			<xsl:call-template name="updatemodal" />

			</body>
		</html>

	</xsl:template>

	<!-- IMPORTING TEMPLATES -->
	<xsl:include href="updatemodal.xsl" />
	<xsl:include href="header.xsl" />
	<xsl:include href="posts.xsl" />
    
</xsl:stylesheet>

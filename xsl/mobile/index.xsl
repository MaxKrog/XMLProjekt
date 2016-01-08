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
				<title>Krizfeed </title>
				<meta charset="UTF-8"/>
				<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no " />
				<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous"/>

				<script src="http://maps.googleapis.com/maps/api/js"></script>

			</head>

			<body style="padding-top:70px">

				<script src="../vendor/jquery.min.js" type="text/javascript"></script>
				<script src="../vendor/bootstrap.min.js"/>
				<script src="../vendor/index.js"></script>


				<section class="container" >

					<!-- TEMPLATE -->
					<xsl:apply-templates select="userinfo"/>

					<section class="row">
						<div class="container-fluid" >
							<ul class="list-group" id="posts" style="overflow-y:scroll">
								<!-- TEMPLATE -->
								<xsl:apply-templates select="posts/post"/>
							</ul>


						</div>
					</section>
				</section>


			</body>
		</html>

	</xsl:template>

	<!-- IMPORTING TEMPLATES -->
	<xsl:include href="header.xsl" />
	<xsl:include href="posts.xsl" />
    
</xsl:stylesheet>

<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

	<xsl:template match="kriz">
		<html>
			<head>
				<title>Krizfeed </title>
				<meta charset="UTF-8"/>
				<meta name="viewport" content="width=device-width initial-scale=1" />
				<link rel="stylesheet" type="text/css" href="../vendor/bootstrap.min.css"/>

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

							<div class="col-md-6" style="padding-right:0px">
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
			</body>
		</html>

	</xsl:template>

	<!-- IMPORTING TEMPLATES -->
	<xsl:include href="header.xsl" />
	<xsl:include href="posts.xsl" />
    
</xsl:stylesheet>

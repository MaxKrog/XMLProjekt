<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

	<xsl:include href="header.xsl" />

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
						<xsl:apply-templates select="post" />
					</section>
				</section>
			</body>
		</html>

	</xsl:template>

	<xsl:template match="post">
		<div class="jumbotron">
			<h1><xsl:value-of select="title" /></h1>
			<p><xsl:value-of select="caption" /></p>
		</div>
    </xsl:template>
    
</xsl:stylesheet>

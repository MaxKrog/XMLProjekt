<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

	<xsl:template match="kriz">
		<html>
			<head>
				<title>Krizfeed </title>
				<meta charset="UTF-8"/>
				<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no " />

				<link rel="stylesheet" type="text/css" href="../vendor/bootstrap.min.css"/>
			</head>

			<body style="padding-top:70px">
				<script src="../vendor/jquery.min.js" type="text/javascript"></script>
				<script src="../vendor/bootstrap.min.js" type="text/javascript"></script>
				<script src="../vendor/gallery.js" type="text/javascript"></script>

				<section class="container-fluid">

					<!-- TEMPLATE -->
					<xsl:apply-templates select="userinfo"/>

					<div class="container">
						<section class="row">
								<xsl:apply-templates select="posts/post" />
						</section>
					</div>
				</section>



			</body>
		</html>

	</xsl:template>

	<xsl:template match="posts/post">

        <div class="col-xs-4 col-sm-4 col-md-2">
            <a href="{imagemedium}" class="thumbnail" data-toggle="tooltip" data-placement="top" title="{title}" target="_new">
                <img src="{imagethumb}" alt="{title}" />
            </a>
        </div>

    </xsl:template>

	<!-- IMPORTING TEMPLATES -->
	<xsl:include href="header.xsl" />
    
</xsl:stylesheet>

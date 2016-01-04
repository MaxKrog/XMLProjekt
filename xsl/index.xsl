<?xml version="1.0" encoding="ISO-8859-1"?>
<xsl:stylesheet 
	version="1.0" 
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

	<xsl:template match="kriz">
		<html>
			<head>
				<title>Krizfeed </title>
				<meta charset="UTF-8"/>
				<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>

				<script src="http://maps.googleapis.com/maps/api/js"></script>
				<script>
					function initialize() {
					  var mapProp = {
					    center:new google.maps.LatLng(51.508742,-0.120850),
					    zoom:5,
					    mapTypeId:google.maps.MapTypeId.ROADMAP
					  };
					  var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
					}
					google.maps.event.addDomListener(window, 'load', initialize);
				</script>

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
									<ul class="nav navbar-nav navbar-right">		
										<xsl:apply-templates match="userinfo" />
									</ul>
								</div>
							</nav>
						</header>

					<section class="row">
						<div class="container">
							<div class="col-md-4">
								<div class="list-group">
									<xsl:apply-templates match="posts/post"/>
								</div>
							</div>
						</div>
						<div class="col-md-8" id="googleMap" style="min-height:500px"></div>
					</section>
				</section>

			</body>
		</html>

	</xsl:template>


	<xsl:template match="posts/post">
		<div class="list-group-item">
       		<xsl:value-of select="title"/><br/>
		</div>
    </xsl:template>
    
    <xsl:template match="userinfo">
    	<xsl:if test="authorized">
    		<li><button type="button" class="btn btn-primary navbar-btn" id="addImage"><xsl:value-of select="username" /></button></li>
			<li><button type="button" class="btn btn-primary navbar-btn">Sign in</button></li>
    	</xsl:if>
    </xsl:template>


</xsl:stylesheet>

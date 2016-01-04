<?xml version="1.0" encoding="ISO-8859-1"?>
<xsl:stylesheet 
	version="1.0" 
	xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

	<xsl:template match="kriz">
		<html>
			<head>
				<title>Krizfeed </title>
				<meta charset="UTF-8"/>
				<meta name="viewport" content="width=device-width initial-scale=1" />
				<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css"/>

				<script src="http://maps.googleapis.com/maps/api/js"></script>
				<script>/*
					function initialize() {
					  var mapProp = {
					    center:new google.maps.LatLng(51.508742,-0.120850),
					    zoom:5,
					    mapTypeId:google.maps.MapTypeId.ROADMAP
					  };
					  var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);
					}
					google.maps.event.addDomListener(window, 'load', initialize);*/
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
										<xsl:apply-templates select="userinfo" />
									</ul>
								</div>
							</nav>
						</header>

					<section class="row">
						<div class="container">
							<div class="col-md-12">
								<ul class="list-group">
									<!-- POSTS GO HERE -->
									<xsl:apply-templates select="posts/post"/>
								</ul>
							</div>
						</div>
						<!-- <div class="col-md-8" id="googleMap" style="min-height:500px"></div> -->
					</section>
				</section>

			</body>
		</html>

	</xsl:template>

    <xsl:template match="userinfo">
    	<xsl:if test="authorized = 'false'">
			<li>
				<a href="./auth/login.php"> Sign in  </a>
			</li>
    	</xsl:if>
    	<xsl:if test="authorized = 'true'">
    		<li>
				<a href="upload.php"> Upload image  </a>
			</li>
			<li>
				<p class="navbar-text" ><xsl:value-of select="username" /> </p>
			</li> 
			<li>
				<a href="./auth/logout.php"> Sign out  </a>
			</li>
    	</xsl:if>
    </xsl:template>

	<xsl:template match="posts/post">
		<li class="list-group-item">
       		<div class="media">
       			<div class="media-left">
       				<a href="#">
       					<img class="media-object" style="height:90px" src=".{image}"/>
       				</a>
       			</div>
       			<div class="media-body">
       				<h4 class="media-heading"> <xsl:value-of select="title" /> </h4>
       				<xsl:value-of select="caption" />
       				
       				<br/><div class="well well-sm"><xsl:apply-templates select="tags/tag" /></div>
       				
       			</div>
       			
       		</div>

		</li>
    </xsl:template>
    
    <xsl:template match="tag">
		<span class="label label-default" style="cursor: pointer;"><xsl:value-of select="." /></span>
	</xsl:template>
    
</xsl:stylesheet>

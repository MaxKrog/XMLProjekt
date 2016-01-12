<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

	<xsl:template match="userinfo">
		<script src="../vendor/header.js"></script>

		<header class="row">
			<nav class="navbar navbar-inverse navbar-static-top">
				<div class="container">
					<div class="navbar-header">
						<a class="navbar-brand" href="index.php">
							Krizfeed
						</a>
					</div>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="index.php"> Frontpage  </a></li>
						<li><a href="gallery.php"> Gallery  </a></li>		
						<li><a href="map.php"> Map </a></li>	
						<xsl:if test="authorized = 'false'">

							<li><a href="./login.php"> Sign in  </a></li>
							
						</xsl:if>
						<xsl:if test="authorized = 'true'">

							
							<li><a href="upload.php"> Upload post  </a></li>
							<xsl:if test="role = 'admin'">
								<li id="adminpanel"><a href="#"> User administration </a></li>
							</xsl:if>
							
							<li><p class="navbar-text" ><xsl:value-of select="username" /></p></li> 
							<li><a href="./logout.php"> Sign out  </a></li>
						</xsl:if>
					</ul>
				</div>
			</nav>
		</header>

		<xsl:if test="role = 'admin'">			
			<xsl:call-template name="adminmodal" />
		</xsl:if>

	</xsl:template>

	<!-- LOAD ADMINMODAL.XSL -->
	<xsl:include href="adminmodal.xsl" />


</xsl:stylesheet>
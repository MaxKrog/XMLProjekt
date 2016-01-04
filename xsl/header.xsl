<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

	<xsl:template match="userinfo">
		<header class="row">
			<nav class="navbar navbar-inverse navbar-static-top">
				<div class="container">
					<div class="navbar-header">
						<a class="navbar-brand" href="#">
							Krizfeed
						</a>
					</div>
					<ul class="nav navbar-nav navbar-right">		
						<xsl:if test="authorized = 'false'">

							<li><a href="./auth/login.php"> Sign in  </a></li>
							
						</xsl:if>
						<xsl:if test="authorized = 'true'">

							<li><a href="index.php"> Frontpage  </a></li>
							<li><a href="upload.php"> Upload image  </a></li>

							<li><p class="navbar-text" ><xsl:value-of select="username" /></p></li> 

							<li><a href="./auth/logout.php"> Sign out  </a></li>
						</xsl:if>
					</ul>
				</div>
			</nav>
		</header>
	</xsl:template>


</xsl:stylesheet>
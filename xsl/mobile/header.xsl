<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

	<xsl:template match="userinfo">
		<header class="row">
			<nav class="navbar navbar-inverse navbar-static-top">
				<div class="container">
					<div class="navbar-header">
						<a class="navbar-brand" href="index.php">
							Krizfeed mobile
						</a>
					</div>
					<ul class="nav navbar-nav">		
						<xsl:if test="authorized = 'false'">

							<li><a href="./auth/login.php"> Sign in  </a></li>
							
						</xsl:if>
						<xsl:if test="authorized = 'true'">
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menu <span class="caret"></span></a>
								<ul class="dropdown-menu">
									<li><a href="index.php">Frontpage</a></li>
									<li><a href="upload.php">Upload image</a></li>
									<li role="separator" class="divider"></li>
									<li><a href="#"><xsl:value-of select="username"/></a></li>
									<li><a href="./auth/logout.php"> Sign out  </a></li>
								</ul>
							</li>
							
						</xsl:if>
					</ul>
				</div>
			</nav>
		</header>
	</xsl:template>


</xsl:stylesheet>
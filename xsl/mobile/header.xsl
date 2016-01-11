<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

	<xsl:template match="userinfo">
		<header class="row">
			<nav class="navbar navbar-inverse navbar-fixed-top">
				<div class="navbar-inner">
					<div class="container-fluid">						
						<a class="navbar-brand" href="index.php">
							Krizfeed
						</a>
						<div class="nav-collapse">
							<ul class="nav navbar-nav navbar-right">		
								<xsl:if test="authorized = 'false'">
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menu <span class="caret"></span></a>
										<ul class="dropdown-menu">
											<li><a href="index.php">Frontpage</a></li>
											<li><a href="gallery.php"> Gallery  </a></li>
											<li><a href="map.php"> Map </a></li>	
											<li role="separator" class="divider"></li>
											<li id="adminpanel"><a href="./login.php"> Sign in </a></li>
										</ul>
									</li>	
								</xsl:if>
								<xsl:if test="authorized = 'true'">
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menu <span class="caret"></span></a>
										<ul class="dropdown-menu">
											<li><a href="index.php">Frontpage</a></li>
											<li><a href="upload.php">Upload image</a></li>
											<li><a href="gallery.php"> Gallery  </a></li>
											<li><a href="map.php"> Map </a></li>	
											<li role="separator" class="divider"></li>
											<li id="adminpanel"><a href="#"> User administration </a></li>
											<li><a href="#"><xsl:value-of select="username"/></a></li>
											<li><a href="./logout.php"> Sign out  </a></li>
										</ul>
									</li>	
								</xsl:if>
							</ul>
						</div>
					</div>
				</div>
			</nav>
		</header>
		
		<!-- MODAL -->
		<xsl:if test="role = 'admin'">			
			<xsl:call-template name="adminmodal" />
		</xsl:if>

	</xsl:template>

	<!-- LOAD ADMINMODAL.XSL -->
	<xsl:include href="../adminmodal.xsl" />


</xsl:stylesheet>
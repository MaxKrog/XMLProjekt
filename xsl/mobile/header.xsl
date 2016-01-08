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

									<li><a href="./login.php"> Sign in  </a></li>
									
								</xsl:if>
								<xsl:if test="authorized = 'true'">
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Menu <span class="caret"></span></a>
										<ul class="dropdown-menu">
											<li><a href="index.php">Frontpage</a></li>
											<li><a href="upload.php">Upload image</a></li>
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
		<xsl:if test="authorized = 'true'">
						<div class="modal" tabindex="-1" role="dialog" id="modal">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button>
							<h4 class="modal-title">User Administration</h4>
						</div>

						<div class="modal-body">
							<table class="table">
								<thead>
									<tr>
										<th> Username </th>
										<th> Password </th>
										<th> Admin </th>
										<th></th>
										<th></th>
									</tr>
								</thead>
								<tbody id="tbody">

								</tbody>
							</table>
						</div>

						<div class="modal-footer">
							<button type="button" class="btn btn-success" id="add">Add new user</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>

					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
			<script src="../vendor/admin.js"></script>
		</xsl:if>
	</xsl:template>


</xsl:stylesheet>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

	<xsl:include href="header.xsl" />

	<xsl:template match="kriz">
		<html>
			<head>
				<title>Krizfeed</title>
				<meta charset="UTF-8"/>
				<!-- <meta name="viewport" content="width=device-width initial-scale=1" /> -->
				<meta name="viewport" content="width=800, initial-scale=1" />

				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous" />
			</head>

			<body>
				<script src="../vendor/jquery.min.js" type="text/javascript"></script>
				<script src="../vendor/bootstrap.min.js" type="text/javascript"></script>
				<script src="../vendor/post.js"></script>

				<section class="container-fluid">

					<!-- TEMPLATE -->
					<xsl:apply-templates select="userinfo"/>

					<section class="col-md-10 col-md-offset-1 col-lg-8 col-lg-offset-2">
						<section class="row">
							<xsl:apply-templates select="post" />
						</section>
					</section>
				</section>
			</body>
		</html>

	</xsl:template>

	<xsl:template match="post">
		<div class="jumbotron">
			<div class="media">
				<div class="media-left" style="position: relative">
					<img class="media-object img-rounded" src="{imagemedium}" style="max-width:400px"/>
					<img class="media-object img-rounded hidden" 
						src="https://maps.googleapis.com/maps/api/staticmap?center={location/lat},{location/lng}&amp;zoom=13&amp;size=400x400&amp;markers={location/lat},{location/lng}&amp;key=AIzaSyCEHoGER6N8aLBBR-jN4Hi3dwvRCfKHGx0" style="max-width:400px"/>

					<button id="toggleImage" class="btn btn-default" style="position:absolute; top:5px; left: 5px;"> Toggle</button>


				</div>
				<div class="media-body">
					<h4 class="media-heading text-center" style="margin-bottom: 15px"><xsl:value-of select="title"/></h4>
					<xsl:value-of select="caption" />

					<hr style="border-color: lightgrey" />
					<xsl:apply-templates select="tags/tag" />
					<hr style="border-color: lightgrey" />

					 <p class="text-center"> Uploaded by: <xsl:value-of select="user" />  
					 <br/> <xsl:value-of select="createdat" /> </p>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title text-center">Comments</h3>
			</div>
			<ul class="list-group">

				<!-- TEMPLATE CALL -->
				<xsl:apply-templates select="comments/comment" />

				<xsl:if test="/kriz/userinfo/authorized = 'true'">
					<li class="list-group-item" id="addComment">
						<div class="input-group">
						<input type="text" class="form-control" placeholder="Add comment.." id="comment"/>
						<span class="input-group-btn">
							<button class="btn btn-default" type="button" id="submit">Submit</button>
						</span>
						</div>
					</li>
				</xsl:if>
				<xsl:if test="/kriz/userinfo/authorized = 'false'">
					<li class="list-group-item">
						<h4 class="text-center"> Log in to add your own comment</h4>
					</li>
				</xsl:if>
			</ul>
		</div>

    </xsl:template>

     <xsl:template match="comment">
		<li class="list-group-item">
			<blockquote>
				<p><xsl:value-of select="text" /></p>
				<footer><xsl:value-of select="user" /> at <xsl:value-of select="createdat" /></footer>
				<xsl:if test="/kriz/userinfo/username = user">
					<span class="deleteComment glyphicon glyphicon-remove" data-id="{@id}" style="cursor:pointer; color:darkred; position: absolute; top: 20px; right: 20px"></span>
				</xsl:if>
			</blockquote>
		</li>
     </xsl:template>

    <xsl:template match="tag">
		<span class="label label-default" style="cursor: pointer;"><xsl:value-of select="." /></span> <xsl:text> </xsl:text>
	</xsl:template>
    
</xsl:stylesheet>

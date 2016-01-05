<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">


	<xsl:template match="posts/post">
		<li class="list-group-item" data-lat="{location/lat}" data-lng="{location/lng}">
       		<div class="media">
       			<div class="media-left">
       				<a href=".{imagemedium}" target="_new">
       					<img class="media-object" src=".{imagethumb}"/>
       				</a>
       			</div>
       			<div class="media-body">
       				<h4 class="media-heading"> <xsl:value-of select="title" /> </h4>
       				<xsl:value-of select="caption" />

       				<br/>
              <div class="well well-sm">
                Posted by: <xsl:apply-templates select="user" /><br/>
                <xsl:apply-templates select="tags/tag" />
              </div>
       				
       			</div>
       			
       		</div>

		</li>
    </xsl:template>

    <xsl:template match="tag">
		<span class="label label-default" style="cursor: pointer;"><xsl:value-of select="." /></span>
	</xsl:template>

</xsl:stylesheet>
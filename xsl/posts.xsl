<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">


	<xsl:template match="posts/post">
		<li class="list-group-item" data-lat="{location/lat}" data-lng="{location/lng}" data-title="{title}" data-id="{@id}" data-caption="{caption}">
       		<div class="media">
       			<div class="media-left">
       				<a href="{imagemedium}" target="_new">
       					<img class="media-object img-rounded" src="{imagethumb}"/>
       				</a>
       			</div>
       			<div class="media-body">

       				 <h4 class="media-heading">
                        <span class="spanTitle center-text" > <xsl:value-of select="title" /></span>
                       
                        <span id="goto" style="cursor: pointer" class=" pull-right glyphicon glyphicon-pushpin"></span>
                        <xsl:if test="$usernameoradmin = 'admin' or $usernameoradmin = user">
                          <span id="update" class=" pull-right glyphicon glyphicon-cog" style="margin-right:10px"></span>
                        </xsl:if>
                        
                    </h4> 

       				<span class="spanCaption"><xsl:value-of select="caption" /> </span>

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
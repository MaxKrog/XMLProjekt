<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">


	<xsl:template match="posts/post">
		<li class="list-group-item" data-lat="{location/lat}" data-lng="{location/lng}" data-title="{title}" data-id="{@id}" data-caption="{caption}" style="border-style:none">
       		<div class="media img-rounded" style="box-shadow: 5px 5px 10px grey; padding: 10px 10px 10px 10px; ">
       			<div class="media-left">
       				<a href="{imagemedium}" target="_new">
       					<img class="media-object img-rounded" src="{imagethumb}"/>
       				</a>
       			</div>
       			<div class="media-body" style="">

       				 <h5 class="media-heading">
                        <span class="spanTitle center-text" > <xsl:value-of select="title" /></span>
                       
                        <span id="goto" style="cursor: pointer" class=" pull-right glyphicon glyphicon-pushpin"></span>
                        <xsl:if test="$usernameoradmin = 'admin' or $usernameoradmin = user">
                          <span id="update" class=" pull-right glyphicon glyphicon-cog" style="margin-right:10px"></span>
                        </xsl:if>
                        
                </h5> 

       				<p class="spanCaption"><xsl:value-of select="caption" /> </p>

              
                <i style="font-size: 10px">Uploaded by: <xsl:value-of select="user" /> at <xsl:value-of select="createdat"/><br/>
                <xsl:apply-templates select="tags/tag" /></i>
       				
       			</div>
       			
       		</div>

		</li>
    </xsl:template>

    <xsl:template match="tag">
		  <xsl:value-of select="." />
    </xsl:template>

</xsl:stylesheet>
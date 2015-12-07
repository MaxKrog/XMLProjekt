 <xsl:stylesheet version="1.0"
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
>
  <xsl:output method="html"/>


  <xsl:template match="Map">
    var <xsl:value-of select="@name"/> = new google.maps.Map(
      document.getElementById("map_canvas"),
      {
        zoom: <xsl:value-of select="@zoom"/>,
        center: new google.maps.LatLng(<xsl:value-of select="@LatLng"/>),
        mapTypeId: google.maps.MapTypeId.<xsl:value-of select="@mapType"/>
      }
    );

    <xsl:apply-templates select="*">
      <xsl:with-param name="map" select="@name"/>
    </xsl:apply-templates>
  </xsl:template>


  <xsl:template match="Marker">
    <xsl:param name="map"/>

    <xsl:if test="@name">
    var <xsl:value-of select="@name"/> =
    </xsl:if>
    new google.maps.Marker({
      position: new google.maps.LatLng(<xsl:value-of select="LatLng"/>),
      map: <xsl:value-of select="$map"/>,
      <xsl:if test="icon">icon: '<xsl:value-of select="icon"/>',</xsl:if>
      title: '<xsl:value-of select="title"/>'
    });
  </xsl:template>


  <xsl:template match="KmlLayer">
    <xsl:param name="map"/>

    var <xsl:value-of select="@name"/> =
    new google.maps.KmlLayer('<xsl:value-of select="."/>');
    <xsl:value-of select="@name"/>.setMap(<xsl:value-of select="$map"/>);
  </xsl:template>


  <xsl:template match="InfoWindow">
    <xsl:param name="map"/>

    var <xsl:value-of select="@name"/> = new google.maps.InfoWindow({
      content: '<xsl:apply-templates select="content/node()" mode="oneline"/>'
    });

    <xsl:if test="@open">
      <xsl:value-of select="@name"/>.open(
      <xsl:value-of select="$map"/>,<xsl:value-of select="@open"/>);
    </xsl:if>

    <xsl:if test="@click">
      google.maps.event.addListener(
        <xsl:value-of select="@click"/>, 'click', function() {
        <xsl:value-of select="@name"/>.open(<xsl:value-of select="$map"/>,
        <xsl:value-of select="@click"/>);
      });
    </xsl:if>
  </xsl:template>

  <xsl:template match="node()" mode="oneline">
    <xsl:copy>
      <xsl:copy-of select="@*|namespace::*"/>
      <xsl:apply-templates select="node()" mode="oneline"/>
    </xsl:copy>
  </xsl:template>

  <xsl:template match="text()" mode="oneline">
    <xsl:value-of select="translate(.,'&#10;','')"/>
  </xsl:template>


  <xsl:template match="/">
<html>
<head>
<script type="text/javascript"
  src="http://maps.google.com/maps/api/js?sensor=false"
/>
<script type="text/javascript">
  function initialize() {
    <xsl:apply-templates select="Map"/>
  }
</script>
</head>
<body onload="initialize()">
  <div id="map_canvas" style="width:900px; height:600px"></div>
</body>
</html>
  </xsl:template>

</xsl:stylesheet>


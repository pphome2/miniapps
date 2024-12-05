<?xml version="1.0" encoding="ISO-8859-2"?>

<html xsl:version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns="http://www.w3.org/1999/xhtml">

  <body style="font-family:Arial;font-size:12px;background-color:#EEEEEE">
    
    <xsl:for-each select="Telefonkonyv/Barat">
    
      <div style="background-color:teal;color:white;padding:4px">
        <span style="font-weight:bold"><xsl:value-of select="Nev"/></span>
      </div>
      
      <div style="margin-left:20px;font-size:10px">
        Cím: <xsl:value-of select="Cim"/>
      </div>
      
      <div style="margin-left:20px;;font-size:10px">
        <span style="font-style:italic">
          Telefonszám: <xsl:value-of select="Telefonszam"/>
        </span>
      </div>
      
      <div style="margin-left:20px;margin-bottom:10px;font-size:10px">
        <span style="font-style:italic">
          E-Mail cím: <xsl:value-of select="E-Mail"/>
        </span>
      </div>
    
    </xsl:for-each>
  </body>
</html>


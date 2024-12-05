<?xml version="1.0" encoding="iso-8859-2"?><xsl:stylesheet version="1.0
"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/">

<html>
<body>

  <h2>Telefonkönyv</h2>
  <table border="1" width="90%" align="center">
    <tr>
      <th width="30%" align="center">Név</th>
      <th width="60%" align="center">Adatok</th>
    </tr>

    <xsl:for-each select="Telefonkonyv/Barat">
    <tr>
      <td valign="top"><xsl:value-of select="Nev"/></td>
      <td>
        <div><xsl:value-of select="Cim"/></div>
        <div><xsl:value-of select="Telefonszam"/></div>
        <div><xsl:value-of select="E-Mail"/></div>
      </td>
    </tr>
    </xsl:for-each>
  </table>

</body>
</html>
</xsl:template>
</xsl:stylesheet>

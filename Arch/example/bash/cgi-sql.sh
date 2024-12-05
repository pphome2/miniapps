#!/bin/bash
#

echo "Content-type: text/html "
echo ""

echo "<!DOCTYPE html>"

echo "<html>"
echo "<head>"
echo "<title>Test bash cgi</title>"
echo "<meta charset=\"utf-8\">"
echo "</head>"
echo "<body>"

echo "Tesztelő"
echo "<br /><br />"

n=`mariadb -u admin --password=admin -e 'select user from user' mysql`
echo $n

echo "<br /><br />"
n2="${n// /'<br />'}"
for n2 in $n; do
  echo "$n2<br />"
done

echo "</body>"
echo "</html>"


#

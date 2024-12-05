#!/usr/bin/python3
#
import os

print("Content-type: text/html\n\n")
print("<!DOCTYPE html>")

print("<html>")
print("<head>")
print("<title>Python cgi</title>")
print("<meta charset=\"utf-8\">")
print("</head>")
print("<body>")

print("<center><b><font size=+2>Hello, Python cgi!</font></b></center>")
print("<br /><br />")

print ("<font size=+1>Environment</font><br />");
for param in os.environ.keys():
   print ("<b>%20s</b>: %s<br />" % (param, os.environ[param]))

print("</body>")
print("</html>")
#

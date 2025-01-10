#!/usr/bin/python3
#
import os
import cgi

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

# get/post method
form=cgi.FieldStorage()
if form.getvalue('n1'):
  name1=form.getvalue('n1')
else:
  name1=""
if form.getvalue('n2'):
  name2=form.getvalue('n2')
else:
  name2=""
if form.getvalue('text'):
  t=form.getvalue('text')
else:
  t=""
if form.getvalue('sel'):
  s=form.getvalue('sel')
else:
  s=""
if form.getvalue('ra'):
  r=form.getvalue('ra')
else:
  r=""


print("<br /><br />")
if name1!="":
  print("Név1");
  print(name1);
print("<br />")
if name2!="":
  print("Név2");
  print(name2);
print("<br />")
if t!="":
  print("Szöveg:");
  print(t);
print("<br />")
if s!="":
  print("Választás (lenyíló)");
  print(s);
print("<br />")
if r!="":
  print("Választás (rádió)");
  print(r);

print("<br /><br />")
print("<form method=post>")
print("Név 1: <input type=text name=n1 /><br />")
print("Név 2: <input type=text name=n2 /><br />")
print("<br />")
print("<textarea name=text cols=40 rows=4>Ide írj...</textarea>")
print("<br /><br />")
print("<select name=sel>")
print("  <option value=\"Mathsq\" selected>Maths</option>")
print("  <option value=\"Physics\">Physics</option>")
print("</select>")
print("<br /><br />")
print("   <input type=radio name=ra value=\"maths\" /> Maths")
print("   <input type=radio name=ra value=\"physics\" /> Physics")
print("<br /><br />")
print("<input type=submit value=\"Küldés\" /><br />")
print("</form>")

print("</body>")
print("</html>")

#

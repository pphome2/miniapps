#!/usr/bin/python3

import cgi
import mysql.connector

print("Content-type: text/html\n\n")
print("<!DOCTYPE html>")

print("<html>")
print("<head>")
print("<title>Python cgi</title>")
print("<meta charset=\"utf-8\">")
print("<body>")

# Connect to the database.
mydb=mysql.connector.connect(
  host="localhost",
  user="admin",
  password="admin",
  database="mysql"
)

mycursor=mydb.cursor()
mycursor.execute("SELECT user FROM user")
myresult=mycursor.fetchall()

for x in myresult:
  print(x)
  print("<br />")


print("</body>")
print("</html>")

#

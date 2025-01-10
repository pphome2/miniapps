#
import os

def thisfile(fn):
  try:
    f=open(fn)
    f.close()
    return True
  except:
    return False


def error(data):
  if data<0:
    err=ValueError("{0} érvénytelen adat.".format(ev))
    raise err # kilép a legfelső hívó szintig
  return data

def error(data):
  if data<0:
    err=ValueError("{0} érvénytelen adat.".format(ev))
    raise err # kilép a legfelső hívó szintig
  return data


if thisfile("elso.txt"):
  print("létezik")
else:
  print("nem létezik")

if thisfile("masodik.txt"):
  print("létezik")
else:
  print("nem létezik")

print("\n\n")
try:
  print(error(1))
except:
  print("hiba")
try:
  print(error(-1))
except:
  print("hiba")

print("\n\n")
try:
  print(error(1))
except:
  print("hiba")
try:
  print(error(-1))
except:
  print("hiba")
finally:
  print("kilépek")

#


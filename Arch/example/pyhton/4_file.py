#

import os

sfajl=open("elso.txt","w")
sfajl.write("Python\n")
sfajl.write("------\n")
sfajl.write("Helló!\n")
sfajl.close()

print("1-------------------------\n")

if os.path.isfile("elso.txt"):
  f=open("elso.txt", "r")
  xs=f.readlines()
  f.close()
  for t in xs:
    print("{0}".format(t))

print("2-------------------------\n")

if os.path.isfile("elso.txt"):
  f1=open("elso.txt", "r")
  while True:
    s=f1.readline()
    if len(s)==0:
      break
    print(s)
  f1.close()

print("--------------------------\n")

path="."
obj=os.scandir(path)
print("Fájlok és könyvtárak ('% s'):" % path)
for e in obj:
  if e.is_dir() or e.is_file():
    print(e.name)

#


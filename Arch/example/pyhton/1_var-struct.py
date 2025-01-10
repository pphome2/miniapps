#

print("\n\n")
print("Hello, ")

mess="Hello"
# str hosssza
h=len(mess)
# változó típusa
t=type(mess)

print(mess," ",h," ",t)

# osztás és egész osztás
x1=7/4
x2=7//4
print(x1," ",x2)

# típus konverzió
y1=int(3.19)
y2=float(33)
y3=str(123)
print(y1," ",y2," ",y3)

# string összefűzés
f="első"+" teszt"
print(f)

# bekérés
print("\n\n")
n=input("Kérem adja meg a nevet:")
c=False
if n=="0":
  c=True
if n=="q":
  print(n," igen")
elif c:
  print(n, "c nem")
else:
  print("nem")

print("\n\n")

for b in ["első","második","harmadik"]:
  m=b+" "+"kör"
  print(m)

c=[1,2,3]  
for b in c:
  m=str(b)+". "+"kör"
  print(m)

print("\n\n")

i=0
while i<10:
  i+=1
  print(i,"\t",end="  ")
# end= sor végét (újsor) cseréli

while True:
  f=input("Játszunk megint? (i/n)")
  if f!= "i":
    break
# break kilép a ciklusból
# continue visszaugrik a ciklus elejére

print("Viszlát!")
print("\n\n")

# tömb
t=[("1","első"),("2","második"),("3","harmadik")]
for (cim,nev) in t:
  if cim>"0":
    print(nev)

t2=[("1",["e","ee","eee"]),
    ("2",["w","ww","www","wwww"]),
    ("3",["q","qq"])]
for (cim,nev) in t2:
  for db in nev:
    print(db,"\t",end="")
  print()

print("\n\n")

# string
s="Hallucináció"
sh=len(s)
# pár karakter belőle
print(s[2:6])
print(s[2:])
print(s[:6])

# lista
l=("1","2","3","4")
print(l[1:3])

# álnév: ugyanarra a listára mutat
l2=l
l2[0]="00"

# beágyazott lista
ba=["hello",2.0,5,[10, 20]]

# mátrix
mx=[[1,2,3],[4,5,6],[7,8,9]]
print(mx[0][1])

# string-be változó kiírása
print("Ez egy sor, az első eleme: {0}".format(l[0]))
l=l[:2]+("3.1","3.2")+l[3:]
print(l)

l=("1","2","3")
(l1,l2,l3)=l
print(l2)



print("\n\n")

#


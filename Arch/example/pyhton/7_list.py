#

let={"alma":430,"banán": 312,"narancs": 525,"körte": 217}
print(let)

del let["körte"]
print(let)

let["alma"]=0
print(let)

let["banán"]+=200
print(let)

let["körte 2"]=10
print(let)

print("\n")
for k in let.keys():
  print(k+" elemből ennyi van: {0}".format(let[k]))

print("\n")
for (k,v) in let.items():
  print(k," elemből ennyi van: ",v)

print("\n")
masolat1=let        # csak álnév. változik az eredeti is
masolat2=let.copy() # igazi másolat
masolat1["alma"]=999
masolat2["banán"]=999
print("Eredeti: ",let)
print("Másolat1: ",masolat1)
print("Másolat2: ",masolat2)



#


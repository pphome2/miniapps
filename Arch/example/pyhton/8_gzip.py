#
import json,gzip,io


let={"alma":430,"banán": 312,"narancs": 525,"körte": 217}
print(let)

try:
  f=io.TextIOWrapper(gzip.open("szotar.gz",mode="wb"))
  json.dump(let,f)
  f.close()
except:
  print("file hiba")

let["alam"]=0
let["banán"]=0
let["narancs"]=0
let["körte"]=0
print(let)

try:
  f=io.TextIOWrapper(gzip.open("szotar.gz",mode="r"))
  let2=json.load(f)
  f.close()
except:
  print("file hiba")
  let=[]

print(let2)


#


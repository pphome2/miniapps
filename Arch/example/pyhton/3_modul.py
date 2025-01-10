#

import modul_import
import random
import time
import math

# 1.
# import math
# x=math.sqrt(10)
# 2.
# from math import cos, sin, sqrt
# x=sqrt(10) - nincs minősítés
# 3.
# from math import *
# x=sqrt(10 - nincs minősítés



rng = random.Random()
d=rng.randrange(1,7)
print("{0}\n".format(d))


sz=10000000
tadat=range(sz)
t1=time.time()
ge=sum(tadat)
t2=time.time()
print("{0} (eltelt idő = {1:.4f} másodperc)".format(ge,t2-t1))

print("\n\n")

print(math.pi)
print(math.sqrt(2.0))

print("\n\n")

print(modul_import.c)
modul_import.ir()


#


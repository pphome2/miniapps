#


class egy:
  cc=100
  def __init__(self):
    self.x=0
    self.y=0


class ketto:
  def __init__(self,x=0,y=0):
    self.x=x
    self.y=y
  def kiir(self):
    print("{0} - {1}".format(self.x,self.y))
  def adat(self):
    return("{0} - {1}".format(self.x,self.y))


# öröklődés - átveszi a szülő változóit
class egyx(egy):
  def d(self):
    print("{0} - {1} - {2}".format(self.x,self.y,self.cc))


class verem:
  def __init__(self):
    self.elemek=[]
  def push(self,tetel):
    self.elemek.append(tetel)
  def pop(self):
    return self.elemek.pop()
  def ures_e(self):
    return (self.elemek==[])


o1=egy()
o2=egy()

o1.x=1
o1.y=1

o3=ketto(10,10)

print(o1.x,o1.y,o2.x,o2.y,o3.x,o3.y)

print("--\n")
o3.kiir()
print("--\n")

print(o3.adat())

o4=egyx()
o4.d()


#


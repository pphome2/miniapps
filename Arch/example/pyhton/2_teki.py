#

# Lehetővé teszi a teknőc használatát
import turtle

# Hozz létre egy ablakot
ablak=turtle.Screen()

ablak.bgcolor("lightgreen")
ablak.title("Hello!")

teki=turtle.Turtle()
teki2=turtle.Turtle()


# hívás előtt ltrehozni a függvényt
def t_egy(t):
  # Hozz létre egy teknőcöt
  t.color("blue")
  t.pensize(3)
  # menjen 50 egységet előre
  t.forward(50)
  # forduljon 90 fokot
  t.left(90)
  t.forward(30)
  return "1"

def t_ketto(t):
  t.color("white")
  t.pensize(3)
  t.penup()
  t.forward(250)
  t.pendown()
  for i in ["yellow", "red", "purple", "blue"]:
    t.color(i)
    t.forward(50)
    t.left(90)
  return "2"

def t_harom(t):
  t.penup()
  t.backward(450)
  # arrow, blank, circle, classic, square, triangle,turtle
  t.shape("turtle")
  # 1-10 a sebesség
  t.speed(1)
  t.pendown()
  for i in ["yellow", "red", "purple", "blue"]:
    t.color(i)
    t.forward(50)
    t.left(90)
  return "3"


t_egy(teki)
t_ketto(teki2)
t_harom(teki2)


# bill leütés
def ek1():
  teki.forward(30)
def ek2():
  teki.left(45)

def ek3():
  teki.right(45)

def ek4():
  ablak.bye()

ablak.onkey(ek1,"Up")
ablak.onkey(ek2,"Left")
ablak.onkey(ek3,"Right")
ablak.onkey(ek4,"q")

# egér klikk
def m1(x, y):
  teki.goto(x, y)

ablak.onclick(m1)

# timer
def t1():
  teki2.forward(100)
  teki2.left(56)
  ablak.ontimer(t1, 2000)

ablak.ontimer(t1, 2000)

ablak.listen()
ablak.mainloop()

#


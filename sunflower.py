import turtle
import math

t = turtle.Turtle()
s = turtle.Screen()

s.bgcolor("black")
t.speed(0)
t.hideturtle()
turtle.colormode(255)

angle = 137.5

t.penup()
t.goto(0, 0)
t.pendown()

for i in range(300):
    t.color(255, 80 + i // 4, 0)
    t.dot(8)

    r = math.sqrt(i) * 6
    x = math.cos(math.radians(angle * i)) * r
    y = math.sin(math.radians(angle * i)) * r

    t.penup()
    t.goto(x, y)
    t.pendown()

jumlah_kelopak = 24
sudut = 360 / jumlah_kelopak

t.color("yellow")
t.penup()
t.goto(0, 0)
t.pendown()

for i in range(jumlah_kelopak):
    t.setheading(i * sudut)

    t.penup()
    t.forward(85)       
    t.pendown()

    t.begin_fill()
    t.forward(150)      
    t.right(15)
    t.forward(40)
    t.right(150)
    t.forward(185)
    t.end_fill()

    t.penup()
    t.goto(0, 0)
    t.pendown()

turtle.done()

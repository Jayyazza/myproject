import turtle

screen = turtle.Screen()
screen.bgcolor("black")
flower = turtle.Turtle()
flower.width(2)
flower.penup()
layer_colors = ["red", "blue", "green", "orange", "#ADD8E6", "magenta", "brown", "darkgreen", "cyan", "yellow", "pink", "lime", "gold", "turquoise"]

def draw_petal(size):
    start_pos = flower.position()
    start_heading = flower.heading()
    flower.pendown()
    flower.circle(size, 80)
    flower.left(100)
    flower.circle(size, 80)
    flower.left(100)
    flower.penup()
    flower.goto(start_pos)
    flower.setheading(start_heading)

def draw_flower_layer(petal_size, rotation_angle, color):
    flower.pencolor(color)
    for i in range(8):
        if i == 0:
            flower.speed(10)
        else:
            flower.speed(30)
        flower.setheading(i*rotation_angle)
        draw_petal(petal_size)

def draw_layered_flower(layers=4, start_size=100, size_step=30):
    for i in range(layers):
        petal_size = start_size + i*size_step
        rotation = 360 / 8
        color = layer_colors[i % len(layer_colors)]
        
        flower.penup()
        flower.goto(0, 0)
        flower.setheading(0)
        draw_flower_layer(petal_size, rotation, color)

draw_layered_flower(layers=10)

flower.hideturtle()
turtle.done()
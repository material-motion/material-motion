# Motion Language

Motion design comes with a large set of unique language and terminology. The language defined here is used as the base of the Material Motion framework.

---

## Interaction Types

**Triggered** – Motion that is driven by an event, like tapping a button or dragging beyond a threshold. The motion is predetermined.

**Gestured** – Motion that is directly correlated to a user's continuous input. There can be triggered events during gestural motion.

---

## Connectors


Connectors are conjunctions used to connect a motion type and a value.


### To

The absolute end value of a property change.


### From

The absolute beginning value of a property change.


### By

The relative delta of a property change.

> If an element moves along the X axis **by** 10dp, its destination is calculated by adding 10dp to its current X-value.


### Over

The duration of an animation.

> If an element moves along the X axis **by** 10dp **over** 300ms, it completes this movement over a duration of 300ms.


### With (TBD)

The easing curve applied to an animation.

> If an element moves along the X axis **by** 10dp **over** 300ms **with** a specific easing curve, it completes this movement using the defined easing curve's acceleration and deceleration.


---

## Motion Types


Motion types are verbs used to define a specific movement and must be used with a connector and a value.


### Move

To change the positional value of an object along the X, Y or Z axis by a linear path.

*Additional Parameters:*

* **Arc** – To change the positional value of an object along the X, Y or Z axis by an arced path.

> Value: Density Pixels (X, Y, Z)

### Scale

To stretch the material surface and its content as one whole unit from its anchor point.

> Value: Percentage (width + height)


### Resize (aka Transform)

To change the size of the material surface from its anchor point without stretching its content. Content inside will adapt according to the parameter set.

*Additional parameters:*

* **Mask** - resizes surface and clips the content inside the surface. Content within surface stays anchored and does not wrap or stretch.

* **Wrap** - resizes surface and wraps the content inside the surface. Content within surface constantly adapts to the new surface size.

> Value: Density Pixels (width + height)


### Rotate

To change an object’s orientation by rotating it around its anchor point.

*Additional parameters:*

* **Clockwise** – Rotates the object in a clockwise motion.

* **Counterclockwise** – Rotates the object in a counterclockwise motion.


> Value: Degrees


### Fade

To change the opacity / transparency of an object.

> Value: Percentage


### Tint

To change the color of an object by fading in a solid color surface

> Value: RGBA


---

## Values

Values are the units in which a specific movement is measured.


### Density Pixels (dp)

Used to move and resize objects.


### Percentages (%)

Used to scale and fade objects.


### Degrees (º)

Used to rotate objects.


---

## Behavior Types

Enter
Move In
Fade In
Scale In

Exit
Move Out
Fade Out
Scale Out
# Motion Language

Motion design comes with a large set of unique language and terminology. The language defined here is used as the base of the Material Motion framework.

---

## Interaction Types

**Triggered** – Motion that is driven by an event, like tapping a button or dragging beyond a threshold. The motion is predetermined.

**Gestured** – Motion that is directly correlated to a user's continuous input. There can be triggered events during gestural motion.

---

## Conjunctions


### To

The absolute end value of a property change.


### From

The absolute beginning value of a property change.


### By

The relative delta of a property change.

> If an element moves along the X axis **by** 10dp, its destinated is calculated by adding 10dp to its current X-value.

---

## Motion Types


### Move

To change the positional value of an object along the X, Y or Z axis by a linear path.

*Additional Parameters:*

* **Arc** – To change the positional value of an object along the X, Y or Z axis by an arced path.

> Value: dp

### Scale

To stretch the material surface and its content as one whole unit from its anchor point.

> Value: %

### Resize

To change the size of the material surface from its anchor point without stretching its content. Content inside will adapt according to the parameter set.

*Additional parameters:*

* **Mask** - resizes surface and clips the content inside the surface. Content within surface stays anchored and does not wrap or stretch.

* **Wrap** - resizes surface and wraps the content inside the surface. Content within surface constantly adapts to the new surface size.

> Value: dp


### Rotate

To change an object’s orientation by rotating it around its anchor point.

*Additional parameters:*

* **Clockwise** – Rotates the object in a clockwise motion.

* **Counterclockwise** – Rotates the object in a counterclockwise motion.


> Value: º


### Fade

To change the opacity / transparency of an object.

*Additional parameters:*

Fade Out - fades the object to 0% opacity from its initial value.
Fade In - fade the object to 100% opacity from its initial value.

> Value: %


### Tint

To change the color of an object by fading in a solid color surface

> Value: RGBA

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
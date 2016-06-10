# Actions

Actions are verbs used to define a specific movement and must be used with a connector and a value.


### Move

To change the positional value of an object along the X and/or Y axis along a linear path.

*Additional Parameters:*

* **Arc** – To change the positional value of an object along the X, Y or Z axis by an arced path.


### Scale

To stretch the material surface and its content as one whole unit from its anchor point.


### Resize (aka Transform)

To change the size of the material surface from its anchor point without stretching its content. Content inside will adapt according to the parameter set.

*Additional parameters:*

* **Mask (aka Clip)** - resizes surface and clips the content inside the surface. Content within surface stays anchored and does not wrap or stretch.

* **Wrap** - resizes surface and wraps the content inside the surface. Content within surface constantly adapts to the new surface size.


### Rotate

To change an object’s orientation by rotating it around its anchor point.

*Additional parameters:*

* **Clockwise** – Rotates the object in a clockwise motion using the **by** connector.

* **Counterclockwise** – Rotates the object in a counterclockwise motion using the **by** connector.


### Fade

To change the opacity / transparency of an object.


### Elevate

To change the elevation value of an object along the Z axis.


### Tint

To change the color of an object by fading in a solid color surface

<!--

LGTM:

-->

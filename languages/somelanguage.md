# Motion Language

Motion design comes with a large set of unique language and terminology. The language defined here is used as the base of the Material Motion framework.

---

# Types of Motion

--

### Triggered

Motion that is driven by an event, like tapping a button or dragging beyond a threshold. The motion is predetermined.

### Gestural

Motion that is directly correlated to a user's continuous input. There can be triggered events during gestural motion.

---

# Connectors

Connectors are conjunctions used to connect a motion type and a value.


### To

The absolute end value of a property change.

> If an element moves along the X axis **to** (0,0), its its destination will be (0,0). A **from** value is not required.


### From

The absolute beginning value of a property change.

> If an element moves along the X axis **from** (0,0), its origin is set to the (0,0) state before movement begins. A **to** value is required, and a **from** value should only be used if the initial property value of the animation is different than the current state of the property value.


### By

The relative delta of a property change.

> If an element moves along the X axis **by** 10dp, its destination is calculated by adding 10dp to its current X-value.


### Over

The duration of an animation.

> If an element moves **over** 300ms, it completes this movement over a duration of 300ms.


### After

An animation waits a certain amount of time to be triggered.

> If an element moves **after** 600ms, it waits 600ms to begin this movement.


### With (TBD)

The easing curve applied to an animation.

> If an element moves **with** a specific easing curve, it completes this movement using the defined easing curve's acceleration and deceleration.


---

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


---

# Easing

Easing affects the velocity of an animating property.


### Acceleration

Easing is applied to the beginning of the animation to make it speed up from a stop.


### Deceleration

Easing is applied to the end of the animation to make it slow down to a stop.


### Constant

Easing is not applied, and the velocity is constant throughout the tween.


---

# Values

Values are the units in which a specific movement is measured.


### Density Pixels (dp)

Used to move and resize objects.


### Percentages (%)

Used to scale and fade objects.


### Degrees (º)

Used to rotate objects.


### RGB (0,0,0)

Used to determine color tint of objects.


### Time (ms)

Used define the duration of an animation.


---

# Input

The types of input that can produce movement.

### Tap

Tapping on an object triggers an event.


### Press

An event is triggered immediately when a tap begins.


### Release

An event is triggered when the user lifts from a tap.


### Hold

Tapping and holding on an object.


### Pressure Tap

Force touch.


### Pinch

Pinch to zoom, can enable rotation?


### Swipe

Horizontally or vertically.


### Scroll

Horizontally or vertically.


### Drag

Multi-directional, free-roam.


### Orient

Changing the orientation of the device.


---

# Simulation

Simulated physics used to achieve an animation.


### Friction

Affects how long it takes and how far an object travels while decelerating.


### Resistance

Affects how far an object moves in relation to the actual drag distance.


### Overshoot

Affects how many times an object overshoots its target location before coming to a rest.


### Attraction

Describes the relationship between objects that are magnetically attracted to one another.


### Repulsion

Describes the relationship between objects that are magnetically repelled by one another.


---


# Properties

Properties that affect the visual appearance of an object.


### Position

The **Position** property is controlled by the **Move** action, and is measured in **Density Pixels**.


### Elevation

The **Elevation** property is controlled by the **Elevate** action, and is measured in **Density Pixels**.


### Scale

The **Scale** property is controlled by the **Scale** action, and is measured in **Percentages**.


### Width

The **Width** property is controlled by the **Resize** action, and is measured in **Density Pixels** or **Percentages**.


### Height

The **Height** property is controlled by the **Resize** action, and is measured in **Density Pixels** or **Percentages**.


### Rotation

The **Rotation** property is controlled by the **Rotate** action, and is measured in **Degrees**.


### Opacity

The **Opacity** property is controlled by the **Fade** action, and is measured in **Percentages**.


### Anchor Point

The **Anchor Point** property is the point at which the coordinates of the **Position** property is set, and is measured in **Density Pixels**. This can influence the **Move** and **Rotate** actions.


---


# Patterns

Pre-determined patterns to achieve common motion design.


### Entrances

Move In

Fade In

Scale In


### Exits

Move Out

Fade Out

Scale Out

Swipe to Dismiss

---


# Other Vocabulary

Words we haven't defined and may not be apart of the Odeon language, but are still useful to know.

### Transition

Description.

### View Transition

Description.

### Element-contained Transition

Description.

### Animation

Description.

### Tween

Description.

### Dismiss

Description.

### Squish

Description.

### Stretch

Description.

### Bounds

Description.
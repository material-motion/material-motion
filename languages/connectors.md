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

<!--

LGTM:

-->

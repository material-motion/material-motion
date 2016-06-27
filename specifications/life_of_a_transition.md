Status of this document:
![](../_assets/under-construction-flashing-barracade-animation.gif)

# Life of a Transition

Let's walk through the life of a transition.

>Remember, any code you see here is pseudo-code.

TODO: Discuss the life-cycle of a Transition.

- Create a Transition Controller
- Provide the controller with Director types to be used.
- When the transition is initiated, controller is invoked.
- Controller creates a Runtime.
- Controller creates Directors.
- Controller calls setUp on each Runtime.
- Controller listens to Runtime activity state change event.
- Controller starts the Runtime.
- When Runtime idles, Controller indicates that the transition has completed.
- Controller likely needs to extract "completed" vs "canceled" state from the Director.

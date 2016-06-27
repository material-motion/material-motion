Status of this document:
![](../_assets/under-construction-flashing-barracade-animation.gif)

# Life of a Transition

Let's walk through the life of a simple fade transition.

>Remember, any code you see here is pseudo-code.

### Step 1: Define a new TransitionDirector type

This object will provide the transition-specific plans.

    FadeTransitionDirector: TransitionDirector {
    }

### Step 2: Implement the Director setUp method

Our `setUp` will be involve a simple tween plan:

    function setUp(transaction) {
      var tween = Tween(property: "opacity")
      if self.direction == .ToTheRight {
        tween.from = 0
        tween.to = 1
      } else {
        tween.from = 1
        tween.to = 0
      }
      transaction.add(tween, target: rightElement)
    }

### Step 1: Create a transition controller

A `TransitionController` is the configuring entity for a transition.

    transitionController = TransitionController()

An instance of this type might lazily available for any transition on our platform. For example, on iOS each view controller might have its own transition controller.

    viewController.transitionController

### Step 2: Set the director

    transitionController.director = FadeTransitionDirector

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

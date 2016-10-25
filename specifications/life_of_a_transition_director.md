# Life of a transition director

Let's walk through the life of a simple fade transition director.

> Remember, any code you see here is pseudo-code.

### Step 1: Create a new TransitionDirector type

This object will provide transition-specific plans.

```
TransitionDirector Fade {
}
```

### Step 2: Implement the director's setUp method

Our `setUp` will use a simple tween plan:

```
function setUp() {
  var tween = Tween(.opacity, duration: transitionDuration())
  tween.duration = 0.3
  if initialDirection == .forward {
    tween.from = 0
    tween.to = 1
  } else {
    tween.from = 1
    tween.to = 0
  }
  addPlan(tween, to: forwardElement)
}
```

Or if our plans have a concept of direction:

```
function setUp(transaction) {
  var tween = Tween(.opacity, duration: transitionDuration())
  tween.duration = 0.3
  tween.back = 0
  tween.fore = 1
  tween.direction = initialDirection
  planEmitter.addPlan(tween, to: forwardElement)
}
```

### Step 3: Access a transition controller

A `TransitionController` is the configuring entity for a transition.

```
transitionController = TransitionController()
```

An instance of this type might be lazily available for any transition on our platform.

> _Platform-specific example_: iOS
> 
> Each view controller might have its own transition controller. This transition controller governs the present\/dismiss transitions of that particular view controller.
> 
> ```
> viewController.transitionController
> ```

### Step 4: Set the director

Provide the `FadeTransitionDirector` type to the transition controller.

```
transitionController.directorClass = typeof(FadeTransitionDirector)
```

### Step 5: Initiate the transition

Initiating our transition causes `FadeTransitionDirector` to be instantiated and its `setUp` method is invoked. The plans expressed by the director will then be executed.

Upon completion, the director instance is thrown away. The transition controller resets its internal state in preparation for a future transition.


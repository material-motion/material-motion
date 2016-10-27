# Life of a context transition director

| Discussion thread | Status |
|:------------------|:-------|
| ![](../../../_assets/under-construction-flashing-barracade-animation.gif) | Drafting as of Oct 25, 2016 |

Let's walk through the life of a simple **fade** transition director.

> Remember, any code you see here is pseudo-code.

### Step 1: Define a new TransitionDirector type

This object conforms to the `TransitionDirector` type.

```
class FadeTransitionDirector: TransitionDirector {
  let transition: Transition
  init(transition: Transition) {
    self.transition = transition
  }
}
```

### Step 2: Implement the setUp method

Our `setUp` might use a simple [`Tween`](https://material-motion.gitbooks.io/material-motion-starmap/content/specifications/plans/Tween.html) plan:

```
class FadeTransitionDirector: TransitionDirector {
  function setUp() {
    var tween = Tween(.opacity, duration: transition.duration)
    if initialDirection == .forward {
      tween.from = 0
      tween.to = 1
    } else {
      tween.from = 1
      tween.to = 0
    }
    transition.addPlan(tween, to: transition.fore)
  }
}
```

Or [`TweenBetween`](https://material-motion.gitbooks.io/material-motion-starmap/content/specifications/plans/TweenBetween.html) to reduce the need for conditional logic:

```
class FadeTransitionDirector: TransitionDirector {
  function setUp() {
    var tween = TweenBetween(.opacity,
                             window: transition.window,
                             segment: transition.entire,
                             back: 0,
                             fore: 1)
    transition.addPlan(tween, to: transition.fore)
  }
}
```

### Step 3: Associate the director with a transition controller

This step is platform-specific.

### iOS

To configure the `present`/`dismiss` transition for a view controller, set the Director on the view controller's `transitionController`:

```
viewController.mdm_transitionController.directorType = typeof(FadeContextTransitionDirector)
```

### Step 4: Initiate the transition

Initiating our transition causes `FadeTransitionDirector` to be instantiated and its `setUp` method is invoked. The plans expressed by the director will then be executed.

Upon completion, the director instance is thrown away.

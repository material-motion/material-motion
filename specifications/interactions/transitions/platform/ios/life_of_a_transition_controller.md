# Life of a transition controller

| Discussion thread | Status |
|:------------------|:-------|
| ![](../../../../../_assets/under-construction-flashing-barracade-animation.gif) | Drafting as of Oct 25, 2016 |

Let's walk through the life of an arbitrary transition.

> Remember, any code you see here is pseudo-code.

### Step 1: Create a transition controller

Every view controller has its own transition controller. A transition controller is responsible for handling how a view controller is presented and dismissed.

For example:

```
viewController.mdm_transitionController
```

Transition controllers are created **lazily**. In the absence of a transition controller, standard system transitions takes effect.

Accessing the transition controller will assign it to the view controller's `transitioningDelegate` property.

### Step 2: Specify which Director to use

Assign a TransitionDirector type to the transition controller.

```
viewController.mdm_transitionController.directorType = typeof(FadeTransitionDirector)
```

TransitionController uses this value to instantiate a director when a transition is initiated.

### Step 3: Initiate a transition

Use standard view controller presentation APIs:

```
present(viewController, animated: true)
```

#### Step 3.1: Create a TransitionDriver

The transition controller creates a `TransitionDriver` in reaction to a transition being initiated.

The TransitionDriver is expected to create the scheduler and director required to drive the transition. When the scheduler reaches an idle state, the TransitionDriver is expected to inform the TransitionController. The TransitionController then informs iOS that the transition has terminated.

```
transitionWillStart(initialDirection) {
  let transition = Transition(initialDirection)
  let director = directorType(transition)
  driver = TransitionDriver(director)
}

class TransitionDriver {
  let scheduler
  initWithDirector(director) {
    scheduler = Scheduler()
    director.setPlanEmitter(scheduler)
    director.setUp()

    scheduler.addActivityStateObserver({
      if scheduler.activityState == isIdle {
        self.transitionDidComplete()
      }
    })
  }
}
```

### Step 4: Once the runtime idles, terminate the transition

Once the transition controller detects that the scheduler activity has idled, the transition controller should terminate the transition. How this is communicated will depend on the platform.

> On iOS, for example, the transition controller must invoke a specific method to inform UIKit that the transition has either completed or canceled.

The TransitionRunner is responsible for invoking `tearDown` on the director.

```
class TransitionRunner {
  function transitionDidFinish() {
    director.tearDown()
  }
}
```

At this point the transition controller might throw away its `TransitionRunner` instance.


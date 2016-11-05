---
layout: page
---

# Life of a transition controller

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

#### Step 3.1: Create the Director instance

The transition controller creates an instance of the Director when a transition is initiated. The Director must be provided a Transition instance that has been populated with the relevant information.

```
transitionWillStart(initialDirection) {
  let runtime = Runtime()
  runtime.delegate = self
  let transition = Transition(initialDirection,
                              runtime: runtime,
                              back: back,
                              fore: fore)
  director = directorType(transition)
}
```

### Step 4: Terminate the transition once the runtime idles

The transition controller informs iOS that the transition has completed once the runtime has idled.

The transition controller now releases its Director instance.

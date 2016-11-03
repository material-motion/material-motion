---
layout: page
---

# TransitionController specification

| Discussion thread | Status |
|:------------------|:-------|
| ![](/assets/under-construction-flashing-barracade-animation.gif) | Drafting as of Oct 25, 2016 |

This is the engineering specification for the `TransitionController` object.

## Overview

`TransitionController` is a bridge between the platform's transitioning architecture and a `TransitionDirector`.

## MVP

**Concrete type**: A `TransitionController` is a concrete type.

Example pseudo-code:

```
TransitionController {
}
```

**One transition controller per view controller**: Every view controller stores its own weakly-created `TransitionController` instance.

**directorClass API**: Provide an API for storing a `TransitionDirector` type.

The type must represent an object that conforms to the `TransitionDirector` type.

Example pseudo-code:

    TransitionController {
      public var directorClass: TransitionDirector.type

**Transition will start**: The following should occur when a transition is about to begin:

1. Initialize the director
2. Invoke the `setUp` event on the director
3. Commit the `setUp` transaction to a runtime

Example pseudo-code:

```
TransitionController {
  function transitionWillStart(initialDirection) {
    let runtime = Runtime()
    runtime.delegate = self
    let transition = Transition(...)
    director = directorClass(transition)
  }
}
```

**Finish on idle**: Finish the transition when the runtime enters the idle activity state.

## Open Questions

- How do we handle directors that never enter the .Active state?

Status of this document:
![](../_assets/under-construction-flashing-barracade-animation.gif)

# Context element feature specification

The context element is what that the user interacted with in order to initiate the transition.

## MVP

**Context element API**: Provide an API for retrieving the transition's context element.

Example pseudo-code:

```
TransitionDirector {
  readonly var contextElement
}
```

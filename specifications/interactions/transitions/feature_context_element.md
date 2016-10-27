# Context element feature specification

| Discussion thread | Status |
|:------------------|:-------|
| ![](../../../_assets/under-construction-flashing-barracade-animation.gif) | Drafting as of Oct 25, 2016 |

The context element is what that the user interacted with in order to initiate the transition.

## MVP

**Context element API**: Provide an API for retrieving the transition's context element.

Example pseudo-code:

```
Transition {
  readonly var contextElement
```

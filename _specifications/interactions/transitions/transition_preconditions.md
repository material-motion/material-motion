---
layout: page
---


# Transition preconditions feature specification

| Discussion thread | Status |
|:------------------|:-------|
| ![](/assets/under-construction-flashing-barracade-animation.gif) | Drafting as of Oct 25, 2016 |

## MVP

A transition can register certain pre-conditions. If any pre-condition fails, the director will not be selected for use in the transition.

**Preconditions API**: Provide an API for returning preconditions.

Example pseudo-code:

```
TransitionDirector {
  preconditions() -> [Precondition] {
    return [Precondition({
      return elementExists
    })]
  }
}
```



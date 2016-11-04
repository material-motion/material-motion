---
layout: page
title: "TransitionDirector preconditions"
status:
  date: Oct 25, 2016
  is: Drafting
---

# TransitionDirector preconditions feature specification

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



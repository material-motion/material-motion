---
layout: page
title: FadeIn
status:
  date: Nov 12, 2016
  is: Stable
---

# FadeIn specification

```
import Transitions
import TransitionTween

class FadeInTransitionDirector: TransitionDirector {
  let transition: Transition
  required init(transition: Transition) {
    self.transition = transition
  }

  func setUp() {
    let fadeIn = TransitionTween("opacity",
                                 window: transition.window,
                                 direction: transition.direction,
                                 segment: .entire,
                                 back: 0,
                                 fore: 1)
    fadeIn.timingFunction = .easeInEaseOut
    fadeIn.timeline = transition.timeline
    transition.runtime.addPlan(fadeIn, to: transition.fore)
  }
}
```

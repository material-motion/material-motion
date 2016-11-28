---
layout: page
title: FadeIn
status:
  date: Nov 12, 2016
  is: Stable
---

# FadeIn specification

```swift
import Transitions
import TransitionTween

class FadeInTransitionDirector: TransitionDirector {
  func willBeginTransition(_ transition: Transition) {
    let fadeIn = TransitionTween(.opacity,
                                 transition: transition,
                                 segment: .entire,
                                 back: 0,
                                 fore: 1)
    fadeIn.timingFunction = .easeInEaseOut
    transition.runtime.addPlan(fadeIn, to: transition.fore.element)
  }
}
```

---
layout: page
title: FadeIn
status:
  date: Nov 12, 2016
  is: Stable
knowledgelevel: L1
library: transitions-catalog
depends_on:
  - /starmap/specifications/interactions/transitions/Transition
  - /starmap/specifications/plans/TransitionTween
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

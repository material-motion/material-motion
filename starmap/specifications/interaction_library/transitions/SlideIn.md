---
layout: page
title: SlideIn
status:
  date: Nov 12, 2016
  is: Stable
---

# SlideIn specification

```swift
import Transitions
import TransitionTween

class SlideInTransitionDirector: TransitionDirector {
  func willBeginTransition(_ transition: Transition) {
    let position = transition.fore.position.y
    let height = transition.fore.height
    let slide = TransitionTween(.positionY,
                                transition: transition,
                                segment: .entire,
                                back: position + height,
                                fore: position)
    slide.timingFunction = .easeOut
    transition.runtime.addPlan(slide, to: transition.fore.element)
  }
}
```

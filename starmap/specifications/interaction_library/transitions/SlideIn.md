---
layout: page
title: SlideIn
status:
  date: Nov 12, 2016
  is: Stable
---

# SlideIn specification

```
import Transitions
import Tween

class SlideInTransitionDirector: TransitionDirector {
  let transition: Transition
  required init(transition: Transition) {
    self.transition = transition
  }

  func setUp() {
    let position = transition.fore.position.y
    let height = transition.fore.height
    let slide = TransitionTween("position.y",
                                window: transition.window,
                                direction: transition.direction,
                                segment: .entire,
                                back: position + height,
                                fore: position)
    slide.timingFunction = .easeOut
    slide.timeline = transition.timeline
    transition.runtime.addPlan(slide, to: transition.fore)
  }
}
```

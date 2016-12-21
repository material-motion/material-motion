---
layout: page
title: TransitionTween
status:
  date: Nov 1, 2016
  is: Stable
knowledgelevel: L2
library: transition-tween
depends_on:
  - /starmap/specifications/runtime/Plan
  - /starmap/specifications/plans/Tween
  - /starmap/specifications/interactions/transitions/Transition
proposals:
  - proposal:
    initiation_date: Oct 20, 2016
    completion_date: Nov 1, 2016
    state: Accepted
    discussion: "TransitionTween plan"
    discussion_url: https://groups.google.com/forum/#!topic/material-motion/uoBbUAK0LCE
---

# TransitionTween specification

TransitionTween describes tween animations that occur during a transition between two states.

> Note that this motion family can/should compose to [`Tween`](Tween).

## Contract

```swift
Plan TransitionTween {
  var property
  var backValue
  var foreValue
  var segment: TransitionSegment
  var timingFunction: TimingFunction = .linear
  var backwardSegment: TransitionSegment?
  var backwardTimingFunction: TimingFunction?
  var transition: Transition
}
```

`property` is any animatable value on the target object.

`back` is the destination value when the direction is backward.

`fore` is the destination value when the direction is forward.

`segment` is the portion of the transition window in which the animation should occur during a forward transition. If no `backwardSegment` is provided then `segment` will be used instead, though its position will be inverted to correspond to the correct time for the backward transition.

`timingFunction` is the timing function to use when initially animating forward. Is linear by default. If no `backwardTimingFunction` is provided then `timingFunction` will be inverted and used instead.

`backwardSegment` is the portion of the transition window in which the animation should occur during a backward transition.

`backwardTimingFunction` is the timing function to use when initially animating backward.

`transition` is the transition within which the `segment` applies.

## Example: Fade transition

    TransitionDirector Fade {
      func setUp() {
        const var fade = TransitionTween("opacity",
                                   transition: transition,
                                   segment: .init(position: 0, length: 1),
                                   back: 0,
                                   fore: 1)
        addPlan(fadeIn, to: forwardElement)
      }
    }

## Example: Slide transition

    TransitionDirector Slide {
      func setUp() {
        const var shiftUp = TransitionTween("position",
                                      transition: transition,
                                      segment: .init(position: 0, length: 1),
                                      back: bottomEdge,
                                      fore: topEdge)
        addPlan(shiftUp, to: forwardElement)
      }
    }

## Plan considerations

Provide convenience APIs for describing both back- and foreward segments with one call. For example:

```swift
transitionTween.segment = .init(position: 0, length: 0.5)
```

would initialize `forwardSegment` as the first half and `backwardSegment` as the last half.

## Performer considerations

A TransitionTweenPerformer will generate different tweens based on the initial direction. Consider the following examples:

```swift
window = TransitionWindow(duration: 0.4s)
TransitionTween("opacity",
                transition: transition,
                segment: .init(position: 0, length: 0.25),
                back: 0,
                fore: 1)
```

When initial direction == forward:

```swift
const var forwardTween = Tween("opacity", duration: 0.1s)
forwardTween.from = 0
forwardTween.to = 1
```

When initial direction == backward:

```swift
const var backwardTween = Tween("opacity", duration: 0.1s)
backwardTween.delay = 0.3s
backwardTween.from = 1
backwardTween.to = 0
```

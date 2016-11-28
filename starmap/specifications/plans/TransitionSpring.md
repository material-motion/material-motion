---
layout: page
title: TransitionSpring
status:
  date: Nov 20, 2016
  is: Draft
---

# TransitionSpring specification

TransitionSpring describes spring animations that occur during a transition between two states.

> Note that this motion family can/should compose to [`SpringTo`](SpringTo).

## Contract

```swift
Plan TransitionSpring {
  var property
  var backDestination
  var foreDestination
  var transition: Transition
  var configuration: SpringConfiguration
  var backwardConfiguration: SpringConfiguration?
}
```

`property` is any animatable value on the target object.

`backDestination` is the destination value when the direction is backward.

`foreDestination` is the destination value when the direction is forward.

`transition` is the transition within which the `segment` applies.

`configuration` is the configuration to apply to the spring.

`backwardConfiguration` is the configuration to apply to the spring when the transition is moving
backward. If not provided, `configuration` will be used instead.

## Performer considerations

Your performer should set the initial value to the target when a plan is added.

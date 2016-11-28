---
layout: page
title: Performer composition
status:
  date: July 8, 2016
  is: Stable
availability:
  - platform:
    name: Android
    label: "runtime-android as of v2.0.0"
    url: https://github.com/material-motion/material-motion-runtime-android
  - platform:
    name: iOS
    label: "runtime-objc as of v3.0.0"
    url: https://github.com/material-motion/material-motion-runtime-objc
---

# Performer composition feature specification

Performers can emit new plans. This is a type of composition.

Composition enables the creation of higher-order plans. For example, a "Tossable" plan's performer might generate a "Draggable" and "AttachedSpring" plan. Or more simply, a "FadeIn" plan might compose out to a more general-purpose "Tween" plan.

Composition enables code reuse in the Material Motion ecosystem.

## MVP

### PlanEmitter API

A performer may be provided with a plan emitter object.

A PlanEmitter emits plans only for the performer's associated target.

> The Performer may choose not to receive such an object.

A plan emitter declaration might look like so:

```swift
protocol PlanEmitter {
  func emitPlan(Plan)
}
```

A performer can be provided with a plan emitter.

Example pseudo-code protocol that a performer could conform to:

```swift
protocol ComposablePerforming {
  func set(planEmitter: PlanEmitter)
}
```

Pseudo-code of a performer emitting new plans:

```swift
function onGesture(gesture) {
  if gesture.state == Ended {
    planEmitter.emitPlan(Spring())
  }
}
```


---
layout: page
title: Applying constraints to interactions
status:
  date: April 18, 2017
  is: Stable
interfacelevel: L2
implementationlevel: L4
library: material-motion
depends_on:
  - /starmap/specifications/observable/MotionObservable
  - /starmap/specifications/interactions/
proposals:
  - proposal:
    completion_date: April 19, 2017
    state: Stable
    discussion: "Introduced spec."
availability:
  - platform:
    name: Android 
    url: https://github.com/material-motion/material-motion-android/blob/develop/library/src/main/java/com/google/android/material/motion/MotionRuntime.java
  - platform:
    name: iOS (Swift)
    url: https://github.com/material-motion/material-motion-swift/blob/develop/src/MotionRuntime.swift
---

# Applying constraints to interactions

This is the engineering specification for applying constraints to `Interaction` instances.

## Overview

Constraints are **operators** that are applied to interactions being added to a MotionRuntime.

```swift
runtime.add(Draggable(), to: view, constraints: { $0.xLocked(to: 100) })
```

Constraints can be added to one or more streams connected by the interaction - which streams are ultimately affected is defined on a per-interaction basis and should be well-documented.

## MVP

### Add a constraints generic type to Interaction

The constraints type is generic in order to allow interactions to define custom constraint types. Add an optional constraints argument to Interaction.add's API.

```swift
protocol Interaction {
  associatedtype Target
  associatedtype Constraints

  func add(to target: Target, withRuntime runtime: MotionRuntime, constraints: Constraints?)
}
```

### Add a constraints argument to runtime.add

The argument should be typed on the Interaction's generic Constraints type. The argument is optional and defaults to nil, indicating no constraints should be applied to the interaction.

```swift
class MotionRuntime {
  func add<I: Interaction>(_ interaction: I, to target: I.Target, constraints: I.Constraints? = nil)
}
```

### Pass the constraints to the interaction instance on runtime.add

```swift
class MotionRuntime {
  func add<I: Interaction>(_ interaction: I, to target: I.Target, constraints: I.Constraints? = nil) {
    ...
    interaction.add(to: target, withRuntime: self, constraints: constraints)
    ...
  }
}
```

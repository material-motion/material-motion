---
layout: page
title: MotionRuntime.toggle
status:
  date: March 29, 2017
  is: Stable
interfacelevel: L1
implementationlevel: L4
library: material-motion
depends_on:
  - /starmap/specifications/runtime/
proposals:
  - proposal:
    completion_date: March 29, 2017
    state: Stable
    discussion: "Introduced spec."
availability:
  - platform:
    name: Android 
    url: https://github.com/material-motion/reactive-motion-android/blob/develop/library/src/main/java/com/google/android/reactive/motion/MotionRuntime.java
  - platform:
    name: iOS (Swift)
    url: https://github.com/material-motion/material-motion-swift/blob/develop/src/MotionRuntime.swift
---

# MotionRuntime.toggle specification

This is the engineering specification for the `MotionRuntime`'s `toggle` API.

## Overview

Togglable objects can be toggled by Stateful objects whenever the Stateful object's state changes.

## MVP

### Expose a toggle API

Accept two interactions: the first being `Togglable` and the second being `Stateful`.

```swift
class MotionRuntime {
  public func toggle(_ interaction: Togglable, inReactionTo otherInteraction: Stateful)
}
```

### Connect state to enabled

Connect the stateful interaction's `state` property to the togglable interaction's `enabled`
property.

```swift
class MotionRuntime {
  public func toggle(_ interaction: Togglable, inReactionTo otherInteraction: Stateful) {
    connect(otherInteraction.state.rewrite([.atRest: true, .active: false]), to: interaction.enabled)
  }
}
```

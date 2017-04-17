---
layout: page
title: MotionRuntime.toggle
status:
  date: March 29, 2017
  is: Proposed
interfacelevel: L1
implementationlevel: L4
library: material-motion
depends_on:
  - /starmap/specifications/runtime/
  - /starmap/specifications/operators/rewrite
proposals:
  - proposal:
    completion_date: March 29, 2017
    state: Stable
    discussion: "Introduced proposal."
availability:
  - platform:
    name: iOS (Swift)
    url: https://github.com/material-motion/material-motion-swift/blob/develop/src/MotionRuntime.swift
---

# MotionRuntime.toggle specification

This is the engineering specification for the `MotionRuntime`'s `toggle` API.

## Overview

Togglable objects can be toggled by Stateful objects whenever the Stateful object's state changes.

When the stateful object is **active**, the togglable object is **disabled**.

When the stateful object is **at rest**, the togglable object is **enabled**.

This relationship is most commonly used with springs and gestures. When the gesture is active, the
spring is disabled. When the gesture comes to rest, the spring is enabled.

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

When the state is `atRest`, set enabled to `true`.

When the state is `active`, set enabled to `false`.

```swift
class MotionRuntime {
  public func toggle(_ interaction: Togglable, inReactionTo otherInteraction: Stateful) {
    connect(otherInteraction.state.rewrite([.atRest: true, .active: false]), to: interaction.enabled)
  }
}
```

---
layout: page
title: MotionRuntime.addInteraction
status:
  date: March 29, 2017
  is: Stable
interfacelevel: L1
implementationlevel: L4
library: material-motion
depends_on:
  - /starmap/specifications/runtime/
  - /starmap/specifications/interactions/
proposals:
  - proposal:
    completion_date: March 29, 2017
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

# MotionRuntime.addInteraction specification

This is the engineering specification for the `MotionRuntime`'s `addInteraction` API.

## Overview

Interactions can be added to a MotionRuntime using the `add`/`addInteraction` API.

## MVP

### Expose an add API

> This API may alternatively be called `addInteraction`.

Accept an interaction, a target, and an optional constraint. The target and constraints should be
typed according to the interaction's generic type definitions.

```swift
class MotionRuntime {
  public func add<I: Interaction>(_ interaction: I, to target: I.Target, constraints: I.Constraints? = nil)
}
```

### Create private storage for interactions

An array is adequate because we currently have no mechanism for removing interactions once they are
added. The array may need to store typeless object references due to Interaction's generic typing.

> Storing the interactions allows interactions to be delegates of objects they create.

```swift
class MotionRuntime {
  private var interactions: [Any] = []
}
```

### Store all interactions

An array is adequate because we currently have no mechanism for removing interactions once they are
made.

Store the interaction **before** invoking its add API in case the interaction adds other
interactions.

```swift
class MotionRuntime {
  func add<I: Interaction>(_ interaction: I, to target: I.Target, constraints: I.Constraints? = nil) {
    interactions.append(interaction)
    ...
  }
}
```

### Invoke the interaction's add API

Provide the target, runtime, and constraints.

```swift
class MotionRuntime {
  func add<I: Interaction>(_ interaction: I, to target: I.Target, constraints: I.Constraints? = nil) {
    ...
    interaction.add(to: target, withRuntime: self, constraints: constraints)
  }
}
```

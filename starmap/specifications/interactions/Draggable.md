---
layout: page
title: Draggable
status:
  date: March 2, 2017
  is: Stable
interfacelevel: L1
implementationlevel: L2
library: material-motion
depends_on:
  - /starmap/specifications/gesture_recognizers/TranslationGestureRecognizer
  - /starmap/specifications/operators/gesture/translationAddedTo
  - /starmap/specifications/interactions/
availability:
  - platform:
    name: Android 
    url: https://github.com/material-motion/material-motion-android/blob/develop/library/src/main/java/com/google/android/material/motion/interactions/Draggable.java
  - platform:
    name: iOS (Swift)
    url: https://github.com/material-motion/material-motion-swift/blob/develop/src/interactions/Draggable.swift
---

# Draggable specification

This is the engineering specification for the `Draggable` interaction.

## Overview

Allows an element to be moved in reaction to a user's gestural movement.

Example use:

```swift
runtime.add(Draggable(), to: view)
```

## MVP

### Expose a Draggable type

It conforms to the Interaction protocol.

```swift
public class Draggable: Interaction {
}
```

### By default, create a new translation gesture recognizer for each target

When initialized with zero configuration arguments, a Draggable interaction will create a new TranslationGestureRecognizer for each target it's associated with.

```swift
class Draggable {
  func add(...) {
    ...
    let gestureRecognizer = TranslationGestureRecognizer()
    target.addGestureRecognizer(gestureRecognizer)
    ...
  }
}
```

### Fetch a reactive version of the gesture recognizer using runtime.get

This ensures that we're using the same reactive instance across interactions.

```swift
class Draggable {
  func add(...) {
    ...
    let reactiveGesture = runtime.get(gesture)
    ...
  }
}
```

### Connect translationAddedTo operator to the target's position

Write a `translationAddedTo` stream to the target's position.

```swift
class Draggable {
  func add(...) {
    ...
    var stream = reactiveGesture.translation(addedTo: position)
    runtime.connect(stream, to: runtime.get(target).position)
  }
}
```

### Clearly document which property this interaction writes to

```swift
/**
 ...

 **Affected properties**

 - `view.layer.position`

 ...
 */
class Draggable {
}
```

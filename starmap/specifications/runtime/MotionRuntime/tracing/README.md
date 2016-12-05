---
layout: page
title: MotionRuntime tracing
permalink: /starmap/specifications/runtime/MotionRuntime/tracing/
status:
  date: Oct 13, 2016
  is: Stable
depends_on:
  - /starmap/specifications/runtime/MotionRuntime/
knowledgelevel: L4
library: runtime
availability:
  - platform:
    name: Android
    label: Milestone
    url: https://github.com/material-motion/material-motion-runtime-android/milestone/7
  - platform:
    name: iOS
    label: "runtime-objc as of v4.0.0"
    url: https://github.com/material-motion/material-motion-runtime-objc
---

# MotionRuntime tracing feature specification

This is the engineering specification for the `Tracer` abstract type.

## Overview

Tracing is a form of logging in which information is recorded about a program's execution. Tracing can be used for debugging code, writing unit tests, and building user interfaces representing the current state of a system.

Tracing can be enabled on a runtime by providing an instance of an object that conforms to the `Tracer` type.

## MotionRuntime

### AddTracer and RemoveTracer APIs

The runtime should provide APIs for adding and removing tracer instances.

Example pseudo-code:

```swift
class MotionRuntime {
  function addTracer(Tracer)
  function removeTracer(Tracer)
}
```

## Tracer

### Abstract type

Provide an abstract type named `Tracer`.

Example pseudo-code:

```swift
Tracer {
}
```

### didAddPlan: event

The Tracer type can optionally implement a `didAddPlan` function.

Invoked by the runtime when `addPlan` is about to return from its execution.

Invoked after `didCreatePerformer:`, if applicable.

Example pseudo-code:

```swift
Tracer {
  optional function didAddPlan(Plan, to: Target)
}
```

### didAddPlan:named: event

The Tracer type can optionally implement a `didAddPlan:named:` function.

Invoked by the runtime when `addPlan:named:` is about to return from its execution.

Invoked after `didCreatePerformer:`, if applicable.

Example pseudo-code:

```swift
Tracer {
  optional function didAddPlan(Plan, named: String, to: Target)
}
```

### didRemovePlanNamed: event

The Tracer type can optionally implement a `didAddPlan:named:` function.

Invoked by the runtime when `removePlanNamed` is about to return from its execution.

Invoked after `didCreatePerformer:`, if applicable.

Example pseudo-code:

```swift
Tracer {
  optional function didRemovePlanNamed(String, from: Target)
}
```

### didCreatePerformer: event

The Tracer type can optionally implement a `didCreatePerformer` function.

Invoked by the runtime after a new performer instance has been created.

Should be invoked before any corresponding `didAdd*Plan` event.

Example pseudo-code:

```swift
Tracer {
  optional function didCreatePerformer(Performer, for: Target)
}
```

### activityGroupStateDidChange: event

The Tracer type can optionally implement an `activityGroupStateDidChange` function.

Invoked by an activity group each time its activity state changes.

Should be invoked before any state change delegates or observers are invoked.

Example pseudo-code:

```swift
Tracer {
  optional function activityGroupStateDidChange(ActivityGroup)
}
```

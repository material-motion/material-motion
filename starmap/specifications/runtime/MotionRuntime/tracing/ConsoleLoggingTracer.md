---
layout: page
title: ConsoleLoggingTracer
status:
  date: Nov 11, 2016
  is: Stable
knowledgelevel: L2
library: runtime
depends_on:
  - /starmap/specifications/runtime/MotionRuntime/tracing/
proposals:
  - proposal:
    initiation_date: Nov 11, 2016
    completion_date: Nov 14, 2016
    state: Accepted
    discussion: Improved console logging output
    discussion_url: https://github.com/material-motion/starmap/issues/73
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

# ConsoleLoggingTracer feature specification

This is the engineering specification for a `ConsoleLoggingTracer` implementation.

## Overview

Tracing to the console allows an engineer to get a textual read-out of the inner workings of a
runtime.

## MVP

### Is an object that conforms to the Tracing protocol

Example pseudo-code:

```swift
class ConsoleLoggingTracer: Tracing {
}
```


### Plan registration verbosity API

Expose an API for configuring whether plan registration events are written to the console.

This should be **enabled** by default.

```swift
class ConsoleLoggingTracer {
  var planRegistrationLoggingEnabled = true
```

### Performer verbosity API

Expose an API for configuring whether performer events are written to the console.

This should be **disabled** by default.

```swift
class ConsoleLoggingTracer {
  var performerLoggingEnabled = true
```

### Plan string format

A plan should be written to the console with the following format:

```swift
Plan: <Plan name>
  <property name>: <property type> = <property value>
  <property name>: <property type> = <property value>
  ...
```

Example output (swift):

```swift
Plan: MDMTween
  keyPath: NSString = position.y
  duration: @ = 0.3
  delay: @ = 0
  values: NSArray = (
    "1000.5",
    "333.5"
)
  keyPositions: NSArray = (
    0,
    1
)
  timingFunctions: NSArray = (
    easeInEaseOut
)
  timeline: MDMTimeline = <MDMTimeline: 0x60000002b540>
```

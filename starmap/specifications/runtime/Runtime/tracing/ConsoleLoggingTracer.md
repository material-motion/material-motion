---
layout: page
title: ConsoleLoggingTracer
status:
  date: Nov 11, 2016
  is: Stable
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

```
class ConsoleLoggingTracer: Tracing {
}
```


### Plan registration verbosity API

Expose an API for configuring whether plan registration events are written to the console.

This should be **enabled** by default.

```
class ConsoleLoggingTracer {
  var planRegistrationLoggingEnabled = true
```

### Performer verbosity API

Expose an API for configuring whether performer events are written to the console.

This should be **disabled** by default.

```
class ConsoleLoggingTracer {
  var performerLoggingEnabled = true
```

### Plan string format

A plan should be written to the console with the following format:

```
Plan: <Plan name>
  let <property name>: <property type> = <property value>
  let <property name>: <property type> = <property value>
  ...
```

Example output (swift):

```
Plan: MDMTween
  let keyPath: NSString = position.y
  let duration: @ = 0.3
  let delay: @ = 0
  let values: NSArray = (
    "1000.5",
    "333.5"
)
  let keyPositions: NSArray = (
    0,
    1
)
  let timingFunctions: NSArray = (
    easeInEaseOut
)
  let timeline: MDMTimeline = <MDMTimeline: 0x60000002b540>
```

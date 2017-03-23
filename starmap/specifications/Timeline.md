---
layout: page
title: Timeline
status:
  date: February 16, 2016
  is: Draft
interfacelevel: L2
implementationlevel: L4
library: reactive-motion
depends_on:
  - /starmap/specifications/streams/MotionObservable
proposals:
  - proposal:
    initiation_date: Nov 11, 2016
    completion_date: Nov 17, 2016
    state: Accepted
    discussion: "Timeline spec review"
    discussion_url: https://groups.google.com/forum/#!topic/material-motion/hLMbEEzUV4Y
  - proposal:
    initiation_date: Feb 16, 2017
    state: Draft
    discussion: "Drafting new reactive API"
availability:
  - platform:
    name: iOS (Swift)
    url: https://github.com/material-motion/material-motion-swift/blob/develop/src/Timeline.swift
interaction:
  inputs:
    - input:
      name: paused
      type: Bool
    - input:
      name: timeOffset
      type: Float
  outputs:
    - output:
      name: default
      type: Timeline.Snapshot
---

# Timeline specification

This is the engineering specification for the `Timeline` object.

## Overview

A timeline provides an API for scrubbing time.

## MVP

### Object type

A timeline is an object.

```swift
class Timeline {
}
```

### Input: Paused reactive property

A timeline has a reactive property named `paused` of type `Bool`. The default value is false.

```swift
class Timeline {
  public const paused: ReactiveProperty<Bool> = createProperty(withInitialValue: false)
}
```

### Input: timeOffset reactive property

A timeline has a reactive property named `timeOffset` of type `Float`. The default value is 0.

```swift
class Timeline {
  public const timeOffset: ReactiveProperty<Float> = createProperty(withInitialValue: 0)
}
```

### Constant: beginTime

A timeline has a constant named `beginTime` of type `Float`. The default value is the time at which
the timeline was created.

```swift
class Timeline {
  public const beginTime: Float = Time.Now()
}
```

### Output: snapshots

A timeline can be converted to a MotionObservable that emits snapshots of the timeline's state.

```swift
class Timeline {
  public func asStream() -> MotionObservable<Timeline.Snapshot>
}
```

The stream is expected to subscribe to all of the input properties and, upon changes from any of
them, emit an updated Snapshot instance. The implementation should only emit when the value has
changed.

The snapshot is expected to contain the following information:

```swift
struct Snapshot {
  const paused: Bool
  const beginTime: Float
  const timeOffset: Float
}
```

### Timeline/Interaction coordination

Interactions that support being scrubbed by a Timeline are expected to provide an optional
`timeline` property.

```swift
class SomeInteraction {
  public var timeline: Timeline?
}
```

If a timeline **is not** associated with an interaction, then the interaction should start
immediately upon registration with the runtime.

If a timeline **is** associated with an interaction, then the interaction should subscribe to the
timeline's stream and react to snapshots. Interactions should set their `beginTime` to the
timeline's `beginTime`; this ensures that all interactions are scheduled in relation to the
timeline.

If the timeline is paused, the interaction should update its own `timeOffset` to match the
timeline's. If the timeline is not paused, the interaction can ignore the `timeOffset`.

![]({{ site.url }}/assets/timeline.svg)

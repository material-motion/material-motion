---
layout: page
title: Timeline
status:
  date: February 16, 2016
  is: Draft
knowledgelevel: L2
library: reactive-motion
proposals:
  - proposal:
    initiation_date: Nov 11, 2016
    completion_date: Nov 17, 2016
    state: Accepted
    discussion: "Timeline spec review"
    discussion_url: https://groups.google.com/forum/#!topic/material-motion/hLMbEEzUV4Y
availability:
  - platform:
    name: iOS (Swift)
    url: https://github.com/material-motion/reactive-motion-swift/blob/develop/src/Timeline.swift
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

### Paused reactive property

A timeline has a reactive property named `paused` of type `Bool`. The default value is false.

```swift
class Timeline {
  public const paused = createProperty(withInitialValue: false)
}
```

### timeOffset reactive property

A timeline has a reactive property named `timeOffset` of type `Float`. The default value is 0.

```swift
class Timeline {
  public const timeOffset = createProperty(withInitialValue: CGFloat(0))
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

If Timeline is **not** associated with an interaction, then the interaction should start immediately
upon registration with the runtime.

If a Timeline **is** associated with an interaction, then the interaction should subscribe to the
`paused` and `timeOffset` properties and react to changes.

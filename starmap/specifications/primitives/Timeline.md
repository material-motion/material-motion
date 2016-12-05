---
layout: page
title: Timeline
status:
  date: November 11, 2016
  is: Stable
knowledgelevel: L2
library: runtime
proposals:
  - proposal:
    initiation_date: Nov 11, 2016
    completion_date: Nov 17, 2016
    state: Accepted
    discussion: "Timeline spec review"
    discussion_url: https://groups.google.com/forum/#!topic/material-motion/hLMbEEzUV4Y
availability:
  - platform:
    name: Android
    label: Milestone
    url: https://github.com/material-motion/runtime-android/milestone/13
  - platform:
    name: iOS
    label: runtime-objc v6
    url: https://github.com/material-motion/runtime-objc/releases/tag/v6.0.0
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

### begin API

Expose an API for beginning the timeline.

```swift
class Timeline {
  func begin()
```

### beginTime API

Expose a read-only nullable API for the timeline's beginTime.

beginTime is non-null after `begin` has been invoked.

```swift
class Timeline {
  var beginTime: TimeInterval? { get }
```

### Scrubber API

Expose an API for setting an optional TimelineScrubber instance.

```swift
class Timeline {
  var scrubber: TimelineScrubber?
```

### Add/remove observer API

Expose APIs for adding and removing observers.

```swift
class Timeline {
  func addObserver(TimelineObserver)
  func removeObserver(TimelineObserver)
```

### Observer event API

Expose a protocol that observers are expected to conform to.

```swift
protocol TimelineObserver {
  func timelineDidAttachScrubber(timeline, scrubber)
  func timelineDidDetachScrubber(timeline)
  func timelineScrubberDidScrub(timeline, timeOffset)
}
```

`timelineDidAttachScrubber` should be invoked when scrubber is assigned a non-null value when it
was previously null.

`timelineDidDetachScrubber` should be invoked when scrubber is assigned a null value when it
was previously non-null.

`timelineScrubberDidScrub` should be invoked when the attached scrubber's position changes.

### TimelineScrubber type

A timeline scrubber is an object.

```swift
class TimelineScrubber {
}
```

### TimelineScrubber timeOffset API

Expose an API on TimelineScrubber for setting a time offset.

```swift
class TimelineScrubber {
  var timeOffset
}
```

### TimelineScrubber/Timeline association

When a timeline scrubber is attached to a timeline, modifications to the scrubber's timeOffset
should result in timeline observer `timelineScrubberDidScrub` invocations.

This effect can be achieved by storing a weak association to the timeline within the timeline
scrubber.

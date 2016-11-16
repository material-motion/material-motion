---
layout: page
title: GestureRecognizer
status:
  date: November 11, 2016
  is: In review
proposals:
  - proposal:
    initiation_date: Nov 11, 2016
    state: Proposed
    discussion: "Timeline spec review"
    discussion_url: https://groups.google.com/forum/#!topic/material-motion/hLMbEEzUV4Y
availability:
  - platform:
    name: Android
    label: tween-android v1.1
    url: https://github.com/material-motion/family-tween-android/releases/tag/1.1.0
  - platform:
    name: iOS
    label: coreanimation-swift v2
    url: https://github.com/material-motion/coreanimation-swift/releases/tag/v2.0.0
---

# Timeline specification

This is the engineering specification for the `Timeline` object.

## Overview

A timeline provides an API for scrubbing time.

## MVP

### Object type

A timeline is an object.

```
class Timeline {
}
```

### begin API

Expose an API for beginning the timeline.

```
class Timeline {
  func begin()
```

### beginTime API

Expose a read-only nullable API for the timeline's beginTime.

beginTime is non-null after `begin` has been invoked.

```
class Timeline {
  var beginTime: TimeInterval? { get }
```

### Scrubber API

Expose an API for setting an optional TimelineScrubber instance.

```
class Timeline {
  var scrubber: TimelineScrubber?
```

### Add/remove observer API

Expose APIs for adding and removing observers.

```
class Timeline {
  func addObserver(TimelineObserver)
  func removeObserver(TimelineObserver)
```

### Observer event API

Expose a protocol that observers are expected to conform to.

```
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

```
class TimelineScrubber {
}
```

### TimelineScrubber timeOffset API

Expose an API on TimelineScrubber for setting a time offset.

```
class TimelineScrubber {
  var timeOffset
}
```

### TimelineScrubber/Timeline association

When a timeline scrubber is attached to a timeline, modifications to the scrubber's timeOffset
should result in timeline observer `timelineScrubberDidScrub` invocations.

This effect can be achieved by storing a weak association to the timeline within the timeline
scrubber.

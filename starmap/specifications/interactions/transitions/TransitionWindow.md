---
layout: page
title: TransitionWindow
status:
  date: Oct 25, 2016
  is: Drafting
---

# TransitionWindow specification

This is the engineering specification for the **TransitionWindow** type.

## Overview

A transition window represents a reversible interval of time in a bi-directional transition.

A **segment** of a transition window represents a specific region in the window.
[TransitionWindowSegment](TransitionWindowSegment) is a representation of such a segment. When used
in a transition, segments placed on a transition window can be mapped to absolute time by
considering the transition's direction.

Consider the following diagram in which there are two segments:

```swift
const var redSegment = TransitionWindowSegment(position: 0, length: 0.5)
const var greenSegment = TransitionWindowSegment(position: 0, length: 1)
```

![]({{ site.url }}/assets/TransitionWindow.svg)

During a forward transition our segments are mapped to absolute time like so:

```swift
const var delay = segment.position * window.duration
const var duration = segment.length * window.duration
```

During a backward transition, our segments are mapped to absolute time like so:

```swift
const var delay = (1 - (segment.position + segment.length)) * window.duration
const var duration = segment.length * window.duration
```

In other words, a segment that occurs during the **first half** of a forward transition will occur
during the **last half** of a backward transition.

## MVP

### Object type

A transition window is an object.

```swift
class TransitionWindow {
}
```

### Initialization API

A transition window must be created with a duration.

```swift
class TransitionWindow {
  init(duration)
```

### Duration API

Expose a read-only API for the window's duration.

```swift
class TransitionWindow {
  const var duration: TimeInterval
```

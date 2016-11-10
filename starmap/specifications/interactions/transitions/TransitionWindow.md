---
layout: page
title: TransitionWindow
status:
  date: Oct 25, 2016
  is: Drafting
availability:
  - platform:
    name: iOS
    label: "transitions-objc as of v1.0.0"
    url: https://github.com/material-motion/material-motion-transitions-objc
---

# TransitionWindow specification

This is the engineering specification for the **TransitionWindow** type.

## Overview

A TransitionWindow represents a reversible interval of time. A segment of a transition window
represents a specific region in the window. When used in a transition, segments placed on a
transition window can be mapped to absolute time by considering the transition's direction.

In the following diagram there are two segments:

```
let redSegment = TransitionWindowSegment(position: 0, length: 0.5)
let greenSegment = TransitionWindowSegment(position: 0, length: 1)
```

![]({{ site.url }}/assets/TransitionWindow.svg)

During a forward transition our segments are mapped to absolute time like so:

```
let delay = segment.position * window.duration
let duration = segment.length * window.duration
```

During a backward transition, our segments are mapped to absolute time like so:

```
let delay = (1 - (segment.position + segment.length)) * window.duration
let duration = segment.length * window.duration
```

In other words, a segment that occurs during the **first half** of a forward transition will occur
during the **last half** of a backward transition.

## MVP

### Object type

A transition window is an object.

```
class TransitionWindow {
}
```

### Initialization API

A transition window must be created with a duration.

```
class TransitionWindow {
  init(duration)
```

### Duration API

Expose a read-only API for the window's duration.

```
class TransitionWindow {
  let duration: TimeInterval
```

---
layout: page
title: TransitionWindowSegment
status:
  date: Oct 25, 2016
  is: Drafting
---

# TransitionWindowSegment specification

This is the engineering specification for the **TransitionWindowSegment** type.

## Overview

A TransitionWindowSegment represents a specific region in a [TransitionWindow](TransitionWindow).

## MVP

### Struct type

TransitionWindowSegment is a struct type, if the language allows.

```swift
struct TransitionWindowSegment {
}
```

### position and length APIs

Provide two read-writable values for `position` and `length`.

Position and length must be expressed in normalized units from `0...1` inclusively. The sum of these two values must never exceed `1`.

```swift
struct TransitionWindowSegment {
  var position
  var length
}
```

Assertions:

- `0 <= position <= 1`
- `0 <= length <= 1`
- `0 <= position + length <= 1`

### Inverted API

Provide an API for inverting a segment.

```swift
TransitionWindowSegment {
  /** Returns a new segment with an inverted position. */
  func inverted() -> TransitionWindowSegment {
    return TransitionWindowSegment(position: 1 - (position + length), length: length)
  }
```

### Epsilon

Include an epsilon constant.

```swift
/** Epsilon for use when comparing TransitionWindowSegment values. */
let TransitionWindowSegmentEpsilon = 0.00001
```

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

A TransitionWindowSegment represents a specific part of a transition window.

## Example: TweenBetween

```
let tween = TweenBetween("opacity",
                         window: window,
                         segment: .entireSegment,
                         back: 0,
                         fore: 1)
```

## MVP

### Struct type

TransitionWindowSegment is a struct type, if the language allows.

### position and length APIs

Provide two writable values for `position` and `length`.

Position and length must be expressed in normalized units from `0...1` inclusively. The sum of these two values must never exceed `1`.

```
TransitionWindowSegment {
  var position
  var length
}
```

Assertions:

- `0 <= position <= 1`
- `0 <= length <= 1`
- `0 <= position + length <= 1`

`0` refers to `back` while `1` refers to `fore`.

```
back   fore
|---------|
0         1
```

### Inversion API

Provide an API for inverting a segment.

```
TransitionWindowSegment {
  func inverted() -> TransitionWindowSegment {
    return TransitionWindowSegment(position: 1 - position, length: length)
  }
```

### Epsilon

Include an epsilon constant.

```
let TransitionWindowSegmentEpsilon = 0.00001
```

---
layout: page
title: TimeWindowSegment
status:
  date: Oct 25, 2016
  is: Drafting
---

# TimeWindowSegment specification

This is the engineering specification for the **TimeWindowSegment** type.

## Overview

A TimeWindowSegment represents a specific part of a time window.

## Example: TweenBetween

```
let tween = TweenBetween("opacity",
                         window: window,
                         segment: .entireSegment,
                         back: 0,
                         fore: 1)
```

## MVP Specification

**Struct type**: TimeWindowSegment is a struct type, if the language allows.

**position and length APIs**: Provide two writable values for `position` and `length`.

Position and length must be expressed in normalized units from `0...1` inclusively. The sum of these two values must never exceed `1`.

```
TimeWindowSegment {
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

**Epsilon**: Include an epsilon constant.

```
let TimeWindowSegmentEpsilon = 0.00001
```

### Feature: Pre-defined segments

Provide the following set of pre-defined segments.

| name | from | to |
|:---- |:---- |:-- |
| entire | 0 | 1 |
| firstHalf | 0 | 0.5 |
| middleHalf | 0.25 | 0.75 |
| latterHalf | 0.5 | 1 |
| firstQuarter | 0 | 0.25 |
| secondQuarter | 0.25 | 0.5 |
| thirdQuarter | 0.5 | 0.75 |
| fourthQuarter | 0.75 | 1 |
| firstThreeQuarters | 0 | 0.75 |
| lastThreeQuarters | 0.25 | 1 |


# Feature: transition window

| Proposals | Status |
|:------------------|:-------|
| Current status | Draft |

This is the engineering specification for the **TransitionWindow** type.

## Overview

This feature enables the description of a transition between two fixed states.

```
A         B         C
|---------|---------|
           \_______/
               ^- transition window
```

A transition window has two fixed sides: **back** and **fore**. In the example above, B is *back* and C is *fore*.

A transition window has an initial and current direction that can be either **forward** or **backward**. The initial direction cannot be changed after initialization. The current direction can be changed at will.

A transition window has a numerical **position** expressed in the range `[0,1]`. `0` refers to the back side of the transition, while `1` refers to the front side.

## MVP Specification

**Direction type**: Timelines can move in one of two directions: forward or backward.

Define a direction type that includes both possible directions.

```
TimelineDirection {
  .forward:
  .backward:
}
```

**Object type**: A timeline is an object.

```
class Timeline {
}
```

**Initial direction API**: A timeline is aware of its initial direction.

```
class Timeline {
  TimelineDirection initialDirection
}
```

**Duration API**: A timeline is aware of its duration in time.

The unit of time is platform-dependent.

```
class Timeline {
  TimeInterval duration
}
```

**Initialization API**: A timeline must be created with an initial direction and duration.

```
class Timeline {
  init(initialDirection, duration)
}
```

**Current direction API**: A timeline is aware of its current direction.

This should be initialized with the value of `initialDirection`.

```
class Timeline {
  TimelineDirection currentDirection
}
```

**Segment type**: A Timeline Segment represents a specific part of a timeline.

Position and length must be expressed in normalized units from `0...1` inclusively. The sum of these two values must never exceed `1`.

```
Segment {
  var position
  var length
}
```

Assertions:

- `0 <= position <= 1`
- `0 <= length <= 1`
- `0 <= position + length <= 1`

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

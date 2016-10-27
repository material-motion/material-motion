# Feature: time window

| Proposals | Status |
|:------------------|:-------|
| Current status | Draft |

This is the engineering specification for the **TimeWindow** type.

## Overview

A TimeWindow represents a distinct interval of time. Time windows are most often used to represent the time between two states in a transition.

```
A         B         C
|---------|---------|
           \__|____/
               ^- time window
```

A time window has two fixed sides: **back** and **fore**. In the example above, B is *back* and C is *fore*.

A time window has an initial and current direction that can be either **forward** or **backward**. The initial direction cannot be changed after initialization. The current direction can be changed at will.

A time window has an expected **duration**, expressed in units of time.

A time window has a numerical **position** expressed in the range `[0,1]`. `0` refers to the back side of the time, while `1` refers to the front side.

## MVP Specification

**Position API**: A time window has a current position.

This numerical value should be bounded to `[0,1]`.

When initialized with an initial direction of **forward**, position should initially be `0`.

When initialized with an initial direction of **backward**, position should initially be `1`.

```
class TimeWindow {
  Double position
}
```

**Direction type**: The position in a time window can move in one of two directions: forward or backward.

Define a direction type that includes both possible directions.

```
TimeWindowDirection {
  .forward:
  .backward:
}
```

**Object type**: A time window is an object.

```
class TimeWindow {
}
```

**Initialization API**: A time window must be created with an initial direction and duration.

```
class TimeWindow {
  init(initialDirection, duration)
}
```

**Initial direction API**: A time window is aware of its initial direction.

```
class TimeWindow {
  TimeWindowDirection initialDirection
}
```

**Duration API**: A time window is aware of its expected duration.

The unit of time is platform-dependent.

```
class TimeWindow {
  TimeInterval duration
}
```

**Current direction API**: A time window is aware of its current direction.

This should be initialized with the value of `initialDirection`.

```
class TimeWindow {
  TimelineDirection currentDirection
}
```

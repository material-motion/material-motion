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

A transition window has an expected **duration**, expressed in units of time.

A transition window has a numerical **position** expressed in the range `[0,1]`. `0` refers to the back side of the transition, while `1` refers to the front side.

## MVP Specification

**Direction type**: The position in a transition window can move in one of two directions: forward or backward.

Define a direction type that includes both possible directions.

```
TransitionWindowDirection {
  .forward:
  .backward:
}
```

**Object type**: A transition window is an object.

```
class TransitionWindow {
}
```

**Initialization API**: A transition window must be created with an initial direction and duration.

```
class TransitionWindow {
  init(initialDirection, duration)
}
```

**Initial direction API**: A transition window is aware of its initial direction.

```
class TransitionWindow {
  TransitionWindowDirection initialDirection
}
```

**Duration API**: A transition window is aware of its expected duration.

The unit of time is platform-dependent.

```
class TransitionWindow {
  TimeInterval duration
}
```

**Current direction API**: A transition window is aware of its current direction.

This should be initialized with the value of `initialDirection`.

```
class TransitionWindow {
  TimelineDirection currentDirection
}
```

**Position API**: A transition window has a current position.

This numerical value should be bounded to `[0,1]`.

When initialized with an initial direction of **forward**, position should initially be `0`.

When initialized with an initial direction of **backward**, position should initially be `1`.

```
class TransitionWindow {
  Double position
}
```

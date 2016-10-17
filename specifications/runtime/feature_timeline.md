# Feature: timeline

This is the engineering specification for the **Timeline** type.

|  | Android | Apple | Web |
| --- | --- | --- | --- |
| MVP milestones | &nbsp; | &nbsp; | &nbsp; |

## Overview

This feature enables the description of motion along a *normalized* segment of time.

## Specification

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

**Duration API**: A timeline is aware of its duration in time units.

```
class Timeline {
  Time duration
}
```

**Initial direction API**: A timeline is aware of its initial direction.

```
class Timeline {
  TimelineDirection initialDirection
}
```

**Initialization API**: A timeline must be created with an initial direction and duration.

```
class Timeline {
  init(duration, initialDirection)
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

Define a direction type that includes both possible directions.

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

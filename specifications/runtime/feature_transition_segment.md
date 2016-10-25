# Feature: transition segment

| Proposals | Status |
|:------------------|:-------|
| Current status | Draft |

This is the engineering specification for the **TransitionSegment** type.

## Overview

This feature enables the description of motion between two distinct states.

## Example: TransitionTween

```
let tween = TransitionTween("opacity",
                            during: .entireSegment,
                            backValue: 0,
                            foreValue: 1)
```

## MVP Specification

**Struct type**: A transition segment represents a specific part of a transition.

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

`0` refers to `back` while `1` refers to `fore`.

```
back   fore
|---------|
0         1
```

**Epsilon**: Include an epsilon constant.

```
let TransitionSegmentEpsilon = 0.00001
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


---
layout: page
permalink: /starmap/specifications/interchange/
---

# Motion interchange specification

The motion interchange defines a concise format for representing motion information. The goals of
the interchange are to be **compact** and **contextually-flexible**.

## Motion acceleration profile

A description of a motion acceleration profile includes the following traits:

- Type: instant, bezier, or spring.
- Four values of type-relevant data.

```swift
struct MotionAccelerationProfileType {
  case instant
  case bezier
  case spring
}

struct MotionAccelerationProfile {
  let type: MotionAccelerationProfileType
  let data: (Float, Float, Float, Float)
}
```

### Data meaning

**Instant**: the data values are ignored.

**Bezier**: The cubic bezier formula consists of four two-dimensional points `pt0`, `pt1`, `pt2`,
and `pt3`. The data values correspond to `(pt1.x, pt1.y, pt2.x, pt2.y)`.

**Spring**: A spring simulation consists of three variables: `mass`, `tension`, and `friction`. The
data values correspond to `(mass, tension, friction, <ignored>)`.

## Motion repetition

A description of motion's repetition includes the following traits:

- Type: none, count, or duration.
- An amount.
- Whether or not the animation reverses itself upon reaching the end.

```swift
struct MotionRepetitionType {
  case none
  case count
  case duration
}

struct MotionRepetition {
  let type: MotionRepetitionType
  let amount: Float
  let autoreverses: Bool
}
```

## Motion timing

An animation's timing defines its delay, duration, acceleration profile, and repetition. This is a
composite structure of the above types.

```swift
struct MotionTiming {
  let delay: Float
  let duration: Float
  let accelerationProfile: MotionAccelerationProfile
  let repetition: MotionRepetition
}
```

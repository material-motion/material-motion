# Transition

| Discussion thread | Status |
|:------------------|:-------|
| ![](../../../_assets/under-construction-flashing-barracade-animation.gif) | Drafting as of Oct 25, 2016 |

This is the engineering specification for the `Transition` concrete type.

## Overview

A `Transition` defines the essential information required by a `TransitionDirector`.

## Features

* [Interruptible](feature_interruptible.md)

## MVP

**Concrete type**: `Transition` is an object.

Example pseudo-code:

```
class Transition {
}
```

**Scheduler API**: Store a private Scheduler instance.

```
class Transition {
  private let scheduler: Scheduler
```

The scheduler's plan APIs should be exposed through the Transition object.

**Initial direction API**: Provide a read-only value of the transition's initial direction.

```
class Transition {
  let initialDirection: TransitionWindowDirection
```

**Duration API**: Provide a read-only value of the transition's duration.

```
class Transition {
  let duration: TimeInterval
```

**back/fore API**: Provide a read-only `back` and `fore` value.

The type of this value is platform-dependent.

On iOS:

```
class Transition {
  let back: UIViewController
  let fore: UIViewController
```

These values map from the platform's from/to values:

| Direction | `back ==` | `fore ==` |
|:----------|:-----|:---|
| Forward | from | to |
| Backward | to | from |

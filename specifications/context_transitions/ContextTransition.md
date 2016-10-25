# ContextTransition

| Discussion thread | Status |
|:------------------|:-------|
| ![](../../_assets/under-construction-flashing-barracade-animation.gif) | Drafting as of Oct 25, 2016 |

This is the engineering specification for the `ContextTransition` concrete type.

## Overview

A `ContextTransition` defines the essential information required by a `ContextTransitionDirector`.

## Features

* [Interruptible](feature_interruptible.md)

## MVP

**Concrete type**: `ContextTransition` is an object.

Example pseudo-code:

```
class ContextTransition {
}
```

**Initial direction API**: Provide a read-only value of the transition's initial direction.

```
class TransitionContext {
  let initialDirection: TransitionWindowDirection
```

**Duration API**: Provide a read-only value of the transition's duration.

```
class TransitionContext {
  let duration: TimeInterval
```

**back/fore API**: Provide a read-only `back` and `fore` value.

The type of this value is platform-dependent.

On iOS:

```
class TransitionContext {
  let back: UIViewController
  let fore: UIViewController
```

These values map from the platform's from/to values:

| Direction | `back ==` | `fore ==` |
|:----------|:-----|:---|
| Forward | from | to |
| Backward | to | from |

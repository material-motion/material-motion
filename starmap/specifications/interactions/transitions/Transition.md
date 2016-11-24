---
layout: page
title: Transition
status:
  date: Oct 25, 2016
  is: Drafting
---

# Transition specification

This is the engineering specification for the `Transition` concrete type.

## Overview

A `Transition` defines the essential information required by a `TransitionDirector`.

## MVP

### Concrete type

`Transition` is an object.

Example pseudo-code:

```
class Transition {
}
```

### MotionRuntime API

Expose a read-only MotionRuntime instance.

```
class Transition {
  let runtime: MotionRuntime
```

### Transition window API

Expose a read-only value of the transition's window.

```
class Transition {
  let window: TransitionWindow
```

### Timeline API

Expose a read-only value of the transition's timeline.

```
class Transition {
  let timeline: Timeline
```

### Direction API

Expose a read-only value of the transition's direction.

```
class Transition {
  let direction: TransitionDirection
```

### back/fore API

Expose a read-only `back` and `fore` value.

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

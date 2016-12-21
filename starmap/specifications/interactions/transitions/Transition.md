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

```swift
class Transition {
}
```

### MotionRuntime API

Expose a read-only MotionRuntime instance.

```swift
class Transition {
  const var runtime: MotionRuntime
```

### Transition window API

Expose a read-only value of the transition's window.

```swift
class Transition {
  const var window: TransitionWindow
```

### Timeline API

Expose a read-only value of the transition's timeline.

```swift
class Transition {
  const var timeline: Timeline
```

### Direction API

Expose a read-only value of the transition's direction.

```swift
class Transition {
  const var direction: TransitionDirection
```

### back/fore API

Expose a read-only `back` and `fore` value.

The type of this value is platform-dependent.

On iOS:

```swift
class Transition {
  const var back: UIViewController
  const var fore: UIViewController
```

These values map from the platform's from/to values:

| Direction | `back ==` | `fore ==` |
|:----------|:-----|:---|
| Forward | from | to |
| Backward | to | from |

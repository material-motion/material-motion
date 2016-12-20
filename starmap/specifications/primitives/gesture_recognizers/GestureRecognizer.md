---
layout: page
title: GestureRecognizer
status:
  date: December 4, 2016
  is: Stable
knowledgelevel: L2
library: gestures
availability:
  - platform:
    name: Android
    url: https://github.com/material-motion/gestures-android/blob/develop/library/src/main/java/com/google/android/material/motion/gestures/GestureRecognizer.java
  - platform:
    name: iOS
    url: https://developer.apple.com/reference/uikit/uigesturerecognizer
---

# GestureRecognizer specification

This is the engineering specification for the `GestureRecognizer` abstract type.

## Overview

A gesture recognizer listens to input events and translates them into meaningful interaction events.

## MVP

### Abstract type

`GestureRecognizer` is a protocol, if your language has that concept.

Pseudo-code example:

```swift
protocol GestureRecognizer {
}
```

### Element API

A gesture recognizer should expose an API for reading the element to which the recognizer is
associated.

```swift
protocol GestureRecognizer {
  let element
```

### Element association

How a gesture recognizer is associated with an element is a platform implementation detail.

### Event API

A gesture recognizer should expose an API for adding objects that will receive state change events.

These observers should be invoked each time the gesture recognizer's state value is written to.

```swift
protocol GestureRecognizer {
  func addStateChangeObserver(observer)
```

### Enabled API

A gesture recognizer should expose an API for changing its enabled state.

A disabled gesture recognizer will not emit any state change events.

```swift
protocol GestureRecognizer {
  var enabled: Bool
```

### States

A gesture recognizer can be in any one of the following states:

```swift
enum GestureRecognizerState {
  case Possible
  case Began
  case Changed
  case Ended
  case Cancelled
  case Failed

  case Recognized = Ended
}
```

### State API

A gesture recognizer has a read-only `state` API.

```swift
protocol GestureRecognizer {
  let state: GestureRecognizerState
```

### Location API

A gesture recognizer should expose an API for reading the centroid touch location in a given
element's coordinate system.

The method is responsible for converting the touch location to the relevant coordinate system.

```swift
protocol GestureRecognizer {
  func locationInElement(element: Element) -> Point
```

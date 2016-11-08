---
layout: page
title: GestureRecognizer
status:
  date: November 7, 2016
  is: Draft
availability:
  - platform:
    name: iOS
    label: "iOS SDK 3.2+"
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

```
protocol GestureRecognizer {
}
```

### Element API

A gesture recognizer should expose an API for reading the element to which the recognizer is
associated.

```
protocol GestureRecognizer {
  let element
```

### Element association

How a gesture recognizer is associated with an element is a platform implementation detail.

### Event API

A gesture recognizer should expose an API for adding objects that will receive state change events.

These observers should be notified each time the gesture recognizer's state changes.

```
protocol GestureRecognizer {
  func addStateChangeObserver(observer)
```

### Enabled API

A gesture recognizer should expose an API for changing its enabled state.

A disabled gesture recognizer will not emit any state change events.

```
protocol GestureRecognizer {
  var enabled: Bool
```

### State changes

A gesture recognizer is notified of the following state change events:

```
protocol StateChangeObserver {
  func didBegin(centroid: Point)
  func didMove(centroid: Point)
  
  // Always calls didEnd() after.
  func didCancel(centroid: Point)
  // Always calls didEnd() after.
  func didRecognize(centroid: Point)
  
  func didEnd(centroid: Point)
}
```

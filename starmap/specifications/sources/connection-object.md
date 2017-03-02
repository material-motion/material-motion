---
layout: page
title: Object connection type
status:
  date: March 2, 2017
  is: Stable
interfacelevel: L2
implementationlevel: L4
library: support
depends_on:
  - /starmap/specifications/observable/MotionObservable
---

# Object connection specification

This is the engineering specification for an **object** MotionObservable connection implementation.

## MVP

### Return a motion observable

```swift
return MotionObservable { observer in
  // Connect to a source
  return {
    // Disconnect from the source
  }
}
```

### Define a Connection object

Is a private class that represents a single connection.

```swift
private final class SomeConnection {
```

### Connection is initialized with the observer and any state information

Both values must be stored by the connection.

```swift
class SomeConnection {
  init(state: SomeState, observer: MotionObserver<T>)
```

### Add self as an observer

This should be done at the time of construction.

```swift
class SomeConnection {
  init(state: SomeState, observer: MotionObserver<T>) {
    ...
    state.addTarget(self, action: #selector(event))
```

### Propagate events to the observer

Propagate the gesture when the gesture event callback is invoked.

```swift
class SomeConnection {
  private func event(data: Data) {
    propagate(data)
  }
```

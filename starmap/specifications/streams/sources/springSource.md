---
layout: page
title: springSource
status:
  date: December 13, 2016
  is: Draft
knowledgelevel: L2
library: direct-manipulation
depends_on:
  - /starmap/specifications/primitives/gesture_recognizers/GestureRecognizer
  - /starmap/specifications/streams/MotionObservable/
---

# springSource specification

This is the engineering specification for the `springSource` API.

## Overview

`springSource` connects to a Spring and emits values on the next channel until the spring comes to
rest.

Example usage:

```swift
springSource(spring).subscribe(...)
```

## MVP

### Expose Spring API

Should be a class type.

```swift
public final class Spring<T> {
```

This class should be generic with a value `T` For languages that support composite properties such
as position.

```swift
public final class Spring<T> {
```

### Expose destination and initialValue APIs

These properties should be provided at initialization time.

`destination` represents the desired final value of the spring. `initialValue` represents the
starting value of the spring.

```swift
class Spring {
  public let destination: Property
  public let initialValue: Property
```

### Expose a SpringConfiguration API

Expose a class with two properties: tension and friction.

```swift
public final class SpringConfiguration {
  public var tension: Float
  public var friction: Float
}
```

### Expose a configuration API

Expose a configuration API that is initialized with default values.

```swift
class Spring {
  public let configuration = SpringConfiguration(tension: 342, friction: 30)
```

### Expose generic springSource API

`springSource` is a function. It should be accessible from anywhere. Returns a MotionObservable.

```swift
public func springSource(spring: Spring) -> MotionObservable<Float>
```

For languages that support composite properties, the returned MotionObservable should be genericized
with type T.

```swift
public func springSource<T>(spring: Spring<T>) -> MotionObservable<T>
```

### Return a motion observable

```swift
public func springSource(_ spring: Spring<CGFloat>) -> MotionObservable<CGFloat> {
  return MotionObservable { observer in
    // Connect to a spring system
    return {
      // Disconnect from the spring system
    }
  }
}
```

### Read the spring's initialValue

```swift
public func springSource(_ spring: Spring<CGFloat>) -> MotionObservable<CGFloat> {
  return MotionObservable { observer in
    ...
    
    springSystem.fromValue = spring.initialValue
    
```

### Set the spring's destination

```swift
public func springSource(_ spring: Spring<CGFloat>) -> MotionObservable<CGFloat> {
  return MotionObservable { observer in
    ...
    
    springSystem.toValue = spring.destination
    
```

### Update the observer's state

```swift
public func springSource(_ spring: Spring<CGFloat>) -> MotionObservable<CGFloat> {
  return MotionObservable { observer in
    ...

    springSystem.didStart = { _ in
      observer.state(.active)
    }
    springSystem.didComplete = { _ in
      observer.state(.atRest)
    }
```

---
layout: page
title: springSource
status:
  date: December 13, 2016
  is: Draft
knowledgelevel: L2
library: springs
depends_on:
  - /starmap/specifications/streams/MotionObservable/
  - /starmap/specifications/streams/plans/Spring
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

```java
SpringSource.from(spring).subscribe(...)
```

## MVP

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
func springSource(spring: Spring) -> MotionObservable<Float> {
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
func springSource(spring: Spring) -> MotionObservable<Float> {
  return MotionObservable { observer in
    ...
    
    springSystem.fromValue = spring.initialValue
    
```

### Set the spring's destination

```swift
func springSource(spring: Spring) -> MotionObservable<Float> {
  return MotionObservable { observer in
    ...
    
    springSystem.toValue = spring.destination
    
```

### Update the observer's state

```swift
func springSource(spring: Spring) -> MotionObservable<Float> {
  return MotionObservable { observer in
    ...

    springSystem.didStart = { _ in
      observer.state(.active)
    }
    springSystem.didComplete = { _ in
      observer.state(.atRest)
    }
```

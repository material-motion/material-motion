---
layout: page
title: ReactiveProperty
status:
  date: February 19, 2017
  is: Stable
interfacelevel: L2
implementationlevel: L4
library: material-motion
depends_on:
  - /starmap/specifications/observable/MotionObservable
availability:
  - platform:
    name: Android
    url: https://github.com/material-motion/reactive-motion-android/blob/develop/library/src/main/java/com/google/android/reactive/motion/ReactiveProperty.java
    tests_url: https://github.com/material-motion/reactive-motion-android/blob/develop/library/src/test/java/com/google/android/reactive/motion/PropertyReactivePropertyTests.java
  - platform:
    name: JavaScript
    url: https://github.com/material-motion/material-motion-js/blob/develop/packages/streams/src/properties/ReactiveProperty.ts
    tests_url: https://github.com/material-motion/material-motion-js/blob/develop/packages/streams/src/properties/__tests__/reactiveProperty.test.ts
  - platform:
    name: iOS (Swift)
    url: https://github.com/material-motion/streams-swift/blob/develop/src/ReactiveProperty.swift
    tests_url: https://github.com/material-motion/material-motion-swift/blob/develop/tests/unit/ReactivePropertyTests.swift
---

# ReactiveProperty specification

This is the engineering specification for the `ReactiveProperty` concrete type.

## Overview

`ReactiveProperty` defines an interface for an observable value.

*Writing to a property*

```swift
spring.destination.value = 100
```

*Observing changes to a spring's destination reactive property*

```swift
const var subscription = spring.destination.subscribe { destination in
  animation.toValue = destination
}
```

## MVP

### Expose a concrete ReactiveProperty API

```swift
public class ReactiveProperty<T> {
}
```

### Expose an initializer for anonymous properties

The initializer should accept an initial value. Such properties are called *anonymous properties*.

```swift
class ReactiveProperty<T> {
  public init(initialValue: T)
}
```

### Expose an initializer for external properties

The initializer should accept an initial value and an externalWrite.

```swift
class ReactiveProperty<T> {
  public init(initialValue: T, externalWrite: (T) -> Void)
}
```

### Expose a value API

Any writes to this value should be immediately propagated to all subscribed observers.

```swift
class ReactiveProperty<T> {
  public var value: T
}
```

### Expose a subscribe API

Expose a MotionObserver-shaped subscribe API that accepts a next function.

```swift
class ReactiveProperty {
  public func subscribe(next: (T) -> Void) -> Subscription
```

### Store a list of MotionObserver instances

```swift
class ReactiveProperty {
  private var observers: [MotionObserver<T>] = []
```

### Subscribe adds an observer to a list of observers

```swift
class ReactiveProperty {
  func subscribe(next: (T) -> Void) -> Subscription {
    const var observer = MotionObserver(next: next)
    observers.append(observer)
```

### Subscribe invokes the observer's next function with the current value

```swift
class ReactiveProperty {
  func subscribe(next: (T) -> Void) -> Subscription {
    ...

    observer.next(value)
```

### Changes to value should propagate to all observers

Invokes the provided write function and informs all subscribed observers of the new value.

```swift
class ReactiveProperty {
  public var value: T {
    didSet {
      _externalWrite?(newValue)

      for observer in observers {
        observer.next(newValue)
      }
    }
  }
```

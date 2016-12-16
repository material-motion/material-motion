---
layout: page
title: Property observation
status:
  date: December 13, 2016
  is: Draft
knowledgelevel: L3
library: streams
depends_on:
  - /starmap/specifications/streams/connections/Property
---

# Property observation feature specification

This is the engineering specification for observing `Property` changes.

## Overview

This feature outlines the mechanisms by which an entity can subscribe to changes made to a property.

This spec assumes that you are using **scoped** properties.

## Examples

*Observing changes to a spring's destination property*

```swift
let destinationSubscription = spring.destination.subscribe { destination in
  animation.toValue = destination
  animation.isPaused = false
}
```

## MVP

### Expose an ObservableProperty API

This is a similar shape to an IndefiniteObservable, but without the initialization method.

```swift
protocol ObservableProperty {
  associatedtype T

  func subscribe(_ next: (T) -> Void) -> Subscription
}
```

### Make Property conform to ObservableProperty

```swift
class Property: ObservableProperty {
  public func subscribe(next: (T) -> Void) -> Subscription
```

### Implement a PropertyObserver API

This should be a private class. It does not need to conform to a formal Observer type, but it can if
one is available. It should store a constant next function that accepts a value and returns nothing.

```swift
private final class PropertyObserver<T> {
  let next: (T) -> Void
}
```

### Store the next function as an observer

```swift
class Property {
  public func subscribe(next: (T) -> Void) -> Subscription {
    let observer = PropertyObserver(next)
    observers.append(observer)
```

### Immediately provide the observer with the current property value

```swift
class Property {
  public func subscribe(next: (T) -> Void) -> Subscription {
    ...

    observer.next(read())
```

### Return a Subscription instance

The unsubscribe implementation should remove the observer from the list of observers.

```swift
class Property {
  public func subscribe(next: (T) -> Void) -> Subscription {
    ...

    return Subscription {
      <remove the observer>
    }
  }
```

### Inform observers on write

Invoke all observer next functions when the property is written to.

```swift
class Property {
  func write(_ value: T) {
    _write(value)

    for observer in observers {
      observer.next(value)
    }
  }
```

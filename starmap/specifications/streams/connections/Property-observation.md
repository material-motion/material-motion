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

## Examples

*Observing changes to a spring's destination property*

```swift
let destinationSubscription = spring.destination.subscribe { destination in
  animation.toValue = destination
  animation.isPaused = false
}
```

## MVP

### Implement a ScopedPropertyObserver API

This should be a private class. It does not need to conform to the Observer type. It should store
a constant next function.

```swift
private final class ScopedPropertyObserver<T> {
  let next: (T) -> Void
}
```

### Expose a subscribe API

The API should accept a next function.

```swift
class Property {
  public func subscribe(next: (T) -> Void) -> Subscription
```

### Store the next function as an observer

```swift
class Property {
  public func subscribe(next: (T) -> Void) -> Subscription {
    let observer = ScopedPropertyObserver(next)
    observers.append(observer)
```

### Immediately provide the observer with the current property value

```swift
class Property {
  public func subscribe(next: (T) -> Void) -> Subscription {
    ...

    observer.next(read())

    return Subscription {
      if let index = self.observers.index(where: { $0 === observer }) {
        self.observers.remove(at: index)
      }
    }
  }
```

### Return a Subscription instance

The unsubscribe implementation should remove the observer from the list of observers.

```swift
class Property {
  public func subscribe(next: (T) -> Void) -> Subscription {
    ...

    return Subscription {
      if let index = self.observers.index(where: { $0 === observer }) {
        self.observers.remove(at: index)
      }
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

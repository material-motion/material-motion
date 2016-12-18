---
layout: page
title: ReactiveProperty observation
status:
  date: December 13, 2016
  is: Draft
knowledgelevel: L3
library: streams
depends_on:
  - /starmap/specifications/streams/connections/ReactiveProperty
---

# ReactiveProperty write observation feature specification

This is the engineering specification for observing `ReactiveProperty` writes.

## Overview

This feature outlines the mechanisms by which an entity can observe changes made to a reactive
property.

This spec assumes that you are using **scoped** properties.

## Examples

*Observing changes to a spring's destination reactive property*

```swift
let subscription = spring.destination.addObserver { destination in
  animation.toValue = destination
  animation.isPaused = false
}
```

## MVP

### Expose a subscribe API

```swift
class ReactiveProperty {
  public func subscribe(_ next: (T) -> Void) -> Subscription
```

### Implement a ReactivePropertyObserver API

This should be a private class. It does not need to conform to a formal Observer type, but it can if
one is available. It should store a constant next function that accepts a value and returns nothing.

```swift
private final class ReactivePropertyObserver<T> {
  let next: (T) -> Void
}
```

### Store the next function as an observer

```swift
class ReactiveProperty {
  public func addObserver(next: (T) -> Void) -> Subscription {
    let observer = ReactivePropertyObserver(next)
    observers.append(observer)
```

### Immediately provide the observer with the current reactive property value

```swift
class ReactiveProperty {
  public func addObserver(next: (T) -> Void) -> Subscription {
    ...

    observer.next(read())
```

### Return a Subscription instance

The unsubscribe implementation should remove the observer from the list of observers.

```swift
class ReactiveProperty {
  public func addObserver(next: (T) -> Void) -> Subscription {
    ...

    return Subscription {
      <remove the observer>
    }
  }
```

### Inform observers on write

Invoke all observer next functions when the reactive property is written to.

```swift
class ReactiveProperty {
  func write(_ value: T) {
    _write(value)

    for observer in observers {
      observer.next(value)
    }
  }
```

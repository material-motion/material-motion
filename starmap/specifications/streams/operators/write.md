---
layout: page
title: write
status:
  date: December 6, 2016
  is: Draft
knowledgelevel: L2
library: streams
depends_on:
  - /starmap/specifications/streams/connections/
  - /starmap/specifications/streams/operators/operator
---

# write specification

This is the engineering specification for the `MotionObservable` operator: `write`.

## Overview

`write` writes incoming values to a writeable connection and emits the same incoming values.

Example usage:

```swift
some$.write(to property: propertyOf(view).positionX)

some$.write(to: view, property: View.X)

some$.write({ value in
  view.position.x = value
})
```

## MVP

Your MVP must implement at least one of the following options.

### Option 1: Expose write-to-property API

The property is expected to have a handle to the target instance.

```swift
public func write(to property: Writeable<Target, T>) -> MotionObservable<T> {
  return MotionObservable<T> { observer in
    return self.subscribe(next: { value in
      property.set(value)
      observer.next(value)
    }, state: observer.state ).unsubscribe
  }
}
```

Example usage:

```swift
some$.write(to property: propertyOf(view).positionX)
```

### Option 2: Expose write-to-target-property API

The property is expected to be stateless.

```swift
public func write(to target: Target, property: Writeable<Target, T>) -> MotionObservable<T> {
  return MotionObservable<T> { observer in
    return self.subscribe(next: { value in
      property.set(target, value)
      observer.next(value)
    }, state: observer.state ).unsubscribe
  }
}
```

Example usage:

```swift
some$.write(to: view, property: View.X)
```

### Option 3: Expose write-inline API

```swift
public func write(_ block: (T) -> Void) -> MotionObservable<T> {
  return MotionObservable<T> { observer in
    return self.subscribe(next: { value in
      block(value)
      observer.next(value)
    }, state: observer.state ).unsubscribe
  }
}
```

Example usage:

```swift
some$.write({ value in
  view.position.x = value
})
```
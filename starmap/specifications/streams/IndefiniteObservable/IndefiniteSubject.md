---
layout: page
title: IndefiniteSubject
status:
  date: December 7, 2016
  is: Draft
knowledgelevel: L4
library: indefinite-observable
depends_on:
  - /starmap/specifications/streams/IndefiniteObservable/
---

# IndefiniteSubject specification

This is the engineering specification for the `IndefiniteSubject` object.

## Overview

## Examples

```javascript
class IndefiniteSubject<T> implements Observable<T>, Observer<T> {
  // Keep track of all the observers who have subscribed, so we can notify them
  // when we get new values.
  _observers: Set<Observer<T>> = new Set();
  _lastValue: T;
  _hasStarted: boolean = false;

  next(value: T) {
    this._hasStarted = true;
    this._lastValue = value;

    // The parent stream has dispatched a value, so pass it along to all the
    // children, and cache it for any observers that subscribe before the next
    // dispatch.
    this._observers.forEach(
      (observer: Observer<T>) => observer.next(value)
    );
  }

  subscribe(observerOrNext: ObserverOrNext<T>): Subscription {
    const observer = wrapWithObserver<T>(observerOrNext);

    this._observers.add(observer);

    if (this._hasStarted) {
      observer.next(this._lastValue);
    }

    return {
      unsubscribe: () => {
        this._observers.delete(observer);
      }
    }
  }
}
```

## MVP

### Do a thing

Explanation of the thing.

```swift
Code snippet of the thing.
```
## Unit tests
- [JavaScript](https://github.com/material-motion/indefinite-observable-js/tree/develop/src/__tests__/IndefiniteSubject.test.ts)

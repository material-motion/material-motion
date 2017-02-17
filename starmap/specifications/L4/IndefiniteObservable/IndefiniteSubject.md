---
layout: page
title: IndefiniteSubject
status:
  date: December 7, 2016
  is: Draft
knowledgelevel: L4
library: indefinite-observable
depends_on:
  - /starmap/specifications/L4/IndefiniteObservable/
---

# IndefiniteSubject specification

This is the engineering specification for the `IndefiniteSubject` object.

## Overview

The `IndefiniteSubject` is both an `Observer` and multicast `Observable`.  It receives values via its `next` method and will dispatch those values to any observers who have `subscribe`d.

## Examples

```typescript
class IndefiniteSubject<T> implements Observable<T>, Observer<T> {
  // Keep track of all the observers who have subscribed, so we can notify them
  // when we get new values.
  _observers: Set<Observer<T>> = new Set();
  _lastValue: T;
  _hasStarted: boolean = false;

  next(value: T) {
    // The parent stream has dispatched a value, so pass it along to all the
    // children, and cache it for any observers that subscribe before the next
    // dispatch.
    this._hasStarted = true;
    this._lastValue = value;

    this._observers.forEach(
      (observer) => observer.next(value)
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

### Cache the last-dispatched value for the next observer

The IndefiniteSubject should remember the last-dispatched value, and pass it to any observers who subscribe before the next dispatch.

```typescript
subject.next(42);
subject.subscribe(console.log);
// 42
subject.next(3.14);
// 3.14
```

## Unit tests
- [JavaScript](https://github.com/material-motion/indefinite-observable-js/tree/develop/src/__tests__/IndefiniteSubject.test.ts)

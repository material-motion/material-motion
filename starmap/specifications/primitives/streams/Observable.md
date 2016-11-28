---
layout: page
title: Observable
status:
  date: November 28, 2016
  is: Draft
---

# Observable specification

This is the engineering specification for the `Observable` object.

## Overview

An Observable emits values to its subscribed observers.

## MVP

### Generic object type

`Observable` is a generic type, if your language allows. It consists of a single generic type:
`Value`.

Pseudo-code example:

```swift
class Observable<Value> {
}
```

### subscribe API

Observers can subscribe to an observable using the `subscribe` API.

```swift
class Observable<Value> {
  func subscribe(observer: (Value) -> Void) -> Observable<Value>
```

This method should return self so that it can be chained.

### onNext API

Values are sent to the observers via the `onNext` API.

```swift
class Observable<Value> {
  func onNext(value: Value)
```

The implementation should enumerate over all registered observers and invoke them with the provided
value.

### map API

Transforms the items emitted by an Observable by applying a function to each item.

```swift
class Observable<Value> {
  func map<T>(transform: (Value) -> T) -> Observable<T>
```

Note that the return type has a different associated value, `T`. This allows map to transform both
the values and their type.

A new observable instance should be returned. This instance should have a strong reference to the
parent observable instance.

Example implementation (Swift):

```swift
func map<T>(_ transform: @escaping (Value) -> T) -> Observable<T> {
  let downstream = Observable<T>()

  // Keep a strong reference to the parent (self), but a weak reference to the downstream. This
  // ensures that a reference to a downstream node will keep the entire stream alive.
  subscribe { [weak downstream] in
    let _ = self
    downstream?.onNext(value: transform($0))
  }
  return downstream
}
```

### filter API

Emits only those items from an Observable that pass a test.

```swift
class Observable<Value> {
  func filter(isIncluded: (Value) -> Bool) -> Observable<Value>
```

A new observable instance should be returned. This instance should have a strong reference to the
parent observable instance.

Example implementation (Swift):

```swift
func filter(_ isIncluded: @escaping (Value) -> Bool) -> Observable<Value> {
  let downstream = Observable<Value>()

  // Keep a strong reference to the parent (self), but a weak reference to the downstream. This
  // ensures that a reference to a downstream node will keep the entire stream alive.
  subscribe { [weak downstream] in
    let _ = self
    if isIncluded($0) {
      downstream?.onNext(value: $0)
    }
  }
  return downstream
}
```

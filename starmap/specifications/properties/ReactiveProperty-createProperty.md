---
layout: page
status:
  date: December 19, 2016
  is: Draft
knowledgelevel: L2
library: reactive-motion
depends_on:
  - /starmap/specifications/properties/ReactiveProperty
availability:
  - platform:
    name: Swift
    url: https://github.com/material-motion/streams-swift/blob/develop/src/ReactiveProperty.swift
---

# createProperty feature specification

This is the engineering specification for the `createProperty` API.

## Overview

`createProperty(withInitialValue:)` creates an **anonymous** ReactiveProperty with a given initial
value.

```swift
const var someProperty = createProperty(withInitialValue: 20)
```

## MVP

### Expose a createProperty API

It should be genericized on type T.

```swift
public func createProperty<T>(withInitialValue initialValue: T) -> ReactiveProperty<T>
```

### Create a modifiable local variable

This is only necessary if arguments in your language are constant by default.

```swift
func createProperty<T>(withInitialValue initialValue: T) -> ReactiveProperty<T> {
  var value = initialValue
  ...
}
```

### Return a ReactiveProperty instance backed by the local variable

```swift
func createProperty<T>(withInitialValue initialValue: T) -> ReactiveProperty<T> {
  ...
  return ReactiveProperty(read: { value }, write: { value = $0 })
}
```

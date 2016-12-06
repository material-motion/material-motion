---
layout: page
permalink: /starmap/specifications/streams/connections/
title: Connecting with external systems
status:
  date: December 6, 2016
  is: Draft
knowledgelevel: L3
library: streams
---

# Connecting with external systems

This is the engineering specification for connecting with systems external to Material Motion.

## Overview

Getters and Setters are the workhorse for connecting Material Motion to existing systems. These
objects have a simple shape:

```swift
// Reading a constant
let getter = Getter<Int>(10)
print(getter.get()) // 10
```

```swift
// Reading from and writing to a variable
var someVariable = 10
let getter = Getter<Int>({ return someVariable })
let setter = Setter<Int>({ someVariable = $0 })
print(getter.get()) // 10
var someVariable = 5
print(getter.get()) // 5

setter.set(5)
print(someVariable) // 5
```

Each platform is expected to provide a Getter and Setter implementation. Instances of these objects
will be created to bridge Material Motion with existing ecosystems.

## iOS example

```
func propertyOf(_ view: UIView) -> UIViewPropertyBuilder {
  return UIViewPropertyBuilder(view)
}

class UIViewPropertyBuilder {
  let view: UIView
  init(_ view: UIView) {
    self.view = view
  }

  var alpha: Property<CGFloat> {
    let view = self.view
    return Property(#function, object: view, get: { view.alpha }, set: { view.alpha = $0 })
  }

  var centerX: Property<CGFloat> {
    let view = self.view
    return Property(#function, object: view, get: { view.center.x }, set: { view.center.x = $0 })
  }

  var centerY: Property<CGFloat> {
    let view = self.view
    return Property(#function, object: view, get: { view.center.y }, set: { view.center.y = $0 })
  }

  var center: Property<CGPoint> {
    let view = self.view
    return Property(#function, object: view, get: { view.center }, set: { view.center = $0 })
  }
}
```

---
layout: page
permalink: /starmap/specifications/operators/
library: reactive-motion
---

# Operators

## Vocabulary

### When writing observer documentation

Use **upstream** to refer to the primary stream to which this operator is subscribed.

Use **downstream** to refer to the observers that have subscribed to this operator.

Use **emit** to mean sending data to the downstream.

## Constraint vs transformation operators

Constraint operators are operators that map from a stream of `T` into a stream of `T`.

Transformation operators are operators that map from a stream of `T` into a stream of `U`.

## Implementation shapes

All operators are implemented as methods on `MotionObservable`.

### Essential shape

```swift
class MotionObservable {
  func someOperator() -> MotionObservable<T> {
    return MotionObservable<T> { observer in
      let subscription = self.subscribe { value in
        // Invoke observer.next
      }
      return {
        subscription.unsubscribe()
      }
    }
  }
```

If your language supports it, you may define operators on a protocol extension. This makes it easier
to use other stream-like types as streams.

```swift
extension MotionObservable {
  func noop() -> MotionObservable<T> {
    return MotionObservable<T> { observer in
      let subscription = self.asStream().subscribe { value in
        observer.next(value)
      }
      return {
        subscription.unsubscribe()
      }
    }
  }
```

### Transformation shape

Define a new generic type, `U`, to which the operator will transform its upstream values.

```swift
class MotionObservable {
  func transform<U>(transform: (T) -> U) -> MotionObservable<U> {
    return MotionObservable<U> { observer in
      let subscription = self.subscribe { value in
        observer.next(transform(value))
      }
      return {
        subscription.unsubscribe()
      }
    }
  }
```

### Reactive inputs shape

Hold on to a subscription for each input stream. The following example shows how we might create a
`merge` operator, which emits values received from both the upstream and the provided input.

```swift
class MotionObservable {
  func merge(input: MotionObservable<T>) -> MotionObservable<T> {
    return MotionObservable<U> { observer in
      let subscription = self.subscribe { value in
        observer.next(value)
      }
      let inputSubscription = input.subscribe { value in
        observer.next(value)
      }
      return {
        subscription.unsubscribe()
        inputSubscription.unsubscribe()
      }
    }
  }
```

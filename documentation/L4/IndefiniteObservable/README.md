---
layout: docs
permalink: /documentation/L4/IndefiniteObservable/
status:
  date: December 7, 2016
  is: Draft
title: IndefiniteObservable
---

# How Indefinite Observables work

An Observable is a bridge, connecting an event source to a listener. You've
used lots of different event sources:

```javascript
element.addEventListener('click', listener);
fetch(someURL).then(listener);
self.onmessage = listener;
```

```swift
gesture.addTarget(listener, action: #selector(gestureDidUpdate))
viewController.delegate = listener
```

```java
gesture.addStateChangeListener(listener);
view.setOnClickListener(listener);
```

Each one puts the listener in a different place. An Observable is just a
wrapper that gives them all the same interface:

```javascript
clickStream.subscribe({
  next: listener
});

fetchResponseStream.subscribe({
  next: listener
});

messageStream.subscribe({
  next: listener
});
```

```swift
gesture.subscribe { value in
  listener.gestureDidUpdate(with: value)
}
viewController.subscribe { value in
  listener.didUpdate(with: value)
}
```

As you can see, each observable has a `subscribe` method. When you call
`subscribe`, the Observable connects your listener to the event source, and
returns an object with an `unsubscribe` method. Calling `unsubscribe` will
disconnect the listener from the source.

[Learn how to create an observable](creation).

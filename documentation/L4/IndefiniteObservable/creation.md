---
layout: docs
title: IndefiniteObservable: How do I create an Observable?
status:
  date: December 7, 2016
  is: Draft
depends_on:
  - /documentation/L4/IndefiniteObservable/
---

# Part 1: How do I create an Observable?

The IndefiniteObservable constructor receives a single function, `connect`, and
holds onto it.

When `subscribe` is called, the caller passes an `observer` to the observable.
An observer is just an object with a `next` method. The observable forwards
that `observer` to its `connect` function.

Let's make a function that connects an observer to an event listener:

```javascript
function connectClicksToObserver(observer) {
  element.addEventListener('click', observer.next);
}
```

We can pass this function to the `Observable` constructor to create
`clickStream` from our first example:

```javascript
const clickStream = new IndefiniteObservable(connectClicksToObserver);
```

When you connect a listener to an event source, the event source needs to hold a
reference to the listener. Otherwise, the garbage collector might delete it,
and you'd stop receiving events. Therefore, we need to tell the event source to
disconnect from the listener when it no longer wants to receive events. This
lets the garbage collector clean up the listener, avoiding a memory leak.

Each `connect` function must return a `disconnect` function. When the
subscriber unsubscribes, the observable will call `disconnect`, allowing the
memory to be freed and making sure the `observer` doesn't receive events it
doesn't want.

Let's add a disconnect function to `connectClicksToObserver`:

```javascript
function connectClicksToObserver(observer) {
  element.addEventListener('click', observer.next);

  return function disconnect() {
    element.removeEventListener('click', observer.next);
  }
}
```

Now, when the subscriber unsubscribes, the event listener will be removed:

```javascript
const clickStream = new IndefiniteObservable(connectClicksToObserver);
const clickSubscription = clickStream.subscribe({
  next(event) {
    console.log("I've been clicked!");
  }
});

// Later, when you no longer want to receive events
clickSubscription.unsubscribe();
```

At the beginning, I mentioned that Observables provide a common interface
to the disparate event sources we have in JavaScript. Here are the
Observables for those examples:

```javascript
const fetchResponseStream = new IndefiniteObservable(
  (observer) => {
    // We only want to forward the result if the observer is
    // still subscribed when fetch resolves
    let disconnected = false;

    fetch(someURL).then(
      result => {
        if (!disconnected) 
          observer.next(result);
      }
    );

    return function() {
      disconnected = true;
    }
  }
};

const messageStream = new IndefiniteObservable(
  (observer) => {
    self.onmessage = observer.next;

    return () => self.onmessage = null;
  }
};
```

## Why should I care?

You may be thinking to yourself "Big whoop. It's not that hard to pass a
listener to `addEventListener`. Why should I bother learning and using
Observables?"

Recall that an Observable is a bridge between an event source and a listener.
What if the event source was another listener?  You could write a function
that listened for an event, did something with it, and called its own
listener with the result. This is called an _Operator_.

[Learn how to create operators](operators).

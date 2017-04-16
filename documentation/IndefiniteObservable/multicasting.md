---
layout: docs
title: "Multicasting"
status:
  date: December 7, 2016
  is: Draft
depends_on:
  - /documentation/IndefiniteObservable/operators
---

# Part 3: Multicasting

This walkthrough has introduced you to most of the important concepts to
understand about Observables and how they work:

- Observables connect listeners to event sources, providing a consistent API
  for any kind of asynchronous messaging.

- Observables can be chained together with [operators](./operators), allowing you
  to define which functions data should flow through before it reaches a
  listener.

- Observables are lazy - until you call `subscribe`, they won't do anything.
  This means you can describe a whole pipeline with as many operators as you
  like, but until someone subscribes to the tail, none of them will do any
  work.

There's an important nuance here: Observables just connect listeners to sources
- they don't store values themselves.  This means that if you `subscribe` to the
same source 3 times:

```javascript
const point$ = pointerEvent$.map(
  pointerEvent => ({
    x: pointerEvent.pageX,
    y: pointerEvent.pageY
  })
).tap(
  () => console.log('called')
);

point$.subscribe(someObserver);
point$.subscribe(anotherObserver);
point$.subscribe(yetAnotherObserver);
```

`connect`, `map`, and `tap` will each be called 3 times.  If you're doing
expensive calculations in any of those functions, you'll want to only do that
work once.

So, let's add another operator to our `CustomObservable` that remembers the
last value its source dispatched, and passes that value on to any observers
further down the chain.

```javascript
class CustomObservable extends IndefiniteObservable {
  memoize() {
    // Keep track of all the observers who have subscribed,
    // so we can notify them when we get new values.
    const observers = new Set();
    let subscription;
    let lastValue;
    let hasStarted = false;

    return new CustomObservable(
      observer => {
        // If we already know about this observer, we don't
        // have to do anything else.
        if (observers.has(observer)) {
          console.warn(
            'observer is already subscribed; ignoring', 
            observer
          );
          return;
        }

        // Whenever we have at least one subscription, we
        // should be subscribed to the parent stream (this).
        if (!observers.size) {
          subscription = this.subscribe({
            next(value) {
              // The parent stream has dispatched a value, so
              // pass it along to all the children, and cache
              // it for any observers that subscribe before
              // the next dispatch.
              observers.forEach(
                observer => observer.next(value)
              );

              hasStarted = true;
              lastValue = value;
            }
          });
        }

        observers.add(observer);

        if (hasStarted) {
          observer.next(lastValue);
        }

        return () => {
          observers.delete(observer);

          if (!observers.size) {
            subscription.unsubscribe();
            subscription = null;
          }
        }
      }
    );
  }
}
```

Now, if we do a bunch of expensive work in an operator, we can cache the value
and pass it to as many observers as we like for free:

```javascript
const transformedValue$ = originalValue$.map(
  doSomeExpensiveWork
).tap(
  () => console.log('called')
).memoize();

transformedValue$.subscribe(someObserver);
transformedValue$.subscribe(anotherObserver);
transformedValue$.subscribe(yetAnotherObserver);
```

Now, `map`, `tap`, and any other computation in `originalValue$` will only run
once.

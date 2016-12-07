----		
 -layout: page		
 -title: IndefiniteObservable		
 ----		
 -

# How [Indefinite Observables](https://www.npmjs.org/package/indefinite-observable) work

An Observable is a bridge, connecting an event source to a listener.  You've
used lots of different event sources:

```javascript
element.addEventListener('click', listener);
fetch(someURL).then(listener);
self.onmessage = listener;
```

Each one puts the listener in a different place.  An Observable is just a
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

As you can see, each observable has a `subscribe` method.  When you call
`subscribe`, the Observable connects your listener to the event source, and
returns an object with an `unsubscribe` method.  Calling `unsubscribe` will
disconnect the listener from the source.

## How do I create an Observable? ##

The Observable constructor receives a single function, `connect`, and holds
onto it.

When `subscribe` is called, the caller passes an `observer` to the observable.
An observer is just an object with a `next` method.  The observable forwards
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
reference to the listener.  Otherwise, the garbage collector might delete it,
and you'd stop receiving events.  Therefore, we need to tell the event source to
disconnect from the listener when it no longer wants to receive events.  This
lets the garbage collector clean up the listener, avoiding a memory leak.

Each `connect` function must return a `disconnect` function.  When the
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
to the disparate event sources we have in JavaScript.  Here are the
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

## Why should I care? ##

You may be thinking to yourself "Big whoop.  It's not that hard to pass a
listener to `addEventListener`.  Why should I bother learning and using
Observables?"

Recall that an Observable is a bridge between an event source and a listener.
What if the event source was another listener?  You could write a function
that listened for an event, did something with it, and called its own
listener with the result.  This is called an _Operator_.

# Operators #

Our very first example returned a stream of click events on a particular
element.  But, most of the time, the only part of a pointer event that you
care about is where somebody clicked.  Let's make an operator that takes a
stream of pointer events and returns a stream of points.

> As you've likely noticed, an instance of an Observable is called a stream.
> A stream represents a series of values over time, but we often need to
> refer to those values individually too.  Thus, we have a convention: a
> stream's name ends in `$`, but its individual values do not. In our case,
> the stream is called `pointerEvent$`, but each individual value is just
> `pointerEvent`.  This makes it clear to someone reading our code when we're
> refering to a stream, and when we're referring to a value from that stream.

First, let's write the connect function.  The event source that it's going to
connect the observer to is the pointer event stream.  

_Note:_ To make the code easier to follow, I'm going to pass an anonymous
function into `subscribe`.  The connect function expects an observer, but
`subscribe` knows to wrap a function with one before passing it along.

```javascript
function connectObserverToPointerEvent$(observer) {
  pointerEvent$.subscribe(
    (pointerEvent) => {
      observer.next({
        x: pointerEvent.pageX,
        y: pointerEvent.pageY
      })
    }
  });
}
```

This is pretty similar to the `connect` functions we wrote earlier.  Instead
of calling `addEventListener`, we're calling `pointerEvent$.subscribe`, but
the concept is identical.

Let's wrap that `connect` function in another function that returns our
`point$`:

```javascript
function createPoint$(pointerEvent$) {
  return new IndefiniteObservable(
    (observer) => {
      const subscription = pointerEvent$.subscribe(
        (pointerEvent) => {
          observer.next({
            x: pointerEvent.pageX,
            y: pointerEvent.pageY
          })
        }
      );

      return subscription.unsubscribe;
    }
  );
}

createPoint$(pointerEvent$).subscribe(
  ({ x, y }) => {
    console.log(`The pointer is at (${ x }, ${ y }).`);
  }
);
```

Pretty cool, huh?  We can take any stream of pointer events (click, down,
move, up, etc.) and turn it into a stream of `{ x, y }`.  The observer
doesn't know (or care) that those `x` and `y`s came from a pointer event.  We
can write observers that think of the world in terms of points and let our
little operator worry about morphing pointer events into simple points.

I must admit, though: `createPoint$` is a pretty dense function.  Operators
are what make streams powerful, but that was a lot of code for what was
effectively `(event) => ({ x: event.pageX, y: event.pageY })`.  Let's write
a higher order function that lets us reuse all that boilerplate for other
operators:

```javascript
// source is our input stream; predicate is the function we want
// to apply to all the values on that input stream.
function makeOperator(source, predicate) {
  return new IndefiniteObservable(
    (observer) => {
      const subscription = source.subscribe({
        next(value) {
          observer.next(
            predicate(value)
          );
        }
      });

      return subscription.unsubscribe;
    }
  );
}

const point$ = makeOperator(
  pointerEvent$,
  pointerEvent => ({
    x: pointerEvent.pageX,
    y: pointerEvent.pageY
  })
);
```

Great - now we can write just our transformation function, `predicate` and
let `makeOperator` do all the subscribing work for us.

But if we wanted to add another transformation function, we'd have to call
`makeOperator` again. That's hard to read:

```javascript
const x$ = makeOperator(
  makeOperator(
    pointerEvent$,
    pointerEvent => ({
      x: pointerEvent.pageX,
      y: pointerEvent.pageY
    })
  ),
  point => point.x
)
```

Let's make our own class to store our operators on:

```javascript
class CustomObservable extends IndefiniteObservable {
  // makeOperator applies a function to every item in a
  // sequence and returns the transformed sequence, just
  // like map on an Array.  So, let's call it `map`.
  map(predicate) {
    return new CustomObservable(
      observer => {
        this.subscribe({
          next(value) {
            observer.next(
              predicate(value)
            )
          }
        })
      }
    );
  }

  // If you have a stream of objects and you just care 
  // about one value in each object, use pluck.
  pluck(key) {
    return this.map(dict => dict[key]);
  }

  // tap lets us inspect the pipeline by calling a function
  // on every value without affecting the rest of the
  // pipeline.  It's really useful for logging.
  tap(predicate) {
    return this.map(
      value => {
        predicate(value);
        return value;
      }
    );
  }
}
```

See how much nicer it is to write operators like `pluck` and `tap` now that
we've abstracted all the stream-creation boilerplate into `map`?  They can
focus on just their own logic and not even have to think about streams.

And since we've stored the operators in a class, chaining them together is
easier too:

```javascript
const x$ = pointerEvent$.map(
  pointerEvent => ({
    x: pointerEvent.pageX,
    y: pointerEvent.pageY
  })
).pluck('x');
```

## Multicasting ##

This walkthrough has introduced you to most of the important concepts to
understand about Observables and how they work:

- Observables connect listeners to event sources, providing a consistent API
  for any kind of asynchronous messaging.

- Observables can be chained together with [operators](#operators), allowing you
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

Now, `map`, `tap`, and any other streams in `originalValue$` will only run
once.

# Conclusion #

Hopefully, seeing how Observables work, under-the-hood, has helped you
understand them better.

This file has over 400 lines of documentation, but [the implementation fits
in a tweet](https://twitter.com/material_motion/status/804855074988003328).
To help people learn Observables, and to provide the smallest possible
dependency for library authors to build on top of, we intend to keep it that
way.

Please, use `IndefiniteObservable` to build a library of operators that you
find useful, publish them to [npm](https://www.npmjs.com/), and let us know
what you build.  If any part of this walkthrough could be more helpful, [let
us know](https://github.com/material-motion/indefinite-observable-js/).

With love,

[The Material Motion team](https://material-motion.github.io/material-motion/team/community/governance#core-contributors)

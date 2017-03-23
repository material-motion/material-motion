---
layout: docs
title: "Operators"
status:
  date: December 7, 2016
  is: Draft
depends_on:
  - /documentation/IndefiniteObservable/creation
---

# Part 2: Operators

Our [very first example](index) returned a stream of click events on a particular
element. But, most of the time, the only part of a pointer event that you
care about is where somebody clicked. Let's make an operator that takes a
stream of pointer events and returns a stream of points.

> As you've likely noticed, an instance of an Observable is called a stream.
> A stream represents a series of values over time, but we often need to
> refer to those values individually too. Thus, we have a convention: a
> stream's name ends in `$`, but its individual values do not. In our case,
> the stream is called `pointerEvent$`, but each individual value is just
> `pointerEvent`. This makes it clear to someone reading our code when we're
> refering to a stream, and when we're referring to a value from that stream.

First, let's write the connect function. The event source that it's going to
connect the observer to is the pointer event stream. 

_Note:_ To make the code easier to follow, I'm going to pass an anonymous
function into `subscribe`. The connect function expects an observer, but
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

This is pretty similar to the `connect` functions we wrote earlier. Instead
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
move, up, etc.) and turn it into a stream of `{ x, y }`. The observer
doesn't know (or care) that those `x` and `y`s came from a pointer event. We
can write observers that think of the world in terms of points and let our
little operator worry about morphing pointer events into simple points.

I must admit, though: `createPoint$` is a pretty dense function. Operators
are what make streams powerful, but that was a lot of code for what was
effectively `(event) => ({ x: event.pageX, y: event.pageY })`. Let's write
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
  // like map on an Array. So, let's call it `map`.
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
  // pipeline. It's really useful for logging.
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

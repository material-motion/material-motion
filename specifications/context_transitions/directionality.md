# Directionality

The following contexts exist in a hypothetical application:

```
A    B    C
```

Our application starts at context A. The user then performs the following transitions:

1. A to B.
2. B to C.
3. C to A.

There are two ways to think about how we move between contexts: **from/to** and **back/fore**.

## Traditional from/to transitions

In the traditional from/to model of transitions, the above context changes would have the following variable values:

| Transition # | `from` | `to` |
|-------------:|:------:|:------:|
| 1. | `A` | `B` |
| 2. | `B` | `C` |
| 3. | `C` | `B` |

We're concerned about three distinct transitions and will write three distinct code paths.

If we wanted `B => C` to fade `C` in and `C => B` to fade `C` out, we might try to write one function that looks like so:

```
let animation = Tween("opacity", duration: transition.duration)

if transition.initialDirection == .forward {
  animation.from = 0
  animation.to = 1
  addPlan(animation, to: toViewController.view)
} else {
  animation.from = 1
  animation.to = 0
  addPlan(animation, to: fromViewController.view)
}
```

Note that we have to check `initialDirection` in order to determine which view to add the fade plan to.

In practice, the B/C and C/B transitions are often mirror images of one another. Is there a better way to think about transitions with this in mind?

## back/fore transitions

In a back/fore transition, the above context changes would look like so:

| Transition # | `initialDirection` | `back` | `fore` |
|-------------:|-------------------:|:------:|:------:|
| 1. | forward | `A` | `B` |
| 2. | forward | `B` | `C` |
| 3. | backward | `B` | `C` |

Note that our `back` and `fore` variables now has just two distinct permutations. If we were to write the B/C transitions with these variables our code might look like so:

```
let animation = TweenBetween("opacity",
                             window: transition.window,
                             segment: .entire,
                             back: 0
                             fore: 1)
addPlan(animation, to: transition.foreViewController.view)
```

`transition.foreViewController` is a fixed value, regardless of whether we're transitioning **forward** or **backward**. This eliminates the need to express an entire logical path of code.

Context transitions use the `back`/`fore` model in order to minimize the amount of code required to express bi-directional transitions.

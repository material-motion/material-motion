# Directionality

The following contexts exist in a hypothetical application:

```
A    B    C
```

Our application starts at context A. The user can change to context B, then context C, then back to context B. Each context change can be represented by a **context transition**.

There are two ways to think about how we move between contexts: **from/to** and **back/fore**.

## Traditional from/to transitions

In the traditional from/to model of transitions, the above context changes would have the following variable values:

1. **from** `A` **to** `B`
2. **from** `B` **to** `C`
3. **from** `C` **to** `B`

We're concerned about three distinct transitions and will write three distinct code paths.

If we wanted `B => C` to fade `C` in and `C => B` to fade `C` out, our code might look like so:

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

In practice, the B/C and C/B transitions are often mirror images of one another. What if we could write one transition that captured both directions?

## back/fore transitions

In a back/fore transition, the above context changes would look like so:

- **Direction**: `forward` **back**: `A` **fore**: `B`
- **Direction**: `forward` **back**: `B` **fore**: `C`
- **Direction**: `backward` **back**: `B` **fore**: `C`

Note that our `back` and `fore` variables now has just two distinct permutations. If we were to write the B/C transitions with these variables our code might look like so:



Note that the final transition's arrow is pointed to the left. We always keep contexts on the same named "side" of the transition, regardless of direction.

The left side of the transition is the "back" side.

The right side of the transition is the "fore" side.

A transition can either go **forward** or **backward**.

This is an intentional departure from the conventional terminology of _source_ and _destination_.


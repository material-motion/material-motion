# Directionality

The following contexts exist in a hypothetical application:

```
A    B    C
```

Our application starts at context A. The user can change to context B, then context C, then back to context B. Each context change can be represented by a **context transition**.

There are two ways to think about how we move between contexts: **from/to** and **back/fore**.

## Traditional from/to transitions

In the traditional from/to model of transitions, the above context changes would look like so:

- Transition **from** `A` **to** `B`. Direction is forward.
- Transition **from** `B` **to** `C`. Direction is forward.
- Transition **from** `C` **to** `B`. Direction is backward.

Plotting these context changes on a timeline gives us something like so:

```
A => B => C => B
```

We're concerned about three distinct transitions and will write three distinct code paths.

In practice, the B/C and C/B transitions are often mirror images of one another. What if we could write one transition that captured both directions?

## back/fore transitions

In a back/fore transition, the above context changes would look like so:

- Transition forward. **back**: `A` **fore**: `B`.
- Transition forward. **back**: `B` **fore**: `C`.
- Transition backward. **back**: `B` **fore**: `C`.


Note that the final transition's arrow is pointed to the left. We always keep contexts on the same named "side" of the transition, regardless of direction.

The left side of the transition is the "back" side.

The right side of the transition is the "fore" side.

A transition can either go **forward** or **backward**.

This is an intentional departure from the conventional terminology of _source_ and _destination_.


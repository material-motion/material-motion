# Directionality

The following contexts exist in a hypothetical application:

```
A    B    C
```

Our application starts at context A. The user can change to context B, then context C, then back to context B. Each context change can be represented by a **context transition**.

There are two ways to think about how we move between contexts: **from/to** and **back/fore**.

## Traditional from/to transitions

From/to is the traditional model. The above transitions would look like so:

- Transition **from** `A` **to** `B`. Direction is forward.
- Transition **from** `B` **to** `C`. Direction is forward.
- Transition **from** `C` **to** `B`. Direction is backward.

Plotting these context changes on a timeline gives us something like so:

```
A => B => C => B
```

Meaning we have three distinct transitions to consider.

## back/fore transitions

Note that the final transition's arrow is pointed to the left. We always keep contexts on the same named "side" of the transition, regardless of direction.

The left side of the transition is the "back" side.

The right side of the transition is the "fore" side.

A transition can either go **forward** or **backward**.

This is an intentional departure from the conventional terminology of _source_ and _destination_.


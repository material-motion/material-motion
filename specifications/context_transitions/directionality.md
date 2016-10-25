# Directionality

The following contexts exist in a hypothetical application:

```
A    B    C
```

Our application likely starts at context A. The user can enter context B, then context C, then move back to context B. Each context change can be represented by a transition. Writing out the three transitions:

```
A => B
B => C
B <= C
```

Note that the final transition's arrow is pointed to the left. We always keep contexts on the same named "side" of the transition, regardless of direction.

The left side of the transition is the "back" side.

The right side of the transition is the "fore" side.

A transition can either go **forward** or **backward**.

This is an intentional departure from the conventional terminology of _source_ and _destination_.


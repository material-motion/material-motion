Status of this document:

![](../_assets/under-construction-flashing-barracade-animation.gif)

# Transitions

A transition causes a visual change from one element hierarchy to another.

## Directionality

Consider the following potential screens in an application:

```
A    B    C
```

Our application likely starts at screen A. The user can enter screen B, then screen C, then move back to screen B. Each screen change can be represented by a transition. Writing out the three transitions:

```
A => B
B => C
B <= C
```

Note that the final transition's arrow is pointed to the left. We always keep states on the same "side" of the transition, regardless of whether we're drilling into or out of a state.

The left side of the transition is the "back" side.

The right side of the transition is the "fore" side.

A transition can either go **forward** or **backward**.

This is an intentional departure from the conventional terminology of _source_ and _destination_.


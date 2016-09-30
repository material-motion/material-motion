Status of this document:

![](../_assets/under-construction-flashing-barracade-animation.gif)

# Transitions

A transition causes a visual change from one element hierarchy to another.

## Drill down transitions

We primarily think in terms of "drill down" transitions.

For example, consider we had the following potential states in our application:

```
A    B    C
```

Our application likely starts at state A. The user can enter state B, then state C, then move back to state B. Each change in state can be represented by a transition. Writing out the three transitions:

```
A => B
     B => C
     B <= C
```

Note that the final transition's arrow is pointed to the left. We always keep states on the same "side" of the transition, regardless of whether we're drilling into or out of a state.

This is an intentional departure from the conventional terminology of _source_ and _destination_.


# Context transitions

A context transition causes a visual change from one element hierarchy to another. Context transitions are a specialized subset of general state transitions. Context transitions mean different things on different platforms:

- iOS: UIViewController transitions
- Android: Activity transitions
- Web: URL transitions

The considerations for each platform are diverse and often distinct. To reflect this, the context transitions spec is split into two parts: **common spec** and **platform specs**.

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

Note that the final transition's arrow is pointed to the left. We always keep screens on the same named "side" of the transition, regardless of direction.

The left side of the transition is the "back" side.

The right side of the transition is the "fore" side.

A transition can either go **forward** or **backward**.

This is an intentional departure from the conventional terminology of _source_ and _destination_.


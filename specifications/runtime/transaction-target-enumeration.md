Status of this document:
![](../../_assets/under-construction-flashing-barracade-animation.gif)

# Transaction target enumeration feature specification

Targets referenced in a transaction are enumerable.

**Order**: Targets are enumerated in the order in which they were first referenced.

Example pseudo-code:

```
> transaction.targets
[
  circleView,
  squareView
]
```


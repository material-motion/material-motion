---
layout: page
title: Transaction target enumeration
status:
  date: Oct 25, 2016
  is: Drafting
---

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


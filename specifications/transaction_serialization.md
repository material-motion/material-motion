Status of this document:
![](../_assets/under-construction-flashing-barracade-animation.gif)

# Transaction serialization

A serialized transaction contains plans and associated target selectors in a log.

Example pseudo-data:

```
[
  {
    operation: "add",
    plan: SerializedPlan,
    targetSelector: "#contextView"
  },
  {
    operation: "add",
    name: "someName",
    plan: SerializedPlan,
    targetSelector: "Photo"
  }
]
```

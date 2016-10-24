# RemoveSpring

| Discussion thread | Status |
|:------------------|:-------|
| N/A | Drafting |

## Example: Tossable elements

```
Transition TossableElements {
  func gestureDidStart() {
    addPlan(RemoveSpring(from: .layerPosition), to: target)
  }
}
```

## Contract

Removes any active spring from the given target's property.

```
Plan RemoveSpring {
  var property
}
```

`property` is any animatable value on the target object.

## Performer considerations

This plan goes hand-in-hand with `SpringTo`.


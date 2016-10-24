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

`gestureRecognizer` is the gesture recognizer from which the velocity should be read.

`property` is any animatable value on the target object.

## Performer considerations

This plan goes hand-in-hand with `SpringTo`.


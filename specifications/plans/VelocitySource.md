# VelocitySource

| Discussion thread | Status |
|:------------------|:-------|
| N/A | Drafting |

## Example: Fade in

```
Transition TossableElements {
  func setUp() {
    let gestureRecognizer = PanGestureRecognizer()
    addPlan(Draggable(withGestureRecognizer: gestureRecognizer), 
            to: target)
    addPlan(VelocitySource(gestureRecognizer, appliedTo: .layerPosition), 
            to: target)
  }
}
```

## Contract

Upon successfull completion of a gesture recognizer, adds the velocity to a property's current velocity.

```
Plan VelocitySource {
  var gestureRecognizer
  var property
}
```

`gestureRecognizer` is the gesture recognizer from which the velocity should be read.

`property` is any animatable value on the target object.

## Performer considerations

This plan goes hand-in-hand with `SpringTo`.

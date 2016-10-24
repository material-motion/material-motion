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

-----

For platforms that support a model/presentation layer separation, the `from` and `to` values can be optional. Consider the following situations:

* Both `from` and `to` are provided. Interpolates between `from` and `to`.

* Only `from` is provided. Interpolates between `from` and the current presentation value of the property.

* Only `to` is provided. Interpolates between the current value of the property and `to`.

## Performer considerations

If multiple Tweens are added for the same property then the latest tween is used.

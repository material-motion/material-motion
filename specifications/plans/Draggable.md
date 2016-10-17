# Draggable

## Contract

Delta x and y from the given gesture recognizer are added to the target's `position.x` and `position.y`. If no gesture recognizer is provided, then one is created.

```
Plan Draggable {
  var panGestureRecognizer?
  var shouldAdjustAnchorPointOnGestureStart = false
}
```

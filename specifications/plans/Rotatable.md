# Rotatable


## Contract

Z rotation from the given gesture recognizer is added to the target's `rotation.z`. If no gesture recognizer is provided, then one is created.

```
Plan Rotatable {
  GestureRecognizer rotationGestureRecognizer?
  Bool shouldAdjustAnchorPointOnGestureStart = true
}
```

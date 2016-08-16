Status of this document:
![](../../_assets/under-construction-flashing-barracade-animation.gif)

# Gesturable

## Plans

### Draggable

Contract: delta x and y from the gesture recognizer are added to the target's `position.x` and `position.y`.

    class Draggable {
      var panGestureRecognizer?
    }

### Pinchable

    class Pinchable {
      var pinchGestureRecognizer?
    }

### Rotatable

    class Rotatable {
      var rotationGestureRecognizer?
    }

### ChangeAnchorPoint

    class ChangeAnchorPoint {
      var newAnchorPoint
    }

## Performers

### GesturablePerformer


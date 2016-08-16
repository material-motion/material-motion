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

Contract: scale x and y from the gesture recognizer are multiplied to the target's `scale.x` and `scale.y`.

    class Pinchable {
      var pinchGestureRecognizer?
    }

### Rotatable

Contract: z rotation from the gesture recognizer is added to the target's `rotation.z`.

    class Rotatable {
      var rotationGestureRecognizer?
    }

### ChangeAnchorPoint

    class ChangeAnchorPoint {
      var newAnchorPoint
    }

## Performers

### GesturablePerformer


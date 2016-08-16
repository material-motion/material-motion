Status of this document:
![](../../_assets/under-construction-flashing-barracade-animation.gif)

# Gesturable

## Abstract types

### Gesturable

Contract: If any gesturable plan enables `wantsAnchorPointAdjustment` then the target's anchor point will be adjusted when gesturing begins.

    class Gesturable {
      var wantsAnchorPointAdjustment: Bool = false
    }

## Plans

### Draggable

Contract: delta x and y from the given gesture recognizer are added to the target's `position.x` and `position.y`. If no gesture recognizer is provided, then one is created.

    class Draggable: Gesturable {
      var panGestureRecognizer?
      
      defaults:
      wantsAnchorPointAdjustment = false
    }

### Pinchable

Contract: scale x and y from the given gesture recognizer are multiplied to the target's `scale.x` and `scale.y`. If no gesture recognizer is provided, then one is created.

    class Pinchable: Gesturable {
      var pinchGestureRecognizer?
      
      defaults:
      wantsAnchorPointAdjustment = true
    }

### Rotatable

Contract: z rotation from the given gesture recognizer is added to the target's `rotation.z`. If no gesture recognizer is provided, then one is created.

    class Rotatable: Gesturable {
      var rotationGestureRecognizer?
      
      defaults:
      wantsAnchorPointAdjustment = true
    }

### ChangeAnchorPoint

Contract: the anchor point of the view is immediately changed to the `newAnchorPoint`. The target's position is also updated to avoid noticeable movement of the target.

    class ChangeAnchorPoint {
      var newAnchorPoint
    }

## Performers

### GesturablePerformer

Supported plans: `Draggable`, `Pinchable`, `Rotatable`.

### AnchorPointPerformer

Supported plans: `ChangeAnchorPoint`.

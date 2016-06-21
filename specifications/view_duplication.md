Status of this document:
![](../_assets/under-construction-flashing-barracade-animation.gif)

# View duplication

View duplication is the act of creating an "apparent replica" of a visible element.

View duplication requires the "new target" event from the Runtime.

Create an instance of a view duplicator.

    duplicator = ViewDuplicator()

Identify views that shouldn't be duplicated.

    duplicator.disallowDuplicationFor(target)

Listen to Runtime events and duplicate views, if possible.

    function runtimeNewTargetEvent(targetManager) {
      if duplicator.canDuplicate(targetManager.target) {
        targetManager.setNewTarget(duplicator.duplicate(target))
      }
    }

Duplicator likely owned by a Director. Likely the duplicator is already configured by the entity that created the Director.

Default implementation should take a snapshot of views. Make exceptions for common cases.

- On iOS, is helpful to make rich duplicate of UIImageView instances for scaling purposes.

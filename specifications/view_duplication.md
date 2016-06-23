Status of this document:
![](../_assets/under-construction-flashing-barracade-animation.gif)

# Element duplication

Element duplication is the act of creating an "apparent replica" of a visual element.

---

<p style="text-align:center"><tt>MVP</tt></p>

**Dependencies**: An observable "new target" event from the Scheduler type.

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

---

## Open Questions ##

- What are the ramifications for interactivity?  If there are event listeners registered on a view's children, how do you make sure the correct things still happen if those children are interacted with on the duplicate?

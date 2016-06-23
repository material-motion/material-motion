Status of this document:
![](../_assets/under-construction-flashing-barracade-animation.gif)

# Duplicator

This is the engineering specification for the Duplicator object.

A Duplicator creates apparent replicas of visual elements. An apparent replica does not necessarily need to be as functional as the original element.

---

<p style="text-align:center"><tt>MVP</tt></p>

**Dependencies**

- Scheduler `feature: new target event`

**Simple initializer**: Element duplicators are cheap and easy to create.

Example pseudo-code:

    duplicator = Duplicator()

**Duplication API**: Provide an API for duplicating an element.

This API should accept an element and return an element.

The API may return either a new element or the provided element. If possible, do not allow the API to return a null element.

Example pseudo-code:

    Duplicator {
      function duplicate(Element element) -> Element
    }

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

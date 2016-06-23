Status of this document:
![](../_assets/under-construction-flashing-barracade-animation.gif)

# Duplicator

This is the engineering specification for the Duplicator object.

A Duplicator is expected to create apparent replicas of visual elements. An apparent replica does not necessarily need to be as functional as the original element.

---

<p style="text-align:center"><tt>MVP</tt></p>

**Dependencies**

- Scheduler `feature: new target event`

**Object type**: A Duplicator is an object type.

Example pseudo-code:

    Duplicator {
    }

**Duplication API**: Provide an API for duplicating an element.

This API should accept an element and return an element.

The API may return either a new element or the provided element.

Every type of element is assumed to be duplicable by default. An element should not be duplicated if duplication was disabled using the disable duplication API.

If possible, do not allow the API to return a null element.

The implementation of this method should create a best-effort apparent replica of the provided target.

Example pseudo-code:

    Duplicator {
      function duplicate(Element element) -> Element
    }

**Disable duplication API**: Provide an API for disabling duplication of specific elements.

The duplicator instance maintains a list of elements that should not be duplicated.

Example pseudo-code:

    Duplicator {
      function disableDuplicationForElement(Element element)
    }

**Scheduler new target event**: A common use of this entity is as a placeholder generator for a scheduler.

Example pseudo-code:

    scheduler.addNewTargetObserver(function(target) {
      if target is visible element type {
        return duplicator.duplicate(target)
      }
    })

---

## Open Questions ##

- What are the ramifications for interactivity?  If there are event listeners registered on a view's children, how do you make sure the correct things still happen if those children are interacted with on the duplicate?

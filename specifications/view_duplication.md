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

This API should accept an element and return either an element or null.

Return a valid element if the duplicator was able to duplicate the element. The returned element should be a best-effort apparent replica of the provided target. Duplication should be as cheap as possible.

Return null if the duplicator was not able to duplicate the element.

Example pseudo-code:

    Duplicator {
      function duplicate(Element element) -> Element or null
    }

**Disable duplication API**: Provide an API for disabling duplication of specific elements.

The duplicator maintains a list of elements that should not be duplicated.

Elements are assumed to be duplicable by default. Do not duplicate elements for which duplication was disabled.

Example pseudo-code:

    Duplicator {
      function disableDuplicationForElement(Element element)
    }

---

## Open Questions ##

- What are the ramifications for interactivity?  If there are event listeners registered on a view's children, how do you make sure the correct things still happen if those children are interacted with on the duplicate?

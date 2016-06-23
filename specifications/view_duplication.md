Status of this document:
![](../_assets/under-construction-flashing-barracade-animation.gif)

# Duplicator

This is the engineering specification for the Duplicator abstract type.

A Duplicator is expected to create apparent replicas of visual elements. An apparent replica does not necessarily need to be as functional as the original element.

---

<p style="text-align:center"><tt>MVP</tt></p>

**Dependencies**

- Scheduler `feature: new target event`

**Abstract type**: A Duplicator is an abstract protocol or interface, if your language allows.

Example pseudo-code:

    protocol Duplicator {
    }

**Duplication API**: Provide an API for duplicating an element.

This API should accept an element and return an element.

The API may return either a new element or the provided element. If possible, do not allow the API to return a null element.

Example pseudo-code:

    Duplicator {
      function duplicate(Element element) -> Element
    }

**Disallow duplication API**: Provide an API for disabling duplication of specific elements.

Example pseudo-code:

    Duplicator {
      function disallowDuplication(Element element)
    }

---

## Open Questions ##

- What are the ramifications for interactivity?  If there are event listeners registered on a view's children, how do you make sure the correct things still happen if those children are interacted with on the duplicate?

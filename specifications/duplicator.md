# Duplicator specification

This is the engineering specification for the `Duplicator` abstract type.

A `Duplicator` creates similar replicas of visual elements. Replicas do not necessarily need to be as functional as their original element.

---

<p style="text-align:center"><tt>MVP</tt></p>

**Object type**: A `Duplicator` is an object type.

Example pseudo-code:

    Duplicator {
    }

**Duplicator API**: Provide an API for setting a `Duplicator` instance.

The duplicator instance performs the actual duplication.

> Consider providing a default duplicator instance that performs a "best-effort" duplication.

Example pseudo-code:

    Duplicator {
      var duplicator: Duplicator
    }

**Disable duplication API**: Provide an API for disabling duplication of specific elements.

The controller maintains a permanent list of elements that will not be duplicated. We will refer to this as the list of disabled elements.

Elements are assumed to be duplicable by default. Do not duplicate elements for which duplication was disabled.

Example pseudo-code:

    Duplicator {
      function disableDuplicationForElement(Element element)
    }

**Duplication API**: Provide an API for duplicating an element.

This API should accept an element and return either an element or null.

The implementation of this API first consults the list of disabled elements. If the element is present, the API returns null. If the element is not present, the controller invokes the assigned duplicator's `duplicateElement` API.

Example pseudo-code:

    Duplicator {
      function duplicate(Element element) -> Element or null {
        if disabledElements.contains(element) {
          return null
        }
        return duplicator.duplicateElement(element)
      }
    }

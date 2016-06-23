# DuplicationController specification

This is the engineering specification for the DuplicationController object.

A DuplicationController is expected to create similar replicas of visual elements. A replica does not necessarily need to be as functional as the original element.

The DuplicationController requires a concrete implementation of the Duplicator abstract type.

---

<p style="text-align:center"><tt>MVP</tt></p>

**Object type**: A DuplicationController is an object type.

Example pseudo-code:

    DuplicationController {
    }

**Duplicator API**: Provide an API for setting a Duplicator instance.

The duplicator instance performs the actual duplication.

> Consider providing a default duplicator instance that performs a "best-effort" duplication.

Example pseudo-code:

    DuplicationController {
      var duplicator: Duplicator
    }

**Disable duplication API**: Provide an API for disabling duplication of specific elements.

The controller maintains a permanent list of elements that will not be duplicated. We will refer to this as the list of disabled elements.

Elements are assumed to be duplicable by default. Do not duplicate elements for which duplication was disabled.

Example pseudo-code:

    DuplicationController {
      function disableDuplicationForElement(Element element)
    }

**Duplication API**: Provide an API for duplicating an element.

This API should accept an element and return either an element or null.

The implementation of this API should first consult the list of disabled elements. If the element is present, the API should return null. If the element is not present, the controller should invoke the assigned duplicator's `duplicateElement` API.

Example pseudo-code:

    DuplicationController {
      function duplicate(Element element) -> Element or null {
        if disabledElements.contains(element) {
          return null
        }
        return duplicator.duplicateElement(element)
      }
    }

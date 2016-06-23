# DuplicationController specification

This is the engineering specification for the `DuplicationController` object.

A `DuplicationController` makes use of a Duplicator instance to create similar replicas of visual elements. The `DuplicationController` provides additional APIs for configuring duplication.

Printable tech tree/checklist:

![](../_assets/DuplicationControllerTechTree.svg)

---

<p style="text-align:center"><tt>MVP</tt></p>

**Concrete object**: A `DuplicationController` is a concrete object.

Example pseudo-code:

    DuplicationController {
    }

**Duplicator API**: Provide an API for setting a `Duplicator` instance.

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

The implementation of this API first consults the list of disabled elements. If the element is present, the API returns null. If the element is not present, the controller invokes the assigned duplicator's `duplicateElement` API.

Example pseudo-code:

    DuplicationController {
      function duplicate(Element element) -> Element or null {
        if disabledElements.contains(element) {
          return null
        }
        return duplicator.duplicateElement(element)
      }
    }

<p style="text-align:center"><tt>/MVP</tt></p>

---

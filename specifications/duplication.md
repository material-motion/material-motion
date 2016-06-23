# Duplication

Duplication makes it possible to add motion to an element hierarchy without directly affecting the existing elements.

The following happens when an element is duplicated:

- The original element is hidden.
- The duplicated element, called the *duplicate*, is positioned and sized to visually replace the original element.
- Motion is applied to the duplicated element.
- Once no longer needed, the duplicated element is thrown away. If applicable, the original element is unhidden.

---

## Open Questions ##

- What are the ramifications for interactivity?  If there are event listeners registered on a view's children, how do you make sure the correct things still happen if those children are interacted with on the duplicate?


# Duplication

Duplication makes it possible to add motion to an element hierarchy without directly affecting the existing elements. This is helpful for separating concerns when building transitions.

The following often occurs after an element is duplicated:

- The original element is hidden.
- The duplicated element is positioned and sized to occupy the original element's place on the screen. The duplicated element may not necessarily be in the same node of the element tree.
- Motion is applied to the duplicated element.
- Once its purpose is served, the duplicated element is thrown away. If applicable, the original element is unhidden.

---

## Open Questions ##

- What are the ramifications for interactivity?  If there are event listeners registered on an element's children, how do you make sure the correct things still happen if those children are interacted with on the duplicate?

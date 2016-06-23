# Duplication

Duplication makes it possible to add motion to an element hierarchy without directly affecting the existing elements. This is helpful for separating concerns when building transitions.

The following often occurs after an element is duplicated:

- The original element is hidden.
- The duplicated element is positioned and sized to occupy the original element's place on the screen. The duplicated element may not necessarily be in the same node of the element tree.
- Motion is applied to the duplicated element.
- Once its purpose is served, the duplicated element is thrown away.
- The original element is unhidden.

Duplication makes use of two APIs:

- [Duplicator](duplicator.md)
- [DuplicationController](duplication_controller.md)

---

## Open Questions ##

- What are the ramifications for interactivity?  If there are event listeners registered on an element's children, how do you make sure the correct things still happen if those children are interacted with on the duplicate?

If a client registers a plan to a target and the target is duplicated, then the Scheduler will apply the plans to the duplicated element. This allows you to describe an element as being "draggable" without having to worry about whether it's the original element or a duplicate.

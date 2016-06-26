# Duplication

Duplication allows motion to be added to an element hierarchy without directly affecting the existing elements. This is helpful for separating concerns when building transitions but often comes with an up-front cost.

The following often occurs after an element is duplicated:

- The original element is hidden.
- The duplicated element is positioned and sized to occupy the original element's place on the screen. The duplicated element may not necessarily be in the same node of the element tree.
- Motion is applied to the duplicated element.
- Once its purpose is served, the duplicated element is thrown away.
- The original element is unhidden.

Duplication makes use of two APIs:

- [Duplicator](duplicator.md)
- [DuplicationController](duplication_controller.md)

## Considerations

Duplication is a helpful tool for separating concerns in an application.

Duplication may be expensive depending on the platform and the content of the element. Take care to consider this cost.

TODO: Discuss view recycling as a solution to duplication costs.

---

## Open Questions ##

- What are the ramifications for interactivity?  If there are event listeners registered on an element's children, how do you make sure the correct things still happen if those children are interacted with on the duplicate?

Potential answer: If a client registers a plan to a target and the target is duplicated, then the Scheduler will apply the plans to the duplicated element. This allows you to describe an element as being "draggable" without having to worry about whether it's the original element or a duplicate.

- How should we handle duplication of child elements that have already been duplicated?

For example:

    containerView
      childView
        button

What happens if we want to duplicate both the containerView and the button?

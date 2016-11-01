# Target replication

Replication allows motion to appear to affect an element without adversely affecting the existing element hierarchy. This is helpful for separating concerns when building transitions but often comes with an up-front cost.

**Replicate**: to make a close or exact copy; a replica.

The following often occurs after an element is replicated:

- The original element is hidden.
- The replicated element is positioned and sized to occupy the original element's place on the screen. The replicated element may not necessarily be in the same node of the element tree.
- Motion is applied to the replicated element.
- Once its purpose is served, the replicated element is thrown away.
- The original element is unhidden.

## Considerations

**Separation of concerns**: Replication is a helpful tool for separating concerns in an application.

**Cost of replication**: Depends on the platform and the content of the element. Take care to consider this cost.

**Recycling elements**: A `ReplicaCreator` implementation may choose to recycle elements rather than create a new element with each replication.

---

## Open Questions ##

- What are the ramifications for interactivity?  If there are event listeners registered on an element's children, how do you make sure the correct things still happen if those children are interacted with on the replicate?

Potential answer: If a client registers a plan to a target and the target is replicated, then the runtime will apply the plans to the replicated element. This allows you to describe an element as being "draggable" without having to worry about whether it's the original element or a replicate.

- How should we handle replication of child elements that have already been replicated?

For example:

    containerView
      childView
        button

What happens if we want to replicate both the containerView and the button?

# Transitions

| Discussion thread | Status |
|:------------------|:-------|
| ![](../../../_assets/under-construction-flashing-barracade-animation.gif) | Drafting as of Oct 25, 2016 |

A transition causes a visual change from one element hierarchy to another.

Transitions are a specialized subset of general interactions with different meanings on different platforms:

- iOS: UIViewController transitions
- Android: Activity transitions
- Web: URL transitions

The considerations for each platform are diverse and often distinct. To reflect this, the transitions spec is split into two parts: **common specs** and **platform specs**.

## Common specs

- [Directionality](directionality.md)
- [Life of a transition director](life_of_a_transition_director.md)
- [ContextTransition](ContextTransition.md)
- [ContextTransitionDirector](ContextTransitionDirector.md)

## Platform specs

- [iOS](platform/ios/)

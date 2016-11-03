---
layout: page
permalink: /specifications/interactions/
title: Interactions
---

# Interactions

| Discussion thread | Status |
|:------------------|:-------|
| ![](/assets/under-construction-flashing-barracade-animation.gif) | Drafting as of Oct 27, 2016 |

An interaction describes a coherent interactive experience.

Interactions can involve any number of plans and targets. The specificity of an interaction is left as an exercise to its creator.

Interactions should prefer composition over subclassing.

## Interactions or Plans?

To determine whether something is an Interaction or a Plan, consider the number of targets involved. Only one target? It should be a Plan. More than one target? It should be an Interaction.

Consider the following interaction:

```
Interaction FadeIn {
  func applyTo(target) {
    let plan = Tween("opacity", duration: 0.3)
    plan.from = 0
    plan.to = 1
    addPlan(plan, to: target)
  }
}
```

There is only one target involved here, so we might be better off creating a Plan instead:

```
Plan FadeIn {
  Performer {
    func addPlan(fadeIn) {
      let plan = Tween("opacity", duration: 0.3)
      plan.from = 0
      plan.to = 1
      emitPlan(plan)
    }
  }
}

// We can now write:
addPlan(FadeIn(), to: target)
```

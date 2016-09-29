# Performer composition specification

Performers can emit new plans. This is a type of composition.

|           | Android   | Apple     |
| --------- |:---------:|:---------:|
| First introduced | [Runtime 2.0.0](https://github.com/material-motion/material-motion-runtime-android/releases/tag/2.0.0) | [Runtime 3.0.0](https://github.com/material-motion/material-motion-runtime-objc/releases/tag/v3.0.0) |

Composition enables the creation of higher-order plans. For example, a "Tossable" plan's performer might generate a "Draggable" and "AttachedSpring" plan. Or more simply, a "FadeIn" plan might compose out to a more general-purpose "Tween" plan.

Composition enables code reuse in the Material Motion ecosystem.

---

**PlanEmitter API**: A performer may be provided with a plan emitter object.

> The Performer may choose not to receive such an object.

A plan emitter declaration might look like so:

    protocol PlanEmitter {
      func addPlan(Plan)
    }

A performer can be provided with a plan emitter.

Example pseudo-code protocol that a performer could conform to:

    protocol ComposablePerforming {
      func set(planEmitter: PlanEmitter)
    }

Pseudo-code of a performer emitting new plans:

    function onGesture(gesture) {
      if gesture.state == Ended {
        planEmitter.addPlan(Spring())
      }
    }

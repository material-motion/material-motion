# Performer composition specification

Performers can emit plans. This is a type of composition.

|           | Android   | Apple     |
| --------- |:---------:|:---------:|
| Milestone | [Milestone](https://github.com/material-motion/material-motion-runtime-android/milestone/3) | [Milestone](https://github.com/material-motion/material-motion-runtime-objc/milestone/10) |

Composition enables the creation of higher-order plans. For example, a "Tossable" plan's performer might generate a "Draggable" and "AttachedSpring" plan. Or more simply, a "FadeIn" plan might compose out to a more general-purpose "Tween" plan.

Composition is what will enable code reuse in the Material Motion ecosystem.

---

**transactionEmitter API**: A performer may be provided with a transaction emitter object.

> The Performer may choose not to implement this API.

A transaction emitter declaration might look like so:

    protocol TransactionEmitter {
      func emit(transaction: Transaction)
    }

A performer can be provided with a transaction emitter.

Example pseudo-code protocol that a performer could conform to:

    protocol ComposablePerforming {
      func set(transactionEmitter: TransactionEmitter)
    }

Pseudo-code of a performer emitting new plans:

    function onGesture(gesture) {
      if gesture.state == Ended {
        let transaction = Transaction()
        transaction.add(plan: Spring(), to: self)
        self.emitter.emit(transaction)
      }
    }

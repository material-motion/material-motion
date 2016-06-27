Status of this document:
![](../_assets/under-construction-flashing-barracade-animation.gif)

# TransitionController specification

This is the engineering specification for the `TransitionController` object.

`TransitionController` is the bridge between the platform's transitioning architecture and the `TransitionDirector` type.

---

<p style="text-align:center"><tt>MVP</tt></p>

**Concrete type**: A `TransitionController` is a concrete type.

Example pseudo-code:

    TransitionController {
    }

**One controller per transition**: Every transition has access to its own `TransitionController` instance.

**Transition director type API**: Provide a public API for storing a `TransitionDirector` type.

The type must be a subclass of `TransitionDirector`.

Example pseudo-code:

    TransitionController {
      public var directorType: type(TransitionDirector)
    }

**Runtime**: Store a single `Runtime` instance while the transition is active.

Example pseudo-code:

    TransitionController {
      private var runtime: Runtime
    }

**Duplication controller**: Store a single `DuplicationController` instance while the transition is active.

Example pseudo-code:

    TransitionController {
      private var duplicationController: DuplicationController
    }

**Transition director**: Store a single `TransitionDirector` instance while the transition is active.

Example pseudo-code:

    TransitionController {
      private var director: TransitionDirector
    }

**Transition will start**: The following should occur when a transition is about to begin:

1. Initialize the director
2. Invoke the `setUp` event on the director
3. Commit the `setUp` transaction to a scheduler

Example pseudo-code:

    TransitionController {
      function transitionWillStart(initialDirection) {
        # Initialize the Director
        duplicationController = DuplicationController()
        duplicationController.duplicator = SystemDuplicator()
        
        director = self.directorType(initialDirection, duplicationController)
        
        # Phase: set up
        transaction = Transaction()
        director.setUp(transaction)
        
        # Initialize the runtime
        scheduler = Scheduler()
        scheduler.addNewTargetObserver(duplicationController)
        scheduler.addActivityStateObserver(self)
        scheduler.commit(transaction)
      }
    }

**Finish on idle**: Finish the transition when the scheduler enters the idle activity state.

Example pseudo-code:

    TransitionController {
      function schedulerActivityStateDidChange(scheduler) {
        if scheduler.state == .Idle {
          self.transitionDidFinish()
        }
      }
    }

**System bridge**: Implement the necessary bridge for the platform's transitioning APIs.

This differs greatly from platform to platform.

<p style="text-align:center"><tt>/MVP</tt></p>

---

<p style="text-align:center"><tt>feature: director stack</tt></p>

TODO: Discuss director stack.

<p style="text-align:center"><tt>/feature: director stack</tt></p>

---

TODO: Spec out.

The owner of a Transition Director is responsible for creating a Runtime and committing the Transaction.

Example pseudo-code:

    runtime = Runtime()
    transaction = Transaction()
    
    director = Director()
    director.setUp(transaction)
    
    runtime.commit(transaction)

Status of this document:

![](../_assets/under-construction-flashing-barracade-animation.gif)

# TransitionController specification

This is the engineering specification for the `TransitionController` object.

## Overview

The `TransitionController` is the bridge between the platform's transitioning architecture and the `TransitionDirector` type. Note that a `TransitionController` can make use of a `TransitionRunner`, an object that handles the director and the scheduler, to just focus on the the platform's transitioning API. This document assumes no such object is being used.

## MVP

**Concrete type**: A `TransitionController` is a concrete type.

Example pseudo-code:

    TransitionController {
    }

**One controller per transition**: Every transition has access to its own `TransitionController` instance.

A transition can represent two directions. For example, present and dismiss are two directions of a single transition.

**Transition director type API**: Provide a public API for storing a `TransitionDirector` type.

The type must be a subclass of `TransitionDirector`.

Example pseudo-code:

    TransitionController {
      public var directorClass: typeof(TransitionDirector)
    }

**Transition will start**: The following should occur when a transition is about to begin:

1. Initialize the director
2. Invoke the `setUp` event on the director
3. Commit the `setUp` transaction to a scheduler

Example pseudo-code:

    TransitionController {
      function transitionWillStart(initialDirection) {
        # Initialize the Director
        replicationController = ReplicationController()
        replicationController.duplicator = SystemDuplicator()
        director = self.directorClass(initialDirection, replicationController)
        
        # Phase: set up
        transaction = Transaction()
        director.setUp(transaction)
        
        # Initialize the scheduler
        scheduler = Scheduler()
        scheduler.addNewTargetObserver(replicationController)
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
      
      function transitionDidFinish() {
        director.tearDown();
      }
    }

**System bridge**: Implement the necessary bridge for the platform's transitioning APIs.

This differs greatly from platform to platform.

## Open Questions

- How do we handle directors that never enter the .Active state?

# Life of a transition controller

Let's walk through the life of an arbitrary transition.

> Remember, any code you see here is pseudo-code.

### Step 1: A transition controller is created

Generally speaking, every "page" in an application should have its own transition controller. A transition controller is responsible for handling how a page is presented and dismissed.

For example, assume our platform has some concept of a "page":

```
page.transitionController.directorClass = SlideInTransitionDirector
```

In the above example we've declared that this page should slide in when it is presented and slide out when it is dismissed.

> Note: this controller is **not** responsible for defining what happens when a new page is presented. The page-being-presented is responsible for defining that.

Transition controllers can be created **lazily**. In the absence of a transition controller, standard system transitions should take effect.

### Step 2: Connect the transition controller to the platform

A transition controller reacts to the initiation of new transitions by customizing the motion that occurs. How a transition controller reacts to new transitions differs on a platform-by-platform basis.

> On iOS, for example, a transition controller is set as the `transitioningDelegate` property. This allows the controller to be informed when a new transition is about to start. The controller can then initiate the transition and, upon completion, hand control back to the platform.

### Step 3: Initiate a transition

Most platforms have a standard mechanism for initiating a transition. At this point our transition controller should take control of the transition.

#### Step 3.1: Create a scheduler and a director

To coordinate a transition, a transition controller must create a scheduler and a director.

The transition controller may hold on to an object that stores both the scheduler and the director during the lifetime of the transition. Such an object could be called a `TransitionRunner`.

For example:

```
transitionWillStart(initialDirection) {
  runner = TransitionRunner(directorClass(initialDirection))
}

class TransitionRunner {
  let scheduler
  initWithDirector(director) {
    scheduler = Scheduler()
    director.setPlanEmitter(scheduler)
    director.setUp()

    scheduler.addActivityStateObserver({
      if scheduler.activityState == isIdle {
        self.transitionDidComplete()
      }
    })
  }
}
```

### Step 4: Once the runtime idles, terminate the transition

Once the transition controller detects that the scheduler activity has idled, the transition controller should terminate the transition. How this is communicated will depend on the platform.

> On iOS, for example, the transition controller must invoke a specific method to inform UIKit that the transition has either completed or canceled.

The TransitionRunner is responsible for invoking `tearDown` on the director.

```
class TransitionRunner {
 function transitionDidFinish() {
   director.tearDown()
 }
}
```

At this point the transition controller might throw away its `TransitionRunner` instance. 

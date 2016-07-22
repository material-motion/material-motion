Status of this document:
![](../_assets/under-construction-flashing-barracade-animation.gif)

# Life of a transition controller

Let's walk through the life of an arbitrary transition.

> Remember, any code you see here is pseudo-code.

### Step 1: A transition controller is created

Generally speaking, every "page" in an application should have its own transition controller. A transition controller is responsible for handling how a page is presented and dismissed.

For example, assume our platform has some concept of a "page":

    page.transitionController.directorClass = SlideInTransitionDirector

In the above example we've declared that this page should slide in when it is presented and slide out when it is dismissed.

> Note: this controller is **not** responsible for defining what happens when a new page is presented. The page-being-presented is responsible for defining that.

Transition controllers can be created **lazily**. In the absence of a transition controller, standard system transitions should take effect.

### Step 2: Connect the transition controller to the platform

A transition controller reacts to the initiation of new transitions by customizing the motion that occurs. How a transitioin controller reacts to new transitions differs on a platform-by-platform basis.

> On iOS, for example, a transition controller is set as the `transitioningDelegate` property. This allows the controller to be informed when a new transition is about to start. The controller can then initiate the transition and, upon completion, hand control back to the platform.


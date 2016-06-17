# Glossary

## actor

An **Actor**'s sole responsibility is to fulfill the contract defined by one or more Intentions of a specific type.

Similar concepts:

- [Behavior](http://docs.unity3d.com/ScriptReference/Behaviour.html) (Unity)
- [UIDynamicBehavior](https://developer.apple.com/library/ios/documentation/UIKit/Reference/UIDynamicBehavior_Class/) (UIKit for iOS)

## dictionary

A list of terms and modifiers.

## element

A node in a hierarchical layout/compositing system.

Examples:

- [UIView](https://developer.apple.com/library/ios/documentation/UIKit/Reference/UIView_Class/) (iOS)
- DOM element (web)

## execution

The execution of a plan.

## expression

Functional, syntactic sugar for the creation and configuration of plans.

## frame

One iteration of the animation loop.  Frames should be redrawn at least 60 times per second to ensure an application is [jank-free](http://jankfree.org).

Synonyms:

- tick
- step
- cycle

## intention

An Intention is an object representing **what you want something to do**.

An Intention is the *plan* part of the separation of plan/fulfillment.

## language

The beginning of an Expression.

## plan

A Plan is **what you want something to do**.

Examples:

- [CAAnimation](https://developer.apple.com/library/ios/documentation/GraphicsImaging/Reference/CAAnimation_class/) (iOS)

## platform

Either an operating system or a cross-platform abstraction layer.

Examples:

- iOS
- Android
- Unity
- Web (Chrome)
- Web (Safari)

## runtime

An entity that facilitates the coordination of rich, interactive motion. Receives Plans and fulfills them.

## scrubbing

The act of directly manipulating a Timeline's `progress` value.

## target

A target is the entity to which a Plan is meant to be applied, such as an element or a Timeline.

## transaction

A mechanism by which new Intentions are committed to a Runtime.

## update event

The update event is called on an Actor many times per second. These events are usually synchronized to the current display's refresh rate: 60 times per second being common, 90 times per second being recommended for VR.

We've listed technologies/APIs that provide this type of event for a variety of platforms below:
- Core Animation: CADisplayLink's selector calls
- Unity: Update event on a Behavior
- Web: `window.requestAnimationFrame`
- Android: `Choreographer.FrameCallback`
- GLUT: `Update()`
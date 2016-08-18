# Glossary

## at rest

The state of a Scheduler or Performer when all of the plans that it's been provided have been performed.

## director

An object created for the purposes of describing motion.

## element

A node in a hierarchical layout\/compositing system.

Examples:

* [UIView](https://developer.apple.com/library/ios/documentation/UIKit/Reference/UIView_Class/) \(iOS\)
* DOM element \(web\)

## execution

The execution of a plan.

## executor

An **Executor**'s sole responsibility is to fulfill the contract defined by one or more Plans.

Similar concepts:

* [Behavior](http://docs.unity3d.com/ScriptReference/Behaviour.html) \(Unity\)
* [UIDynamicBehavior](https://developer.apple.com/library/ios/documentation/UIKit/Reference/UIDynamicBehavior_Class/) \(UIKit for iOS\)

## expression

Functional, syntactic sugar for the creation and configuration of plans.

## plan

A plan is **what you want something to do**.

Examples:

* [CAAnimation](https://developer.apple.com/library/ios/documentation/GraphicsImaging/Reference/CAAnimation_class/) \(iOS\)

In relation to a Runtime, a Plan is a concrete object that can be associated with a target.

## platform

An operating system or a cross-platform abstraction layer.

Examples:

* iOS
* Android
* Unity
* Web \(Chrome\)
* Web \(Safari\)

## protocol

The contract\/shape\/blueprint an object is expected to conform to in order to interoperate with other objects in the system.

In some languages \(like Java and ActionScript\), this is called an `interface`.

## runtime

An object that facilitates the coordination of rich, interactive motion.

## scrubbing

The act of directly manipulating a Timeline's `progress` value.

## target

A target is the entity to which a plan is meant to be applied, such as an element or a Timeline.

## transaction

A mechanism by which new Plans are committed to a Runtime.

## update event

The update event is called on an Executor many times per second. These events are usually synchronized to the current display's refresh rate: 60 times per second being common, 90 times per second being recommended for VR.

We've listed technologies\/APIs that provide this type of event for a variety of platforms below:

* Android: `Choreographer.FrameCallback`
* Core Animation: CADisplayLink's selector calls
* GLUT \(OpenGL\): `glutDisplayFunc()`
* Unity: Update event on a Behavior
* Web: `window.requestAnimationFrame`


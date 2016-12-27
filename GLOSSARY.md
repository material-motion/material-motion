---
layout: page
---

# Glossary

## at rest

A state indicating that no change is occurring. The antonym is **active**.

## director

The highest-level concept used to apply motion to a system.

## element

A node in a hierarchical layout/compositing system.

Examples:

* [UIView](https://developer.apple.com/library/ios/documentation/UIKit/Reference/UIView_Class/) (iOS)
* DOM element (web)

## expression

Functional, syntactic sugar for the creation and configuration of plans.

## platform

An operating system or a cross-platform abstraction layer.

Examples:

* iOS
* Android
* Unity
* Web (Chrome)
* Web (Safari)

## protocol

The contract/shape/blueprint an object is expected to conform to in order to interoperate with other objects in the system.

In some languages (like Java and ActionScript), this is called an `interface`.

## runtime

An object that facilitates the coordination of rich, interactive motion.

## scrubbing

The act of directly manipulating a Timeline's `progress` value.

## update event

The update event is called on an Executor many times per second. These events are usually synchronized to the current display's refresh rate: 60 times per second being common, 90 times per second being recommended for VR.

We've listed technologies\/APIs that provide this type of event for a variety of platforms below:

* Android: `Choreographer.FrameCallback`
* Core Animation: CADisplayLink's selector calls
* GLUT \(OpenGL\): `glutDisplayFunc()`
* Unity: Update event on a Behavior
* Web: `window.requestAnimationFrame`


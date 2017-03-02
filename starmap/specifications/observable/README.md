---
layout: page
permalink: /starmap/specifications/observable/
interfacelevel: L4
implementationlevel: L4
---

# Observable pattern

> The observer pattern is a software design pattern in which an object, called the subject,
> maintains a list of its dependents, called observers, and notifies them automatically of any state
> changes, usually by calling one of their methods.
>
> *Source: [Wikipedia](https://en.wikipedia.org/wiki/Observer_pattern)*

The [ReactiveX community](http://reactivex.io/) provides one of the largest applications of the
Observer pattern, with implementations spanning many platforms and languages. Material Motion makes
use of the Observer pattern to build motion that is **tweakable**, **reactive**, and
**highly-coordinated**.

## IndefiniteObservable

The ReactiveX implementations of the Observable pattern are designed with **transactional** data
flow in mind. Three actions can occur on a ReactiveX stream: data flow, completion, and failure. For
example, an array turned into a stream will emit each item in the array, followed by a completion
event.

Motion design is a similar sort of data flow, but it is not transactional in nature. For example: a
gesture recognizer might start and stop at any point in time.

For this reason we created the IndefiniteObservable type. An IndefiniteObservable is an Observable
that may never complete in any permanent way.

## Why not make use of ReactiveX implementations?

Material Motion is designed to be a light-weight solution for building powerful, reactive motion in
an application. For this reason, any external dependencies must be carefully weighed and justified.

The existing ReactiveX implementations are often multiple **thousands** of lines of code and
represent **hundreds of kilobytes** of minified source. By comparison, our IndefiniteObservable
implementations are each under 100 lines of code and, on the web, can be minified to under 140 bytes
(the entire implementation fits in
[a tweet](https://twitter.com/material_motion/status/804855074988003328)).

---
layout: default
permalink: /roadmap/
---

# Material Motion Roadmap

As an open source project we want to ensure that community members have a clear and transparent understanding of the direction of Material Motion's development. This roadmap can be thought of as a short-term companion guide to what the Material Motion team is prioritizing or working on. It also acts as a historical record of major milestones we've passed as a team.

The ambition for Material Motion is large, meaning there are many independent initiatives to be taken. **The Core Team will communicate its primary focus via this roadmap**. We'll also define open-ended roads that we hope the community will be interested in exploring as well.

We work on three separate platforms

## Core team roadmap

The following roadmap topics are listed in order of ascending importance from top to bottom. We may iterate towards each topic in parallel, but our overall priorities will be focused on the top-most topic and working our way downward.

### Stabilized APIs

Stabilize the APIs by cutting a v1.0 release. Once a v1 release is cut, all APIs will be subject to traditional deprecation policies, meaning no API can be deleted unless there has been at least one minor release in which the API was deprecated. If an API is deleted, the major version must be incremented.

Who's driving this:

- Android: Mark Wei
- iOS: Jeff Verkoeyen
- JavaScript: Brenton Simpson

Open milestones:

- [Android](https://github.com/material-motion/material-motion-android/milestone/3)
- [JavaScript](https://github.com/material-motion/material-motion-js/milestone/19)

Milestones hit:

- ✓ Swift (March 25, 2017)

### Open source components using Material Motion

Components are a la carte libraries that provide complete experiences using Material Motion. The most classic example of such a library is a transition. Examples of different transitions: fade in, circular reveal, modal dialog, side drawer. Other libraries may exist for things like animated graph visualizations, one-off animations, and immersive experiences.

Who's driving this:

- iOS: Jeff Verkoeyen

Open milestones:

- [Swift](https://github.com/material-motion/material-motion-swift/milestone/3)

### Powerful motion engineering tooling.

Material Motion is designed to enable the creation of powerful tooling for engineers and designers in order to eliminate the concept of a "design handoff". We see three major areas of tooling potential:

1. **Runtime visualization**. Visualizing the runtime as a connected graph of modifiable streams.
2. **Tweaking**. Being able to modify any reactive property in the system in real time. Properties should be grouped together and visualized with semantic awareness of their relevance to one another (e.g. all properties on a Spring interaction are grouped together).
3. **Creation**. Enabling engineers and designers to prototype new interactions without having to write code. The raw version of this tool might simply be a graph stream tool. A more complex tool might appear more traditional in nature.

Who's driving this:

- iOS: Jeff Verkoeyen

Open milestones:

- Swift
  - [Reactive controls](https://github.com/material-motion/material-motion-swift/milestone/2)
  - [Runtime visualization](https://github.com/material-motion/material-motion-swift/milestone/6)

## Community roadmap

### Case studies

We use case studies to validate the feasibility of various experiences with Material Motion.

#### Award/badge animation

A badge or award is shown and an animation, likely a particle animation, is initiated. The animation could loop or be a one-off.

#### Sliding drawer

A drawer is dragged/animated out from the edge of the screen and a scrim overlay is optionally shown over the underlying content. Tapping on the scrim will dismiss the drawer. Dragging the drawer will allow you to dismiss it as well. Attempting to drag the drawer beyond the edge of the screen will make it rubber band.

![]({{ site.url }}/assets/case-study-drawer.gif)

#### Picture-in-picture video player

A video player that can be collapsed to the corner of the screen. It's possible to:

- move the video to different corners of the screen,
- to expand the video fullscreen again,
- to dismiss the video with a gesture,
- to dismiss the video by clicking a dismiss button.

It's important that the video, if playing, does not stop or stutter while being animated or moved.

![]({{ site.url }}/assets/case-study-scroll-away.gif)

---
layout: default
---

## Community roadmap

The community roadmap defines open-ended projects and ideas that can be explored in parallel and independently of the core team roadmap.

### Case studies

We use case studies to validate the feasibility of various experiences with Material Motion.

#### Award/badge animation

A badge or award is shown and an animation, likely a particle animation, is initiated. The animation could loop or be a one-off.

![]({{ site.url }}/assets/case-study-celebration.gif)

#### Bottom sheet

Mobile only. A sheet is animated from the bottom of the screen up to cover the full screen. May be driven by a gesture. Gesture should feed continuously into scrolling of the sheet's content.

When viewing long content, scrolling to the top of the content should overshoot with a bounce, showing the underlying content in order to indicate that the sheet can be dismissed if grabbed again and tossed downard.

![]({{ site.url }}/assets/case-study-bottom-sheet.gif)

#### Bubbles transition

A transition in which a variety of on-screen objects show anticipation and then swoop off-screen while the incoming view fades in.

![]({{ site.url }}/assets/case-study-bubbles-transition.gif)

#### Carousel

A horizontal paginated scroll view that transforms pages as they move to the center of the screen.

![]({{ site.url }}/assets/case-study-carousel.gif)

#### Custom slider control

A slider control that, when selected, expands outward and changes its value according to drags along a given axis.

![]({{ site.url }}/assets/case-study-custom-slider-control.gif)

#### Hearts

A swarm of floating hearts appears from the bottom of the screen and floats up and beyond the top of the screen. Individual hearts can be grabbed.

![]({{ site.url }}/assets/case-study-hearts.gif)

#### Grid choreography

A grid of items fades in or out in a radial wave pattern.

![]({{ site.url }}/assets/case-study-grid-choreography.gif)

#### Picture-in-picture video player

A video player that can be collapsed to the corner of the screen. It's possible to:

- move the video to different corners of the screen,
- to expand the video fullscreen again,
- to dismiss the video with a gesture,
- to dismiss the video by clicking a dismiss button.

It's important that the video, if playing, does not stop or stutter while being animated or moved.

![]({{ site.url }}/assets/case-study-scroll-away.gif)

#### Sliding drawer

A drawer is dragged/animated out from the edge of the screen and a scrim overlay is optionally shown over the underlying content. Tapping on the scrim will dismiss the drawer. Dragging the drawer will allow you to dismiss it as well. Attempting to drag the drawer beyond the edge of the screen will make it rubber band.

![]({{ site.url }}/assets/case-study-drawer.gif)

#### Sticker editor

Allows the user to directly manipulate a variety of stickers place on the screen using one or two finger gestures. Whichever top-most sticker is at the center of a multi-finger gesture should be the sticker that is manipulated.

![]({{ site.url }}/assets/case-study-sticker-editor.gif)

#### Push back transition

A transition that pushes the underlying content into the screen while sliding the incoming content up from the bottom of the screen. May be dismissable with gestures like a sliding drawer.

This study could be thought of as a variant of the more abstract sliding drawer case study.

![]({{ site.url }}/assets/case-study-transition-push-back.gif)

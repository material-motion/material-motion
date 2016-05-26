Want to contribute? Great! First, read this page (including the small print at the end).

### Before you contribute

Before we can use your code, you must sign the
[Google Individual Contributor License Agreement](https://developers.google.com/open-source/cla/individual?csw=1)
(CLA), which you can do online. The CLA is necessary mainly because you own the
copyright to your changes, even after your contribution becomes part of our
codebase, so we need your permission to use and distribute your code. We also
need to be sure of various other things—for instance that you'll tell us if you
know that your code infringes on other people's patents. You don't have to sign
the CLA until after you've submitted your code for review and a member has
approved it, but you must do it before we can put your code into our codebase.
Before you start working on a larger contribution, you should get in touch with
us first through the issue tracker with your idea so that we can help out and
possibly guide you. Coordinating up front makes it much easier to avoid
frustration later on.

### Naming convention for implementation repositories

When no implementation of a concept exists, the material-motion organization
may build one for a given platform or programming language. The naming
convention we use for repositories is:

    github.com/material-motion/material-motion-<concept>-<language|platform>

Note that everything is lower-case. We use hyphens to separate words.

The following names match the convention:

- github.com/material-motion/material-motion-language-tween-objc
- github.com/material-motion/material-motion-language-tween-swift
- github.com/material-motion/material-motion-language-tween-android
- github.com/material-motion/material-motion-language-tween-web
- github.com/material-motion/material-motion-runtime-objc
- github.com/material-motion/material-motion-runtime-android
- github.com/material-motion/material-motion-runtime-web

The following names do not match the convention:

- github.com/material-motion/SwiftTweenLanguage
- github.com/material-motion/TweenLanguage
- github.com/material-motion/material-motionRuntime

### Proposing changes to the Starmap

#### Proposing new concepts

Note: the concepts described in the Starmap are opinionated topics that
specifically apply to the creation of interactive software interfaces. The
Starmap is not an exhaustive list of topics and ideas for motion and interaction
in general.

If you feel that the Starmap is missing a particular concept please draft the
concept and propose it as a Pull Request.

#### Proposing a new repo for github.com/material-motion

Repositories in the material-motion organization must be created by a member of
the core material-motion team. To request the creation of a new one, please file
a pull request with the following template:

    Title: [proposal] New repo: material-motion-<concept>-<language|platform>
    
    I’d like to create a new repository named:
    
        material-motion-<concept>-<language|platform>
        
    Why I think it’s best for the material-motion project to create and own this
    repository:
    
    <Your answer here>
    
    Here’s a list of similar implementations:
    
    -
    -

#### Proposing terminology changes

Throughout the Starmap we will associate specific terminology with concepts.
Such associations are rarely perfect, nor do we expect them to be. The
following process is an effort to minimize the subjective nature of the
expected naming discussions.

If you feel that a chosen term does not effectively communicate the intended
meaning, please do the following:

1. Make a copy of the starmap. 
2. Perform a global find-and-replace of the term. Ensure that the new term
   applies to all existing contexts. 
3. Write an explanation for why you feel the new term should supplant the
   existing term including answers to each of the following questions: 
  1. What do you feel the current term describes? 
  2. What do you feel the new term describes that the current term does not? 
  3. Are there existing uses of your proposed term in the software industry?
     If so, please provide links to references. 
4. Propose the change as a pull request. 

If no consensus is able to be reached then the pull request will be closed and
the terminology will not be changed.

### The small print

Contributions made by corporations are covered by a different agreement than
the one above, the [Software Grant and Corporate Contributor License Agreement](https://cla.developers.google.com/about/google-corporate).
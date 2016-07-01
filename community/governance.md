# Governance

The Material Motion [Starmap](https://material-motion.gitbooks.io/material-motion-starmap/content/) and its implementations represent a collaborative effort lead by a core group of contributors. The core contributors represent diverse backgrounds across many platforms and languages. The initial core contributors are all Googlers.

## Accepting contributions

We use the following rules for accepting contributions.

1. We require that all contributors sign [Google's Contributor License Agreement](https://cla.developers.google.com/).

1. All contributions must be approved by a member of the core contributors group.

> Before we can use your code, you must sign the [Google Individual Contributor License Agreement](https://developers.google.com/open-source/cla/individual?csw=1) (CLA), which you can do online. The CLA is necessary mainly because you own the copyright to your changes, even after your contribution becomes part of our codebase, so we need your permission to use and distribute your code. We also need to be sure of various other things—for instance that you'll tell us if you know that your code infringes on other people's patents. You don't have to sign the CLA until after you've submitted your code for review and a member has approved it, but you must do it before we can put your code into our codebase.
> 
> Contributions made by corporations are covered by a different agreement than the one above, the [Software Grant and Corporate Contributor License Agreement](https://cla.developers.google.com/about/google-corporate).

## Roles

We use GitHub teams to define specific roles for the material-motion organization.

    core-team
    - Admin access to all repos
    - Push rights for stable branches restricted to core-team

    <platform>-regular-contributors
    - Write access to all <platform> repos
    - Push rights for develop branches restricted to relevant -regular-contributors teams

    <platform>-casual-contributors
    - Write access to all <platform> repos
    - No push rights to develop, but able to make branches, triage issues, etc...

    everyone else
    - No write access to any repo, must fork.
    - Able to file issues, but not label them.

### Core contributors

Each core contributor has a specific focus area.

| GitHub Account | Platform |
|:-------|:------|
| [appsforartists](https://github.com/appsforartists) | JavaScript, Web |
| [featherless](https://github.com/jverkoey) | iOS, macOS, project lead |
| [pingpongboss](https://github.com/pingpongboss) | Android |
| [willlarche](https://github.com/willlarche) | iOS |

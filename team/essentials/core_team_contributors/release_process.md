---
layout: page
---

# Release process

Read our release tooling documentation by running:

    mdm help release

## Versioning

Follow strict [semantic versioning](http://semver.org/).

tl;dr `major.minor.patch`.

- If there is a breaking change in any way (i.e. a client has to take some action to upgrade), then the release is **major**.
- If there are no breaking changes but there are new features, then the release is **minor**.
- Otherwise the release is a **patch** release.

Once you know what kind of release it is, increment the relevant number and set all following numbers to zero.

For example, if our last release was 12.5.0 and the next release introduces breaking changes, then the next release is 13.0.0.

We do **not** use our version numbers for marketing purposes. The numbers are strictly used to convey engineering information.

We will find alternative ways to communicate when a library is ready for production use.

## Cutting releases

Our goal is to cut releases early and often. We plan to automate as much of this as possible.

### Frequency

We cut releases on Wednesday of each week.

### Process

We use the `mdm release` toolchain to cut and publish our releases.

Learn more about the tools by reading [the documentation](https://github.com/material-motion/material-motion-team/tree/develop/contributor_tools/release) or by running `mdm help release`.

## Release-blocking clients

A release-blocking client has the power to stop a release.

Our release-blocking clients include:

- Google

Adding a release-blocking client is expensive and is done with great care.

Examples of how a client can block a release:

- We cut a release that we thought was minor, but is in fact major. We identify that it's major because when a release-blocking client upgrades to it, its builds break.

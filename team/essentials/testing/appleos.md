---
layout: page
---

# appleOS

We use Xcode unit tests to test our library code.

## Running tests

Travis CI tests our pull requests.

Regular and core team contributors can use `arc` to run unit tests locally.

    # Run unit tests only if source was affected
    arc unit
    
    # Run all unit tests for everything
    arc unit --everything

## Writing tests

Please follow the conventions defined at [material-motion/material-motion-conventions-objc](https://github.com/material-motion/material-motion-conventions-objc).

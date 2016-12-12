---
layout: page
---

# JavaScript Testing Notes

There are multiple concerns in JavaScript testing: test execution, test assertion, and spying/mocking.  Some libraries do all of them; some focus on just one.

Tools we'll likely use are **highlighted**.

- [JSUnit](https://github.com/pivotal/jsunit)
  - A port of JUnit to JavaScript
  - Does all the things.
  - Old - written before idiomatic JS testing was a thing, and not updated.
    > "JsUnit is not actively developed or supported."
  - Supported internally at Google.
- [Jasmine](http://jasmine.github.io/edge/introduction.html)
  - The original native-to-JavaScript testing framework
  - Does all the things.
  - Popular among older projects.
  - Least modular popular option
    - @traviskaufman uses the example that mocking `requestAnimationFrame` is painful
- **[Ava](https://github.com/avajs/ava)**
  - Test runner with optional assertion library
  - Doesn't pollute global namespace with test methods
  - Runs tests in parallel
  - Can export results to Test Anywhere Protocol for machine consumption
  - Written by @sindresorhus, a frequent collaborator of @addyo
  - Newer than the other popular options - likely in response to things they did less-well (like run tests in serial)
- **[Chai](http://chaijs.com/)**
  - Assertion library
  - Uses object tree format (e.g. `expect(thing).to.equal(otherThing)`)
  - Popular among newer projects (usually paired with Mocha and Sinon)
- [Sinon](http://sinonjs.org/)
  - Spy library
  - @traviskaufman contributes
- [Expect](https://github.com/mjackson/expect)
  - @mjackson got tired of needing separate dependencies for assertions and spies, so he wrote one library that includes both.
  - Assertion methods are in camel-case vs. in an object tree (eg. `toBeEqual` instead of `to.equal`)
- [Mocha](http://mochajs.org/)
  - Test runner, tracks which ones pass/fail
  - Popular with Chai and Karma
  - Runs tests in serial
- [Karma](https://karma-runner.github.io/1.0/index.html)
  - Test harness, opens a bunch of browsers and tracks which ones have problems
  - Written by Angular team
  - Popular paired with Chai, Mocha, and Sinon
- [Tape](https://www.npmjs.com/package/tape)
  - Does all the things.
  - Exports results in [Test Anything Protocol](https://testanything.org/), to be consumed by machines or formatted to be human readable by a separate tool.
  - Simpler/lower level than most options
- [Jest](https://facebook.github.io/jest/)
  - Built by Facebook to run Jasmine tests with automatically-mocked dependencies
  - A quick Google Search makes it look like this magic is a fragile as it sounds.
- [Istanbul](https://github.com/gotwarlost/istanbul)
  - Measures code coverage
  - That's all I know

TODO(appsforartists): 
- Figure out and document the actual structure of this (e.g. `npm run test` will run `ava` which will in turn call `__tests__/**` in each package).  
- Document how to add a test to go along with a new feature/bug fix.
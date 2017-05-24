---
layout: page
---

# Running tests

- Run `yarn run test` from the repository root to run the whole test suite.
- To run only the tests for a single package, `cd` to that package first:

      cd packages/core
      yarn run test
      
# Writing tests

Each source file should have a sibling folder called `__tests__`.  The tests for that file go in that folder.  For instance, the tests for `src/operators/pluck.ts` should be in `src/operators/__tests__/pluck.test.ts`.

Please use the existing tests as reference for how to add new tests.  If you have any questions, [ask us](https://discord.gg/material-motion).

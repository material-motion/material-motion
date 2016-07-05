These commands facilitate the cutting of releases. They represent an overall
process which can be summarized as:

- cut
- test
- merge
- publish

At each phase the release engineer is expected to run the relevant tests.

This process assumes that you are using a `develop`/`stable` branch model
similar to the "git flow" model:
http://nvie.com/posts/a-successful-git-branching-model/

In this model, all development occurs in the `develop` branch. `stable` houses
stable versions of the code. Each commit in stable often has an associated
version tag.

## Cut the release

When a stable release is ready to be cut, a `release-candidate` branch is `cut`
from the latest `origin/develop` commit.

    mdm release cut

## Test the release

The release-candidate is tested. The repository's CHANGELOG.md is updated to
reflect the changes that went in to this release.

## Merge the release

Once the release is tested, it is ready to be merged. By this point you should
know the version number of the release. We recommend following strict semver:
http://semver.org/

    mdm release merge <version>

## Publish the release

At this point `stable` and `develop` are ready to publish. Now is a good time to
perform any final sanity checks.

    mdm release publish <version>

And you're done!

## Commands

Usage: `mdm release cut [--hotfix]`

    Cut a new release from `origin/develop`.
    
    Options:
      --hotfix  Cuts the release candidate from `origin/stable`.

Usage: `mdm release merge <version>`

    Merges the current release-candidate into `stable`.
    
    <version> is the intended version number of the release. This must match the
    latest version number in CHANGELOG.md.
    
    Prerequirements:
    - Ran `mdm release cut`.

Usage: `mdm release publish <version>`

    Publishes the current release to GitHub.
    
    Prerequirements:
    - On the `stable` branch.
    - Ran `mdm release merge <version>`.

Usage: `mdm release abort`

    Aborts an active release.
    
    `This operation is destructive and requires confirmation.`

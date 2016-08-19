# Creating a GitHub repository

GitHub repository creation rights for the `material-motion` org is restricted to a small set of Googlers.

## Create a local repo

We use the `mdm` toolchain to create new GitHub repositories. Before you can publish to GitHub you must create a local git repository:

    mdm new repo material-motion-thing

## Templatize an existing repo

If you already have a git repo on your local machine, then you can apply the GitHub template to the repo by running the following within your git repo:

    yo mm-github

## Publish the repo to GitHub

You now have a git repository fully-configured and ready for initial publication to GitHub.

To publish the repo to GitHub:

    cd $(mdm dir material-motion-thing)
    mdm publish github <repo kind> <org> <repo-name>

## Publish the repo to codereview.cc

This command must be run by an admin of codereview.cc.

    cd $(mdm dir material-motion-thing)
    mdm publish phabricator <repo kind> <org> <repo-name>

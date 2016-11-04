# Mirroring GitBooks to GitHub

We strictly edit our books in the [GitBook](https://www.gitbook.com/) web UI. GitHub is a mirror.

The following commands show how to update the team book, but the steps apply to every book in the [material-motion GitBook organization](https://www.gitbook.com/@material-motion/dashboard).

    # First-time setup
    mkdir team
    cd team
    git init
    git remote add gitbook https://git.gitbook.com/material-motion/material-motion-team.git
    git remote add origin git@github.com:material-motion/material-motion-team.git
    
    # Update the gitbook branches
    git fetch gitbook
    # Enter your GitBook email/password
    
    git checkout -b master origin/master
    git merge --no-ff gitbook/master # Should never conflict
    
    git push origin master

## Cutting releases

TODO: Determine how often we cut releases.
TODO: Determine what we need to communicate in a release cut.

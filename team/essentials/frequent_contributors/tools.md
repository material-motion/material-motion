---
layout: page
---

# Tooling

Our team uses a custom tool called `mdm` to manage our team's tooling. We encourage adding this tool to your PATH so that you can access it from anywhere on your computer:

    git clone --recursive git@github.com:material-motion/material-motion-tools.git
    cd material-motion-tools
    echo "export PATH=$(dirname $(find $(pwd) -regex '.*bin/mdm')):\$PATH"

Add the output path to whichever file your shell uses to configure environment variables. This is often `~/.bash_profile` or `~/.bashrc`.

    # edit ~/.bash_profile
    source ~/.bash_profile

You can now run the `mdm` tool installer like so:

    mdm tools

Or the automated variant:

    mdm tools install

Learn more about each `mdm` command by running `mdm help` or by [reading the docs on GitHub](https://github.com/material-motion/material-motion-tools/tree/develop/contributor_tools).

## Misc tooling notes

Here's a list of tools we currently use as a team:

- [GitBook](https://www.gitbook.com/) for document authoring (like this one!)
- GitHub for code authoring ([material-motion](https://github.com/material-motion) is our org)
- git for all version tracking
- [Phabricator Differential](https://www.phacility.com/phabricator/differential/) for code-review
- The [GitBook mac editor](https://www.gitbook.com/editor/osx) allows you to edit books offline
- [draw.io](https://www.draw.io) for SVG and flow-chart editing

### GitHub

- [Add SSH keys to your GitHub account](https://help.github.com/articles/adding-a-new-ssh-key-to-your-github-account/)
- [Hello world](https://guides.github.com/activities/hello-world/) GitHub guide.

### Android

Versions of software we use:

- Android Studio 2.2 Preview 4

### appleOS

Versions of software we use:

- Objective-C:
- Swift 3.0: 
  - Xcode 8
- Cocoapods 1.0.1
- psych 2.1.0

We use version 2.1.0 of the `psych` gem. This version of `psych` adds quotes to the Podfile.lock after a `pod install`. Older versions removed the quotes.

View your version:

    gem list | grep psych

Update your version:

    xcode-select --install # May need to run this first
    sudo gem update psych

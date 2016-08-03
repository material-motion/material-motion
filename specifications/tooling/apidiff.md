# apidiff

![](../../_assets/apidiff.svg)

## Usage

From a git repo:

    apidiff <old ref> <new ref> apple | diffreport markdown

## Two tools

`apidiff` and `diffreport`.

`apidiff` accepts an old ref, new ref, and engine. It outputs a JSON array of dictionaries.

`diffreport` reads a JSON API diff from stdin. It outputs a formatted version of the API diff.


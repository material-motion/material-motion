---
layout: page
---

# Life of a change

**For frequent and core contributors**.

Frequent and core contributors are expected to use the `arc` command line tool to initiate code review.

Guides on `arc`:

- [arc diff for ubers](http://sectioneight.github.io/arc-diff-for-ubers/#/)

## Prerequisite: install tools

Please follow our [Tools](tools) guide to learn how to install the `mdm` command line tool. This tool provides an easy way to install tools on your computer via `mdm tools`.

## Start a feature branch

The arc workflow begins by creating a git branch.

```bash
arc feature somefeature
```

This is synonymous to

```bash
git checkout -b somefeature
git branch --set-upstream-to origin/develop
```

## Make changes

Commit changes to your feature branch.

## Send your change out for review

We do not push branches to GitHub. We use `arc diff` to send changes out for review via [codereview.cc](http://codereview.cc).

```bash
arc diff
```

## Make changes

You may be asked to make changes to your diff. Commit changes to your branch as you normally would. Run `arc diff` again when you're ready to review the new changes:

```bash
arc diff
```

## Land the diff

Once your diff has been approved you may land the diff. Landing squashes your branch into a single commit, updates the commit with the diff description on codereview.cc, and pushes the commit to origin/develop.

```bash
arc land
```

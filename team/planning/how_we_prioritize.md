---
layout: page
---

# How we prioritize

Prioritization is how we choose what to work on for a given week or day. We make heavy use of GitHub and Discord to communicate our priorities. This allows us to minimize the number of team meetings and encourages autonomy.

## Material Motion milemarker

https://material-motion.github.io/material-motion-milemarker/

This website fetches every material-motion repo and shows their milestones. We use this website to get a high-level overview of the project's status on any given platform.

## What is a project?

Projects == GitHub repos, usually.

For most of our platforms, each "project" maps to a single GitHub repository.

We do make use of [monorepos](http://danluu.com/monorepo/). Monorepos contain many projects. Monorepos make heavy use of `where:` labels to break down project-specific tasks.

## A milestone defines issue priority

Within a given project we use GitHub milestones to define relative issue priority. Issues at the top of the milestone are the most important.

For example, consider the [Runtime v1.0.0 milestone](https://github.com/material-motion/material-motion-runtime-objc/milestone/1):

![]({{ site.url }}/assets/runtime-v1.0.0.png)

In this milestone we can clearly see the work ahead of us and the current status of each issue.

If you'd like to take on a task the rule is simple: **choose any unassigned task near the top of the milestone**.

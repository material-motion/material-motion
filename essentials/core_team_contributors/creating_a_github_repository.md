# Creating a GitHub repository

GitHub repository creation rights for the `material-motion` org is restricted to a small set of Googlers.

We use the `mdm` toolchain to create new GitHub repositories. Before you can publish to GitHub you must create a local git repository:

    mdm new repo material-motion-thing

You now have a git repository fully-configured and ready for initial publication to GitHub.

To publish the repo to GitHub:

    cd $(mdm dir material-motion-thing)
    mdm publish github


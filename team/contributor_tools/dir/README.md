Usage: `mdm dir`

    Output the directory of the repo within which the `mdm`
    command lives.

Usage: `mdm dir <repo>`

    Output the directory for the given repo, if it exists.
    The commands fails with a non-zero exit code otherwise.
    
    Checks adjacent repos for `material-motion-<repo>` or <repo>.
    If <repo> already has a `material-motion-` prefix then
    the prefix is ignored.

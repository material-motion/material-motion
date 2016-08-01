Usage: `mdm open`

    Open the canonical project for the current repo, if one is able
    to be inferred.

Usage: `mdm open <repo>`

    Open the canonical project for the given repo, if one is able
    to be inferred.

How the canonical project is inferred:

    If a Podfile exists, runs `pod install` and opens the root
    xcworkspace.

Usage: `mdm sprint current`

    Output the path to the current sprint, if one exists.

Usage: `mdm sprint open`

    Open the current sprint in a web browser, if one exists.

Usage: `mdm sprint start`

    Creates a new sprint if no sprint is currently active.

Usage: `mdm sprint finish`

    To be invoked at the end of a sprint. Does the following:
    
    1. Move any closed issue to the Done column in the current sprint.
    2. Create an archive project with a single Done column.
    3. Move all cards in the current sprint's Done column to the archive project's Done column.

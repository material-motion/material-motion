Usage: `mdm clone repo <filter>`

    Clone all material-motion repos matching <filter>, where <filter>
    is a `grep` filter.
    
    Clone the milemarker repo:
    `mdm clone repo milemarker`
    
    Clone all android platform repos:
    `mdm clone repo "android"`
    
    Clone all apple platform repos:
    `mdm clone repo "objc\|swift"`

Usage: `mdm clone temp <ref>`

    Create a temporary clone of the current git repository at
    the provided ref. The temporary path will be written to stdout.

# appleOS

## Code style: Objective-C

We use clang-format to automatically format our Objective-C code. See the .clang-format file contained at the root of any Objective-C repository for the set of options we use.

## File system structure

We use a file system convention based on [Google's GOS-conventions.](https://github.com/google/GOS-conventions) At this time, all files should be prefixed with 'MDM.'

## Supported Swift version

We use Swift 3 for all unit tests and examples.

Our core libraries are written in Objective-C.

## Prefixes

`MDM` is our API prefix.

Add the prefix to any API included in one of our libraries. This includes any class, function, enumeration, etc... contained in a `src/` directory. E.g. `MDMRuntime`.

Non-library code has no prefix. This includes anything in an `examples/` or `tests/` directory. E.g. `SomeDemoController`.

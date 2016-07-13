# appleOS

## Code style: Objective-C

We use clang-format to automatically format our Objective-C code. See the .clang-format file contained at the root of any Objective-C repository for the set of options we use.

## File system structure

We use a file system convention based on [Google's GOS-conventions.](https://github.com/google/GOS-conventions) At this time, all files should be prefixed with 'MDM.'

## Supported Swift version

We will be supporting Swift 2.3 in all of our core examples until Swift 3 is officially released. To set a project's Swift version, please include the following in a `Podfile`:

    post_install do |installer|
      installer.pods_project.targets.each do |target|
        target.build_configurations.each do |config|
          config.build_settings['SWIFT_VERSION'] = '2.3'
        end
      end
    end

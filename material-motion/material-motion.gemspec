# coding: utf-8

Gem::Specification.new do |spec|
  spec.name          = "material-motion"
  spec.version       = "0.1.0"
  spec.authors       = ["Jeff Verkoeyen"]
  spec.email         = ["featherless@google.com"]

  spec.summary       = "Material Motion Jekyll theme."
  spec.homepage      = "https://github.com/material-motion."
  spec.license       = "MIT"

  spec.files         = `git ls-files -z`.split("\x0").select { |f| f.match(%r{^(assets|_layouts|_includes|_sass|LICENSE|README)}i) }

  spec.add_development_dependency "jekyll", "~> 3.3"
  spec.add_development_dependency "bundler", "~> 1.12"
  spec.add_development_dependency "rake", "~> 10.0"
end

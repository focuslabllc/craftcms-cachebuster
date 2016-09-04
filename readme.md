# Cache Buster

A Craft plugin that adds a simple cache buster to your flat file references.


## Installation

- Move the `cachebuster` directory into your project's `craft/plugins` directory.
- Navigate to `Settings > Plugins` page in your Craft admin area and install **Cache Buster**.
- [Rejoice](https://www.youtube.com/watch?v=NmPhaG1ud38) that installation is simple.


## What

This plugin will take a file path and check the modification time returning a cache busting string. It's not the absolute best way to use cache busting files (for that, look into _revving files_), but it's effective, simple, and quick.


## How

You have 3 options for creating cache busting file paths. They're all the same result. It's just a matter of which style you prefer. They are:

**The Craft Variable**

	{{ craft.cacheBuster.bust('/css/site.css') }}

**The Twig Filter**

	{{ '/css/site.css' | cacheBuster }}

**The Twig Function**

	{{ cacheBuster('/css/sites.css') }}

These will all return something like

	/css/style.css?v=1472591574

Where `1472591574` is the UNIX timestamp of the last time `/css/style.css` was saved to the server.

### Options

You can change the separator between the file and the timestamp by passing an argument through any of these code examples. They would then respectively look something like this:

	{{ craft.cacheBuster.bust('/css/site.css', 'bustIt=') }}

	{{ '/css/site.css' | cacheBuster('bustIt=') }}

	{{ cacheBuster('/css/site.css', 'bustIt=') }}

These will all return something like

	/css/style.css?bustIt=1472591574

## Change Log

**Sept 3rd, 2016: 1.0.0**

- Initial Release
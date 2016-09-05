# Cache Buster

A Craft plugin that adds a simple cache buster to your flat file references.


## Installation

- Move the `cachebuster` directory into your project's `craft/plugins` directory.
- Navigate to `Settings > Plugins` page in your Craft admin area and install **Cache Buster**.
- [Rejoice](https://www.youtube.com/watch?v=NmPhaG1ud38) that installation is simple.


## Using the Cache Buster Plugin

There are a few ways you can use this plugin. At it's simplest, you can just pass your asset files through Twig and a cache busting query string will magically appear. That's it. No setup. If that sounds good look at the **Auto Query String** section below.

If you'd like to use a single query string to bust your cache, you'll want to use the **Manual Query String** section below. This is useful if you want to use something a commit hash (or substring) for all of your cache busting.

Lastly, if you already rev your files before deploying them, you can check out the **Revved Files Manifest** section below. This is the recommended route, but only if you kinda already know what it means. ([Click here to learn a bit about it.](https://www.stevesouders.com/blog/2008/08/23/revving-filenames-dont-use-querystring/))

- - -
 
## Auto Query String

You have 3 options for creating cache busting file paths. They're all the same result. It's just a matter of which style you prefer. They are:

**The Craft Variable**

```twig
{{ craft.cacheBuster.bust('/css/site.css') }}
````

**The Twig Filter**

```twig
{{ '/css/site.css' | cacheBuster }}
```

**The Twig Function**

```twig
{{ cacheBuster('/css/sites.css') }}
```

These will all return something like

```html
/css/style.css?v=1472591574
```

Where `1472591574` is the UNIX timestamp of the last time `/css/style.css` was saved to the server.

### Options

You can change the separator between the file and the timestamp by passing an argument through any of these code examples. They would then respectively look something like this:

```twig
{{ craft.cacheBuster.bust('/css/site.css', 'bustIt=') }}

{{ '/css/site.css' | cacheBuster('bustIt=') }}

{{ cacheBuster('/css/site.css', 'bustIt=') }}
```

These will all return something like

```html
/css/style.css?bustIt=1472591574
```

## Manual Query String

To configure Cache Buster to use the same query string for all cache busting, you just need to add a simple config item to your setup.

1. Use the same exact Twig tags mentioned in the **Simple Query String** section above
2. Create a new file called `craft/config/cachebuster.php`
2. Return an array with the key `queryString`
3. That's it!

Your complete file might look something like this:

```php
<?php

return array(
	'queryString'   => 'ad7f89'
);
```

You can also adjust this config file to support [multiple environments](https://craftcms.com/docs/multi-environment-configs) in the same way you might do so with your Craft config.


## Revved Files Manifest

This is the best option in terms of loading time. It takes a bit more setup and we (Focus Lab) don't intend to support your learning curve in terms of revving files as a whole. For that you can use the trusty Google and Stack Overflow.

Assuming you already have files being revved, and are generating some type of manifest json of your files, you will want to do the following:

1. Use the same exact Twig tags mentioned in the **Simple Query String** section above
2. Create a new file called `craft/config/cachebuster.php`
2. Return an array with the key `assetManifest` and a value pointing to your `.json` file
3. That's it!

Cache Buster uses the name of your original file as the `key` when using a manifest json object. So if your original working front-end file is located at `/css/site.css` your manifest would include it like this:

```json
{
	"/css/site.css": "/css/site.12345.css"
}
```

And you would reference this in your front-end with one of the three samples from the **Simple Query String** section.

```twig
{{ craft.cacheBuster.bust('/css/site.css') }}

{{ '/css/site.css' | cacheBuster }}

{{ cacheBuster('/css/site.css') }}
```

Each of these will respect your manifest. If for any reason Cache Buster can't find a `key` matching the file provided in the template, it moves to the **Manual Query String** option. If you haven't defined a `queryString` config setting, then Cache Buster falls back to the **Auto Query String** method.

So no matter what you get a cache busted asset served.



## Change Log

**Sept 5th, 2016: 1.1.0**

- Added support for flat file manifests for those revving files. No query string needed with this approach.
- Added support for using a consistent query string for all cache busting (like a git commit hash/substring).

**Sept 3rd, 2016: 1.0.0**

- Initial Release

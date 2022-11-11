# WordPress Plugin Resulta-CC (Resulta Code Challenge)

A standardized, organized, object-oriented foundation for building high-quality WordPress Plugins.

## Contents

The WordPress Plugin Resulta-CC includes the following files:

* `README.md`. The file that you’re currently reading.
* A `resulta-cc` directory that contains the source code - a fully executable WordPress plugin.

## Features

### Problem

* There is a dire need of displaying NFL teams data fetched from a remote API. That data has dynamic fields and information.
* The information should be displayed in a format easy to look at and understad.
* All the columns are equally important.
### Solution

* This plugin povide a shortcode which can be added anywhere in wordpress(posts,pages). It shows the NFL team data fectched from Remote * API in two representaions.
> Graphical
> Tabular

* You will have a setting menu for this on admin side
* In the menu "NFL Teams".
* From the main menu you can see setting for 

* Info Header Background Color	(color picker)
* Show Graphical Representation	(YES and NO) in dropdown
* Shortcode                       This is just to show the shortcode need to add to page or post to see this functionality

### Structure
* The Resulta-CC Plugin is based on the [Plugin API](http://codex.wordpress.org/Plugin_API), [Coding Standards](http://codex.wordpress.org/WordPress_Coding_Standards), and [Documentation Standards](https://make.wordpress.org/core/handbook/best-practices/inline-documentation-standards/php/).
* All classes, functions, and variables are documented so that you know can understand the architecture.
* The Resulta-CC Plugin uses a strict file organization scheme that corresponds both to the WordPress Plugin Repository structure, and that makes it easy to organize the files that compose the plugin.

## Installation

The Resulta-CC Plugin can be installed directly into your plugins folder "as-is". 


## License

The WordPress Plugin Resulta-CC Plugin is licensed under the GPL v2 or later.

> This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License, version 2, as published by the Free Software Foundation.

> This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

> You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA

A copy of the license is included in the root of the plugin’s directory. The file is named `LICENSE`.

## Important Notes

### Licensing

The WordPress Plugin Resulta-CC Plugin is licensed under the GPL v2 or later; however, if you opt to use third-party code that is not compatible with v2, then you may need to switch to using code that is GPL v3 compatible.

For reference, [here's a discussion](http://make.wordpress.org/themes/2013/03/04/licensing-note-apache-and-gpl/) that covers the Apache 2.0 License used by [Bootstrap](http://twitter.github.io/bootstrap/).

### Includes

Note that if you include your own classes, or third-party libraries, there are three locations in which said files may go:

* `resulta-cc/includes` is where functionality shared between the admin area and the public-facing parts of the site reside
* `resulta-cc/admin` is for all admin-specific functionality
* `resulta-cc/public` is for all public-facing functionality


### What About Other Features?

The previous version of the WordPress Plugin Resulta-CC Plugin included support for a number of different projects such as the [GitHub Updater](https://github.com/afragen/github-updater).

These tools are not part of the core of this Resulta-CC Plugin, as I see them as being additions, forks, or other contributions to the Resulta-CC Plugin.

The same is true of using tools like Grunt, Composer, etc. These are all fantastic tools, but not everyone uses them. In order to  keep the core Resulta-CC Plugin as light as possible, these features have been removed and will be introduced in other editions, and will be listed and maintained on the project homepage.

# Credits

The WordPress Plugin Resulta-CC was started in 2022 by [Saba Shahbaz](https://www.linkedin.com/in/sabashahbaz/) in response to a code challenge given by Resulta to assess the Technical Skills for opportunity of a Team lead in the company.

.

## Documentation, FAQs, and More

If you want to know more please [let me know](https://www.linkedin.com/in/sabashahbaz/, saba.shabazkhan@gmail.com) .

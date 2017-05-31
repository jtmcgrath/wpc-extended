# WordPress Customizer with Sass

An experimental plugin which allows user settings in the WordPress Customizer to automatically compile into css via Sass.

This plugin also provides a simplified interface for adding and updating the Customizer, and is bundled with several custom controls and shorthands to make life easier. Check out the [Controls](https://github.com/jtmcgrath/wpcsass/wiki/Controls) page in the wiki for screenshots and more details.

## Getting Started

These instructions will get you a copy of the project up and running on your local machine for development and testing purposes. *Note that WPCSass has not been tested thoroughly, and is not intended for production use at present.*

### Installation

By default, the plugin looks for a file located at `theme_directory/sass/style.scss` as its entry point, and stores the temporary compiled css into a file located at `theme_directory/sass_output/style.css`. The files are generated automatically, so for the basic setup you only need to carry out these steps:

1. Install and activate the plugin.
2. Add the following subdirectories to your theme's directory:
```
/sass/
/sass_output/
```
3. Create a `style.scss` file in the `/sass/` folder.
4. Add your theme's metadata to the top of the `style.scss` file (either directly or via an `@import` statement).
5. Create your Scss as desired.
6. Add options to the Customizer.
	- [Comprehensive Example](https://github.com/jtmcgrath/wpcsass/wiki/Comprehensive-Example) for testing.
 	- [Options Documentation](https://github.com/jtmcgrath/wpcsass/wiki/Options).

## Built With

- [SCSSPHP](https://github.com/leafo/scssphp) - SCSS compiler written in PHP.
- [Alpha Color Picker](https://github.com/BraadMartin/components/tree/master/customizer/alpha-color-picker) - Alpha colour picker Customizer control.

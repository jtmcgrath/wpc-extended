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
6. [Add options to the Customizer as described on the Options wiki page](https://github.com/jtmcgrath/wpcsass/wiki/Options).
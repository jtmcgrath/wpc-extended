This experimental plugin allows user settings in the WordPress Customizer to automatically compile into css via Sass.

**_Note that WPCSass has not been tested thoroughly, and is not intended for production use at present._**

***

### How It Works

Once set up, this plugin passes WordPress Customizer variables directly to Sass. It triggers a Sass recompile whenever an option has been changed, with the recompiled css stored in a temporary folder. This allows the new settings to be visible within the customizer preview but not on the live site.

When you click the `Save & Publish` button in the Customizer, the plugin pushes the changed css live by replacing the theme's stylesheet with the newly compiled css.

The plugin copies the previous version of the stylesheet as a backup. The number of backups is customisable; the default quantity is 1.

***

### Contents

1. [Default Configuration](https://github.com/jtmcgrath/wpcsass/wiki/Default-Configuration)
2. [Settings](https://github.com/jtmcgrath/wpcsass/wiki/Settings)
   - [Set Sass Template Directory](https://github.com/jtmcgrath/wpcsass/wiki/Settings#set-sass-template-directory)
   - [Set Sass Template Directory URI](https://github.com/jtmcgrath/wpcsass/wiki/Settings#set-sass-template-directory-uri)
   - [Set Sass Input Directory](https://github.com/jtmcgrath/wpcsass/wiki/Settings#set-sass-input-directory)
   - [Set Sass Entry Point](https://github.com/jtmcgrath/wpcsass/wiki/Settings#set-sass-entry-point)
   - [Set Sass Output Directory](https://github.com/jtmcgrath/wpcsass/wiki/Settings#set-sass-output-directory)
   - [Set Sass Vardump](https://github.com/jtmcgrath/wpcsass/wiki/Settings#set-sass-vardump)
   - [Set Sass Output](https://github.com/jtmcgrath/wpcsass/wiki/Settings#set-sass-output)
   - [Set Live Stylesheet](https://github.com/jtmcgrath/wpcsass/wiki/Settings#set-live-stylesheet)
   - [Set CSS Backup Quantity](https://github.com/jtmcgrath/wpcsass/wiki/Settings#set-css-backup-quantity)
3. [Options](https://github.com/jtmcgrath/wpcsass/wiki/Options)
   - [Basics](https://github.com/jtmcgrath/wpcsass/wiki/Options#basics)
   - [Add Panel](https://github.com/jtmcgrath/wpcsass/wiki/Options#add-panel)
   - [Add Panels](https://github.com/jtmcgrath/wpcsass/wiki/Options#add-panels)
   - [Add Section](https://github.com/jtmcgrath/wpcsass/wiki/Options#add-section)
   - [Add Sections](https://github.com/jtmcgrath/wpcsass/wiki/Options#add-sections)
   - [Add Setting](https://github.com/jtmcgrath/wpcsass/wiki/Options#add-setting)
   - [Add Settings](https://github.com/jtmcgrath/wpcsass/wiki/Options#add-settings)
   - [Add Shorthand](https://github.com/jtmcgrath/wpcsass/wiki/Options#add-shorthand)
   - [Options Usage](https://github.com/jtmcgrath/wpcsass/wiki/Options#options-usage)
4. [Using Settings In Theme Files](https://github.com/jtmcgrath/wpcsass/wiki/Using-Settings-In-Theme-Files)
   - [Get Setting](https://github.com/jtmcgrath/wpcsass/wiki/Using-Settings-In-Theme-Files#get-setting)
   - [Get Settings](https://github.com/jtmcgrath/wpcsass/wiki/Using-Settings-In-Theme-Files#get-settings)
   - [Get Path](https://github.com/jtmcgrath/wpcsass/wiki/Using-Settings-In-Theme-Files#get-path)
6. [Controls](https://github.com/jtmcgrath/wpcsass/wiki/Controls)
   - [Inherit](https://github.com/jtmcgrath/wpcsass/wiki/Controls#inherit)
   - [Presentation](https://github.com/jtmcgrath/wpcsass/wiki/Controls#presentation) *- [Title](https://github.com/jtmcgrath/wpcsass/wiki/Controls#title), [Description](https://github.com/jtmcgrath/wpcsass/wiki/Controls#description), [Subtitle](https://github.com/jtmcgrath/wpcsass/wiki/Controls#subtitle)*
   - [Range](https://github.com/jtmcgrath/wpcsass/wiki/Controls#range)
   - [Radio](https://github.com/jtmcgrath/wpcsass/wiki/Controls#radio)
   - [Section Shorthands](https://github.com/jtmcgrath/wpcsass/wiki/Controls#section-shorthands) *- [Background Section](https://github.com/jtmcgrath/wpcsass/wiki/Controls#background-section), [Border Section](https://github.com/jtmcgrath/wpcsass/wiki/Controls#border-section), [Typography Section](https://github.com/jtmcgrath/wpcsass/wiki/Controls#typography-section)*
   - [Alpha Colour](https://github.com/jtmcgrath/wpcsass/wiki/Controls#alpha-colour)
   - [Standard Controls](https://github.com/jtmcgrath/wpcsass/wiki/Controls#standard-controls) *- [Colour](https://github.com/jtmcgrath/wpcsass/wiki/Controls#colour), [Text](https://github.com/jtmcgrath/wpcsass/wiki/Controls#text), [Checkbox](https://github.com/jtmcgrath/wpcsass/wiki/Controls#checkbox), [Select](https://github.com/jtmcgrath/wpcsass/wiki/Controls#select), [Textarea](https://github.com/jtmcgrath/wpcsass/wiki/Controls#textarea), [Image](https://github.com/jtmcgrath/wpcsass/wiki/Controls#image)*
7. [Sass Vardump](https://github.com/jtmcgrath/wpcsass/wiki/Sass-Vardump)
8. [Comprehensive Example](https://github.com/jtmcgrath/wpcsass/wiki/Comprehensive-Example)
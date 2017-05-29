# WordPress Customizer with Sass

This experimental plugin allows user settings in the WordPress Customizer to automatically compile into css via Sass.

**_Note that WPCSass has not been tested thoroughly, and is not intended for production use at present._**

## Contents

1. [How It Works](#how-it-works)
2. [Default Configuration](#default-configuration)
3. [Changing Settings](#changing-settings)
   - [Set Sass Input Directory](#set-sass-input-directory)
   - [Set Sass Entry Point](#set-sass-entry-point)
   - [Set Sass Output Directory](#set-sass-output-directory)
   - [Set Sass Vardump](#set-sass-vardump)
   - [Set Sass Output](#set-sass-output)
   - [Set Live Stylesheet](#set-live-stylesheet)
   - [Set CSS Backup Quantity](#set-css-backup-quantity)
4. [Options](#options)
   - [Basics](#basics)
   - [Add Panel](#add-panel)
   - [Add Panels](#add-panels)
   - [Add Section](#add-section)
   - [Add Sections](#add-sections)
   - [Add Setting](#add-setting)
   - [Add Settings](#add-settings)
   - [Add Shorthand](#add-shorthand)
   - [Options Usage](#options-usage)
5. [Using Settings In Theme Files](#use-settings-in-theme-files)
6. [Available Controls](#available-controls)
   - [Inherit](#inherit)
   - [Presentation](#presentation) *- [Title](#title), [Description](#description), [Subtitle](#subtitle)*
   - [Range](#range)
   - [Radio](#radio)
   - [Section Shorthands](#section-shorthands) *- [Background Section](#background-section), [Border Section](#border-section), [Typography Section](#typography-section)*
   - [Alpha Colour](#alpha-colour)
   - [Standard Controls](#standard-controls) *- [Colour](#colour), [Text](#text), [Checkbox](#checkbox), [Select](#select), [Textarea](#textarea), [Image](#image)*
7. [Sass Vardump](#sass-vardump)
8. [Comprehensive Example usage](#comprehensive-example-usage)

## How It Works

Once set up, this plugin passes WordPress Customizer variables directly to Sass. It triggers a Sass recompile whenever an option has been changed, with the recompiled css stored in a temporary folder. This allows the new settings to be visible within the customizer preview but not on the live site.

When you click the `Save & Publish` button in the Customizer, the plugin pushes the changed css live by replacing the theme's stylesheet with the newly compiled css.

The plugin copies the previous version of the stylesheet as a backup. The number of backups is customisable; the default quantity is 1.

## Default Configuration

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
6. [Add options to the Customizer as described below](#options).

## Changing Settings

You can change several settings to customise the plugin. These are all method calls which change variables within the WPC_Sass object in order to change its behaviour.

### Set Sass Input Directory

This setting controls the location of the directory which contains your non-compiled `scss` files.

*Default*
```
stylesheet_directory/sass/
```

*Method*
```php
$wpcsass->set_sass_input_directory( $directory );
```

*Example*
```php
$wpcsass->set_sass_input_directory( get_stylesheet_directory() . '/sass/' );
```

### Set Sass Entry point

This setting controls the entry point filename which the Sass compiler looks for within the *Sass input directory*.

*Default*
```
style.scss
```

*Method*
```php
$wpcsass->set_sass_entry_point( $filename );
```

*Example*
```php
$wpcsass->set_sass_entry_point( 'style.scss' );
```

### Set Sass Output Directory

This setting controls the location of the directory into which the plugin places the generated `css` files.

*Default*
```
stylesheet_directory/sass_output/
```

*Method*
```php
$wpcsass->set_sass_output_directory( $directory );
```

*Example*
```php
$wpcsass->set_sass_output_directory( get_stylesheet_directory() . '/sass_output/' );
```

### Set Sass Vardump

This setting controls the file location of the Sass vardump file. [Click here for a brief explanation of this file.](#sass-vardump)

*Default*
```
stylesheet_directory/sass/_customizer_variables.scss
```

*Method*
```php
$wpcsass->set_sass_vardump( $file );
```

*Example*
```php
$wpcsass->set_sass_vardump( get_stylesheet_directory() . '/sass/_customizer_variables.scss' );
```

### Set Sass Output

This setting controls the file location of the main output file which the plugin generates.

*Default*
```
stylesheet_directory/sass_output/style.css
```

*Method*
```php
$wpcsass->set_sass_output( $file );
```

*Example*
```php
$wpcsass->set_sass_output( get_stylesheet_directory() . '/sass_output/style.css' );
```

### Set Live Stylesheet

This setting controls the location of the live css file which the plugin overwrites when saving.

*Default*
```
stylesheet_directory/style.css
```

*Method*
```php
$wpcsass->set_live_stylesheet( $file );
```

*Example*
```php
$wpcsass->set_live_stylesheet( get_stylesheet_directory() . '/style.css' );
```

### Set CSS Backup Quantity

This setting controls the number of backup copies of the `style.css` file that the plugin generates.

*Default*
```
1
```

*Method*
```php
set_css_backup_quantity( $quantity );
```

*Example*
```php
set_css_backup_quantity( 3 );
```

## Options

### Basics

To add settings, you need to create an instance of the `WPC_Sass` class, and then add settings to the object. An empty example of what this should look like:

```php
if ( class_exists( 'WPC_Sass' ) ) :
	$wpcsass = new WPC_Sass;

	// New settings are added here

endif;
```

### Add Panel

Adds or updates a Customizer panel.

*Method*
```php
$wpcsass->add_panel( $panel_id, $priority, $title );
```

*Example*
```php
$wpcsass->add_panel( 'custom_panel', 50, 'Custom Panel' );
```

### Add Panels

Adds or updates multiple Customizer panels.

*Method*
```php
$wpcsass->add_panels( $panels );
```

*Example*
```php
$wpcsass->add_panels( array(
	'custom_panel' => array( 50, 'Custom Panel' ),
	'another_custom_panel' => array( 60, 'AnotherCustom Panel' )
) );
```

### Add Section

Adds or updates a Customizer section.

*Method*
```php
$wpcsass->add_section( $section_id, $priority, $title, $panel_id );
```

*Example*
```php
$wpcsass->add_section( 'custom_section', 50, 'Test Section', 'custom_panel' );
```

### Add Sections

Adds or updates multiple Customizer sections.

*Method*
```php
add_sections( $sections );
```

*Example*
```php
$wpcsass->add_sections( array(
	'custom_section' => array( 50, 'Test Section', 'custom_panel' ),
	'another_custom_section' => array( 60, 'Test Section', 'custom_panel' )
) );
```

### Add Setting

Adds or updates an existing setting. See below for which `$data` is required for each type of setting.

*Method*
```php
$wpcsass->add_setting( $setting_id, $data );
```

*Example*
```php
$wpcsass->add_setting( 'colour', array(
	'label'   => 'Colour',
	'section' => 'custom_section',
	'type'    => 'colour',
	'default' => #444
) );
```

### Add Settings

Adds or updates multiple settings.

*Method*
```php
$wpcsass->add_settings( $settings );
```

*Example*
```php
$wpcsass->add_settings( array(
	'colour', array(
		'label'   => 'Colour',
		'section' => 'custom_section',
		'type'    => 'colour',
		'default' => #444
	),
	'text', array(
		'label'   => 'Text',
		'section' => 'custom_section',
		'type'    => 'text',
		'default' => 'something'
	)
) );
```

### Add Shorthand

Adds or updates a section shorthand.

*Method*
```php
$wpcsass->add_shorthand( $shorthand_id, $data );
```

*Example*
```php
$wpcsass->add_shorthand(
	'border_section',
	array(
		'_borderwidth' => array(
			'label'   => 'Width',
			'type'    => 'range',
			'default' => '0',
			'units'   => 'px',
			'range'   => array(
				'min'  => '0',
				'max'  => '10',
				'step' => '1'
			)
		),
		'_bordercolor' => array(
			'label'     => 'Color',
			'type'      => 'color'
		),
		'_borderstyle' => array(
			'label'   => 'Style',
			'type'    => 'radio',
			'default' => 'solid',
			'choices' => array(
				'none'   => 'None',
				'dotted' => 'Dotted',
				'dashed' => 'Dashed',
				'solid'  => 'Solid',
				'double' => 'Double',
				'groove' => 'Groove',
				'ridge'  => 'Ridge',
				'inset'  => 'Inset',
				'outset' => 'Outset'
			)
		),
		'_borderradius' => array(
			'label'   => 'Radius',
			'type'    => 'range',
			'default' => '0',
			'units'   => 'px',
			'range'   => array(
				'min'  => '0',
				'max'  => '10',
				'step' => '1'
			)
		)
	)
);
```

### Options Usage

Combining all the above, a simple example would be:

```php
if ( class_exists( 'WPC_Sass' ) ) :
	$wpcsass = new WPC_Sass;

	$wpcsass->add_panel( 'custom_panel', 50, 'Custom Panel' );
	$wpcsass->add_section( 'custom_section', 50, 'Test Section', 'custom_panel' );
	$wpcsass->add_settings( array(
		'colour', array(
			'label'   => 'Colour',
			'section' => 'custom_section',
			'type'    => 'colour',
			'default' => #444
		),
		'text', array(
			'label'   => 'Text',
			'section' => 'custom_section',
			'type'    => 'text',
			'default' => 'something'
		)
	) );
endif;
```

## Using Settings In Theme Files

In addition to using settings in your Sass files, you can also use them in your theme's php files.

*Method*
```php
$wpcsass->get_setting( $setting_id );
```

*Example*
```php
$wpcsass->get_setting( 'my_setting' );
```

## Available Controls

In addition to the default controls, the plugin includes several custom controls plus a shortcut for creating a comprehensive set of background controls via a single setting. All of the available controls are described below.

### Inherit

The `inherit` setting lets you create a setting which can be set to copy the value of *another* setting.

As an example, many themes would include two main colours which would be used consistently throughout the theme - a `primary` colour and a `secondary` colour. One major downside to the Customizer is that it doesn't support this concept; you would have to enter these colours separately into wherever they are meant to be used.

With the `inherit` setting, you can do this easily. You simply add an `array` to your setting's options containing a list of the settings you want it to be able to reference, and the plugin handles everything for you. It displays the available inherit options as a set of radio buttons, plus a "Custom" option which reveals a separate control when selected which allows the user to specify a non-inherited value.

The `inherit` setting can be added to any of the controls listed below except the `Section Shorthands`. The array can contain any number of settings.

![Inherit](http://i.imgur.com/uWaSbvi.png)

Setting only:

```php
'inherit' => array(
	'primary_colour'   => 'Primary',
	'secondary_colour' => 'Secondary'
)
```

Full example:

```php
'setting_id' => array(
	'label'   => 'Custom Setting',
	'section' => 'custom_section',
	'type'    => 'colour',
	'default' => '#444',
	'inherit' => array(
		'primary_colour'   => 'Primary',
		'secondary_colour' => 'Secondary'
	)
)
```

### Presentation

This custom control allows you to add presentational text into the layout of the Customizer. It comes in three flavours: **Title**, **Subtitle**, and **Description**.

![Presentation Controls](http://i.imgur.com/XdTG54h.png)

#### Title

Adds a stylised `<h1>` tag containing a label.

```php
'title_setting' => array(
	'label'   => 'Example Title',
	'section' => 'custom_section',
	'type'    => 'title'
)
```

#### Subtitle

Adds a stylised `<h3>` tag containing a label.

```php
'subtitle_setting' => array(
	'label'   => 'Example Subtitle',
	'section' => 'custom_section',
	'type'    => 'subtitle'
)
```

#### Description

Adds a `<p>` tag containing text.

```php
'description_setting' => array(
	'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
	'section'     => 'custom_section',
	'type'        => 'description'
)
```

### Range

The range control allows you to create a slider with minimum and maximum values. It includes a label which displays the current value. You can also click on the label itself and manually type in the number you want.

![Range Control](http://i.imgur.com/fQzrQqW.png)

```php
'range_setting' => array(
	'label'   => 'Range',
	'section' => 'custom_section',
	'type'    => 'range',
	'default' => '3',
	'units'   => 'px',
	'range'   => array(
		'min'  => '0',
		'max'  => '20',
		'step' => '1'
	)
)
```

### Radio

The radio control adds some cleaner presentation to the typical radio functionality. Options are wrapped intelligently, showing either two or three per line depending on the total number. The labels are styled to match the Customizer's button style, with the addition of a checkmark on the selected option.

![Radio Control](http://i.imgur.com/LGa1SB9.png)

```php
'radio_setting_3' => array(
	'label'   => 'Radio 3',
	'section' => 'custom_section',
	'type'    => 'radio',
	'choices' => array(
		'a' => 'Option A',
		'b' => 'Option B',
		'c' => 'Option C',
		'd' => 'Option D'
	)
)
```

### Section Shorthands

The background, border, and typography sections are all shorthands which allow you to add multiple connected controls without typing them all in manually.

#### Background Section

A background section includes a colour control, an image control, and several radio controls. The radio controls are only visible when an image has been selected, because they control the `background-repeat`, `background-position`, `background-attachment`, and `background-size` properties.

*Note: the background colour control can use either the default or the alpha colour picker.*

![Background Section](http://i.imgur.com/oWpje8n.png)

```php
'background_setting' => array(
	'label'   => 'Background',
	'section' => 'custom_section',
	'type'    => 'background_section',
	'alpha'   => true,
	'default' => '#444'
)
```

#### Border Section

A border section includes `border-width`, `border-color`, `border-style`, and `border-radius` controls. The `border-color` and `border-style` controls are hidden when the `border-width` control equals `0`.

![Border Section](http://i.imgur.com/UMDODqk.png)

```php
'border_setting' => array(
	'label'   => 'Border',
	'section' => 'custom_section',
	'type'    => 'border_section',
	'default' => #444
)
```

#### Typography Section

A typography section includes `font-family`, `font-size`, `font-style`, `font-weight`, and `line-height` controls.

![Typography Section](http://i.imgur.com/wCIDsaP.png)

```php
'typography_setting' => array(
	'label'   => 'Typography',
	'section' => 'custom_section',
	'type'    => 'typography_section'
)
```

### Alpha Colour

The alpha colour control was created by Braad Martin, [and is available on GitHub](https://github.com/BraadMartin/components/tree/master/customizer/alpha-color-picker). It works almost exactly the same as the standard colour control, but with an added transparency option.

![Alpha Colour Control](http://i.imgur.com/OBTRHFo.png)

```php
'alpha_setting' => array(
	'label'   => 'Alpha Colour',
	'section' => 'custom_section',
	'type'    => 'colour',
	'alpha'   => true,
	'default' => '#444'
)
```

### Standard Controls

The standard Customizer controls are also available.

![Standard Controls](http://i.imgur.com/TP834Nr.png)

#### Colour

```php
'colour_setting' => array(
	'label'   => 'Standard Colour',
	'section' => 'custom_section',
	'type'    => 'colour',
	'default' => '#444'
)
```

#### Text

```php
'text_setting' => array(
	'label'   => 'Text',
	'section' => 'custom_section',
	'type'    => 'text',
	'default' => 'default'
)
```

#### Checkbox

```php
'checkbox_setting' => array(
	'label'   => 'Checkbox',
	'section' => 'custom_section',
	'type'    => 'checkbox'
)
```

#### Select

```php
'select_setting' => array(
	'label'   => 'Select',
	'section' => 'custom_section',
	'type'    => 'select',
	'choices' => array(
		'a' => 'Option A',
		'b' => 'Option B',
		'c' => 'Option C'
	)
)
```

#### Textarea

```php
'textarea_setting' => array(
	'label'   => 'Textarea',
	'section' => 'custom_section',
	'type'    => 'textarea'
)
```

#### Image

```php
'image_setting' => array(
	'label'   => 'Image',
	'section' => 'custom_section',
	'type'    => 'image'
)
```

## Sass Vardump

The Sass vardump is a generated file which contains every Sass variable and value passed from the Customizer into Sass. The Sass compiler does not normally display the available variables, so this vardump acts as a convenient cheat-sheet for easy reference when developing themes.

It also includes every `title` and `subtitle` custom control as comments, which helps break down the sections appropriately.

The [Comprehensive Example Usage](#comprehensive-example-usage) below will output the following Sass Vardump file:

```

// Title
// Subtitle

// Range Control
$range: 15px;

// Radio Control
$radio_1: a;
$radio_2: a;
$radio_3: a;
$radio_4: a;

// Alpha Colour Control
$alpha_colour: #444444;

// Standard Controls
$colour: #444;
$text: default;
$checkbox: true;
$select: a;
$textarea: '';
$image: '';

// Background Section
$background_section_bgcolor: '';
$background_section_bgimage: '';
$background_section_bgrepeat: no-repeat;
$background_section_bgposition: center;
$background_section_bgattachment: scroll;
$background_section_bgsize: cover;

// Border Section
$border_section_borderwidth: 0px;
$border_section_bordercolor: '';
$border_section_borderstyle: solid;
$border_section_borderradius: 0px;

// Typography Section
$typography_section_font_family: inherit;
$typography_section_font_size: 16px;
$typography_section_font_style: inherit;
$typography_section_font_weight: 400;
$typography_section_line_height: 1.5;

// Inherit Examples
$inherit_colour_inherit: $alpha_colour;
$inherit_colour: $alpha_colour;
$another_inherit_colour_inherit: $alpha_colour;
$another_inherit_colour: $alpha_colour;
$inherit_range_inherit: $range;
$inherit_range: $range;
$inherit_radio_inherit: $inherit_radio;
$inherit_radio: a;

```

## Comprehensive Example Usage

This example adds a custom section and a custom panel, and demonstrates all of the available controls.

```php
if ( class_exists( 'WPC_Sass' ) ) :
	$wpcsass = new WPC_Sass;

	$wpcsass->add_panel( 'examples', 1, 'WPCSass Examples' );
	$wpcsass->add_section( 'presentation', 1, 'Presentation Controls', 'examples' );
	$wpcsass->add_section( 'custom', 2, 'Custom Controls', 'examples' );
	$wpcsass->add_section( 'standard', 3, 'Standard Controls', 'examples' );
	$wpcsass->add_section( 'shorthands', 4, 'Shorthands', 'examples' );
	$wpcsass->add_section( 'inherit', 5, 'Inherit', 'examples' );
	$wpcsass->add_settings( array(
		// Presentation Section
		'title' => array(
			'label'   => 'Title',
			'section' => 'presentation',
			'type'    => 'title'
		),
		'subtitle' => array(
			'label'   => 'Subtitle',
			'section' => 'presentation',
			'type'    => 'subtitle'
		),
		'description' => array(
			'description' => 'This is what title, subtitle, and description controls added via WPCSass look like!',
			'section'     => 'presentation',
			'type'        => 'description'
		),

		// Custom Controls Section
		'range_title' => array(
			'label'   => 'Range Control',
			'section' => 'custom',
			'type'    => 'title'
		),
		'range' => array(
			'label'   => 'Range',
			'section' => 'custom',
			'type'    => 'range',
			'default' => '3',
			'units'   => 'px',
			'range'   => array(
				'min'  => '0',
				'max'  => '20',
				'step' => '1'
			)
		),
		'radio_title' => array(
			'label'   => 'Radio Control',
			'section' => 'custom',
			'type'    => 'title'
		),
		'radio_1' => array(
			'label'   => 'Radio 1',
			'section' => 'custom',
			'type'    => 'radio',
			'default' => 'a',
			'choices' => array(
				'a' => 'Option A',
				'b' => 'Option B'
			)
		),
		'radio_2' => array(
			'label'   => 'Radio 2',
			'section' => 'custom',
			'type'    => 'radio',
			'default' => 'a',
			'choices' => array(
				'a' => 'Option A',
				'b' => 'Option B',
				'c' => 'Option C'
			)
		),
		'radio_3' => array(
			'label'   => 'Radio 3',
			'section' => 'custom',
			'type'    => 'radio',
			'default' => 'a',
			'choices' => array(
				'a' => 'Option A',
				'b' => 'Option B',
				'c' => 'Option C',
				'd' => 'Option D'
			)
		),
		'radio_4' => array(
			'label'   => 'Radio 4',
			'section' => 'custom',
			'type'    => 'radio',
			'default' => 'a',
			'choices' => array(
				'a' => 'Option A',
				'b' => 'Option B',
				'c' => 'Option C',
				'd' => 'Option D',
				'e' => 'Option E',
				'f' => 'Option F'
			)
		),
		'alpha_title' => array(
			'label'   => 'Alpha Colour Control',
			'section' => 'custom',
			'type'    => 'title'
		),
		'alpha_colour' => array(
			'label'   => 'Alpha Colour',
			'section' => 'custom',
			'type'    => 'colour',
			'alpha'   => true,
			'default' => '#444'
		),

		// Standard Controls Section
		'standard_controls_title' => array(
			'label'   => 'Standard Controls',
			'section' => 'standard',
			'type'    => 'title'
		),
		'colour' => array(
			'label'   => 'Colour',
			'section' => 'standard',
			'type'    => 'colour',
			'default' => '#444'
		),
		'text' => array(
			'label'   => 'Text',
			'section' => 'standard',
			'type'    => 'text',
			'default' => 'default'
		),
		'checkbox' => array(
			'label'   => 'Checkbox',
			'section' => 'standard',
			'type'    => 'checkbox'
		),
		'select' => array(
			'label'   => 'Select',
			'section' => 'standard',
			'type'    => 'select',
			'default' => 'a',
			'choices' => array(
				'a' => 'Option A',
				'b' => 'Option B',
				'c' => 'Option C'
			)
		),
		'textarea' => array(
			'label'   => 'Textarea',
			'section' => 'standard',
			'type'    => 'textarea'
		),
		'image' => array(
			'label'   => 'Image',
			'section' => 'standard',
			'type'    => 'image'
		),

		// Shorthands Section
		'background_section_title' => array(
			'label'   => 'Background Section',
			'section' => 'shorthands',
			'type'    => 'title'
		),
		'background_section' => array(
			'label'   => 'Background',
			'section' => 'shorthands',
			'type'    => 'background_section',
			'alpha'   => true,
			'default' => '#444'
		),
		'border_section_title' => array(
			'label'   => 'Border Section',
			'section' => 'shorthands',
			'type'    => 'title'
		),
		'border_section' => array(
			'label'   => 'Border',
			'section' => 'shorthands',
			'type'    => 'border_section',
			'default' => '#444'
		),
		'typography_section_title' => array(
			'label'   => 'Typography Section',
			'section' => 'shorthands',
			'type'    => 'title'
		),
		'typography_section' => array(
			'label'   => 'Typography',
			'section' => 'shorthands',
			'type'    => 'typography_section'
		),

		// Inherit Section
		'inherit_title' => array(
			'label'   => 'Inherit Examples',
			'section' => 'inherit',
			'type'    => 'title'
		),
		'inherit_colour' => array(
			'label'   => 'Inherit Colour',
			'section' => 'inherit',
			'type'    => 'colour',
			'default' => '#444',
			'inherit' => array(
				'alpha_colour' => 'Alpha',
				'colour'       => 'Standard'
			)
		),
		'another_inherit_colour' => array(
			'label'   => 'Another Inherit Colour',
			'section' => 'inherit',
			'type'    => 'colour',
			'default' => '#444',
			'inherit' => array(
				'alpha_colour'   => 'Alpha',
				'colour'         => 'Standard',
				'inherit_colour' => 'Inherit'
			)
		),
		'inherit_range' => array(
			'label'   => 'Inherit Range',
			'section' => 'inherit',
			'type'    => 'range',
			'default' => '3',
			'units'   => 'px',
			'range'   => array(
				'min'  => '0',
				'max'  => '20',
				'step' => '1'
			),
			'inherit' => array(
				'range' => 'Range'
			)
		),
		'inherit_radio' => array(
			'label'   => 'Inherit Radio',
			'section' => 'inherit',
			'type'    => 'radio',
			'default' => 'a',
			'choices' => array(
				'a' => 'Option A',
				'b' => 'Option B'
			),
			'inherit' => array(
				'radio_1' => 'Radio 1',
				'radio_2' => 'Radio 2',
				'radio_3' => 'Radio 3',
				'radio_4' => 'Radio 4'
			)
		)
	) );
endif;
```

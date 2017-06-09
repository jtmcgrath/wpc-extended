[Once you have set up your theme correctly](https://github.com/jtmcgrath/wpcsass/wiki/Default-Configuration), you can configure WPCSass by adding the following codes to your theme's `functions.php` file.

- [Basics](#basics)
- [Add Panel](#add-panel)
- [Add Panels](#add-panels)
- [Add Section](#add-section)
- [Add Sections](#add-sections)
- [Add Setting](#add-setting)
- [Add Settings](#add-settings)
- [Add Shorthand](#add-shorthand)
- [Options Usage](#options-usage)

***

### Basics

To add settings, you need to create an instance of the `WPC_Sass` class, and then add settings to the object. An empty example of what this should look like:

```php
if ( class_exists( 'WPC_Sass' ) ) :
	$wpcsass = new WPC_Sass;

	// New settings are added here

endif;
```

***

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

***

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

***

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

***

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

***

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

***

### Add Settings

Adds or updates multiple settings.

*Method*
```php
$wpcsass->add_settings( $settings );
```

*Example*
```php
$wpcsass->add_settings( array(
	'colour' => array(
		'label'   => 'Colour',
		'section' => 'custom_section',
		'type'    => 'colour',
		'default' => #444
	),
	'text' => array(
		'label'   => 'Text',
		'section' => 'custom_section',
		'type'    => 'text',
		'default' => 'something'
	)
) );
```

***

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

***

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
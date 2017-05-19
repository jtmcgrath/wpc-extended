# WordPress Customizer with Sass

This plugin will allow user settings in the WordPress Customizer to automatically compile into css via Sass. I have a working version which is integrated with a partially-built theme, but apparently something broke when I extracted it into a separate plugin, so it's not functional at the moment.

The `register()` method seems to be working to some extent, since the panels/sections are appearing in the Customizer, but they're set to `display: none;` and don't have any event listeners associated with them.

The investigation continues...

***

In case someone wants to check it out, it's easiest to use a blank child theme of `twentyseventeen`, with the following `functions.php`:

```php
<?php
function my_theme_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

	// Theme stylesheet.
	if ( ! is_customize_preview() ) :
		wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css' );
	else :
		wp_enqueue_style( 'customizer-style', get_stylesheet_directory_uri() . '/sass_output/style.css' );
	endif;
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

if ( $wpcsass ) {
	$wpcsass->add_settings( array(
		'title' => array(
			'label'   => 'Main Title',
			'section' => 'test_section'
		),
		'subtitle' => array(
			'label'   => 'Subtitle',
			'section' => 'test_section'
		),
		'description' => array(
			'description' => 'blahblahblah',
			'section'     => 'test_section'
		),
		'primary' => array(
			'label'   => 'Primary Colour',
			'section' => 'test_section',
			'type'    => 'colour',
			'alpha'   => true,
			'default' => '#444'
		),
		'secondary' => array(
			'label'   => 'Primary Colour',
			'section' => 'test_section',
			'type'    => 'colour',
			'default' => '#444'
		),
		'radio' => array(
			'label'    => 'Le Radio',
			'section'  => 'test_section',
			'type'     => 'radio',
			'choices'  => array(
				'a' => 'a',
				'b' => 'b',
				'c' => 'c'
			)
		)
	) );
	$wpcsass->add_panel( 'test_panel', 50, 'Test Panel' );
	$wpcsass->add_section( 'test_section', 50, 'Test Section', 'test_panel' );
}
?>
```

At the moment it also requires a couple of extra folders and (blank) files within the child theme folder (the finished plugin would probably create these automatically):
```
/sass/style.scss
/sass/_customizer_variables.scss
/sass_output/style.css
```

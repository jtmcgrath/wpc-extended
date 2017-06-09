This example adds a custom section and a custom panel, and demonstrates all of the available controls.

The following code should be pasted into your theme's `functions.php` file.

```php
if ( class_exists( 'WPC_Sass' ) ) :
	$wpcsass = new WPC_Sass;

	$wpcsass->set_css_backup_quantity( 5 );
	$wpcsass->add_panel( 'examples', 1, 'WPCSass Examples' );
	$wpcsass->add_section( 'presentation', 1, 'Presentation Controls', 'examples' );
	$wpcsass->add_section( 'custom', 2, 'Custom Controls', 'examples' );
	$wpcsass->add_section( 'standard', 3, 'Standard Controls', 'examples' );
	$wpcsass->add_section( 'shorthands', 4, 'Shorthands', 'examples' );
	$wpcsass->add_section( 'inherit', 5, 'Inherit', 'examples' );
	$wpcsass->add_section( 'conditional', 6, 'Conditional', 'examples' );
	$wpcsass->add_settings( array(
		// Presentation Section
		'title' => array(
			'label'   => 'Title',
			'section' => 'presentation',
			'type'    => 'title',
		),
		'subtitle' => array(
			'label'   => 'Subtitle',
			'section' => 'presentation',
			'type'    => 'subtitle',
		),
		'description' => array(
			'description' => 'This is what title, subtitle, and description controls added via WPCSass look like!',
			'section'     => 'presentation',
			'type'        => 'description',
		),

		// Custom Controls Section
		'range_title' => array(
			'label'   => 'Range Control',
			'section' => 'custom',
			'type'    => 'title',
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
				'step' => '1',
			),
		),
		'radio_title' => array(
			'label'   => 'Radio Control',
			'section' => 'custom',
			'type'    => 'title',
		),
		'radio_1' => array(
			'label'   => 'Radio 1',
			'section' => 'custom',
			'type'    => 'radio',
			'default' => 'a',
			'choices' => array(
				'a' => 'Option A',
				'b' => 'Option B',
			),
		),
		'radio_2' => array(
			'label'   => 'Radio 2',
			'section' => 'custom',
			'type'    => 'radio',
			'default' => 'a',
			'choices' => array(
				'a' => 'Option A',
				'b' => 'Option B',
				'c' => 'Option C',
			),
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
				'd' => 'Option D',
			),
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
				'f' => 'Option F',
			),
		),
		'alpha_title' => array(
			'label'   => 'Alpha Colour Control',
			'section' => 'custom',
			'type'    => 'title',
		),
		'alpha_colour' => array(
			'label'   => 'Alpha Colour',
			'section' => 'custom',
			'type'    => 'colour',
			'alpha'   => true,
			'default' => '#444',
		),

		// Standard Controls Section
		'standard_controls_title' => array(
			'label'   => 'Standard Controls',
			'section' => 'standard',
			'type'    => 'title',
		),
		'colour' => array(
			'label'   => 'Colour',
			'section' => 'standard',
			'type'    => 'colour',
			'default' => '#444',
		),
		'text' => array(
			'label'   => 'Text',
			'section' => 'standard',
			'type'    => 'text',
			'default' => 'default',
		),
		'checkbox' => array(
			'label'   => 'Checkbox',
			'section' => 'standard',
			'type'    => 'checkbox',
		),
		'select' => array(
			'label'   => 'Select',
			'section' => 'standard',
			'type'    => 'select',
			'default' => 'a',
			'choices' => array(
				'a' => 'Option A',
				'b' => 'Option B',
				'c' => 'Option C',
			),
		),
		'textarea' => array(
			'label'   => 'Textarea',
			'section' => 'standard',
			'type'    => 'textarea',
		),
		'image' => array(
			'label'   => 'Image',
			'section' => 'standard',
			'type'    => 'image',
		),

		// Shorthands Section
		'background_section_title' => array(
			'label'   => 'Background Section',
			'section' => 'shorthands',
			'type'    => 'title',
		),
		'background_section' => array(
			'label'   => 'Background',
			'section' => 'shorthands',
			'type'    => 'background_section',
			'alpha'   => true,
			'default' => '#444',
		),
		'border_section_title' => array(
			'label'   => 'Border Section',
			'section' => 'shorthands',
			'type'    => 'title',
		),
		'border_section' => array(
			'label'   => 'Border',
			'section' => 'shorthands',
			'type'    => 'border_section',
			'default' => '#444',
		),
		'typography_section_title' => array(
			'label'   => 'Typography Section',
			'section' => 'shorthands',
			'type'    => 'title',
		),
		'typography_section' => array(
			'label'   => 'Typography',
			'section' => 'shorthands',
			'type'    => 'typography_section',
		),

		// Inherit Section
		'inherit_title' => array(
			'label'   => 'Inherit Examples',
			'section' => 'inherit',
			'type'    => 'title',
		),
		'inherit_colour' => array(
			'label'   => 'Inherit Colour',
			'section' => 'inherit',
			'type'    => 'colour',
			'default' => '#444',
			'inherit' => array(
				'alpha_colour' => 'Alpha',
				'colour'       => 'Standard',
			),
		),
		'another_inherit_colour' => array(
			'label'   => 'Another Inherit Colour',
			'section' => 'inherit',
			'type'    => 'colour',
			'default' => '#444',
			'inherit' => array(
				'alpha_colour'   => 'Alpha',
				'colour'         => 'Standard',
				'inherit_colour' => 'Inherit',
			),
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
				'step' => '1',
			),
			'inherit' => array(
				'range' => 'Range',
			),
		),
		'inherit_radio' => array(
			'label'   => 'Inherit Radio',
			'section' => 'inherit',
			'type'    => 'radio',
			'default' => 'a',
			'choices' => array(
				'a' => 'Option A',
				'b' => 'Option B',
			),
			'inherit' => array(
				'radio_1' => 'Radio 1',
				'radio_2' => 'Radio 2',
				'radio_3' => 'Radio 3',
				'radio_4' => 'Radio 4',
			),
		),

		// Conditional Logic
		// Range (visible_if)
		'conditional_title_range' => array(
			'label'   => 'Range (visible_if)',
			'section' => 'conditional',
			'type'    => 'subtitle',
		),
		'conditional_parent_range' => array(
			'label'   => 'Parent',
			'section' => 'conditional',
			'type'    => 'range',
			'default' => '3',
			'units'   => 'px',
			'range'   => array(
				'min'  => 0,
				'max'  => 20,
				'step' => 1
			),
		),
		'conditional_child_range_1' => array(
			'label'      => 'Visible If == 5',
			'section'    => 'conditional',
			'type'       => 'text',
			'visible_if' => array(
				'setting'    => 'conditional_parent_range',
				'comparison' => '==',
				'value'      => '5',
			),
		),
		'conditional_child_range_2' => array(
			'label'      => 'Visible If >= 5',
			'section'    => 'conditional',
			'type'       => 'text',
			'visible_if' => array(
				'setting'    => 'conditional_parent_range',
				'comparison' => '>=',
				'value'      => '5',
			),
		),
		'conditional_child_range_3' => array(
			'label'      => 'Visible If <= 5',
			'section'    => 'conditional',
			'type'       => 'text',
			'visible_if' => array(
				'setting'    => 'conditional_parent_range',
				'comparison' => '<=',
				'value'      => '5',
			),
		),
		'conditional_child_range_4' => array(
			'label'      => 'Visible If != 5',
			'section'    => 'conditional',
			'type'       => 'text',
			'visible_if' => array(
				'setting'    => 'conditional_parent_range',
				'comparison' => '!=',
				'value'      => '5',
			),
		),
		'conditional_child_range_5' => array(
			'label'      => 'Visible If > 5',
			'section'    => 'conditional',
			'type'       => 'text',
			'visible_if' => array(
				'setting'    => 'conditional_parent_range',
				'comparison' => '>',
				'value'      => '5',
			),
		),
		'conditional_child_range_6' => array(
			'label'      => 'Visible If < 5',
			'section'    => 'conditional',
			'type'       => 'text',
			'visible_if' => array(
				'setting'    => 'conditional_parent_range',
				'comparison' => '<',
				'value'      => '5',
			),
		),

		// Range (hidden_if)
		'conditional_title_range2' => array(
			'label'   => 'Range (hidden_if)',
			'section' => 'conditional',
			'type'    => 'subtitle',
		),
		'conditional_parent_range2' => array(
			'label'   => 'Parent',
			'section' => 'conditional',
			'type'    => 'range',
			'default' => '3',
			'units'   => 'px',
			'range'   => array(
				'min'  => 0,
				'max'  => 20,
				'step' => 1
			),
		),
		'conditional_child_range2_1' => array(
			'label'      => 'Hidden If == 5',
			'section'    => 'conditional',
			'type'       => 'text',
			'hidden_if' => array(
				'setting'    => 'conditional_parent_range2',
				'comparison' => '==',
				'value'      => '5',
			),
		),
		'conditional_child_range2_2' => array(
			'label'      => 'Hidden If >= 5',
			'section'    => 'conditional',
			'type'       => 'text',
			'hidden_if' => array(
				'setting'    => 'conditional_parent_range2',
				'comparison' => '>=',
				'value'      => '5',
			),
		),
		'conditional_child_range2_3' => array(
			'label'      => 'Hidden If <= 5',
			'section'    => 'conditional',
			'type'       => 'text',
			'hidden_if' => array(
				'setting'    => 'conditional_parent_range2',
				'comparison' => '<=',
				'value'      => '5',
			),
		),
		'conditional_child_range2_4' => array(
			'label'      => 'Hidden If != 5',
			'section'    => 'conditional',
			'type'       => 'text',
			'hidden_if' => array(
				'setting'    => 'conditional_parent_range2',
				'comparison' => '!=',
				'value'      => '5',
			),
		),
		'conditional_child_range2_5' => array(
			'label'      => 'Hidden If > 5',
			'section'    => 'conditional',
			'type'       => 'text',
			'hidden_if' => array(
				'setting'    => 'conditional_parent_range2',
				'comparison' => '>',
				'value'      => '5',
			),
		),
		'conditional_child_range2_6' => array(
			'label'      => 'Hidden If < 5',
			'section'    => 'conditional',
			'type'       => 'text',
			'hidden_if' => array(
				'setting'    => 'conditional_parent_range2',
				'comparison' => '<',
				'value'      => '5',
			),
		),

		// Radio
		'conditional_title_radio' => array(
			'label'   => 'Radio',
			'section' => 'conditional',
			'type'    => 'subtitle',
		),
		'conditional_parent_radio' => array(
			'label'   => 'Parent',
			'section' => 'conditional',
			'type'    => 'radio',
			'default' => 'hide',
			'choices' => array(
				'hide' => 'Hide',
				'show' => 'Show',
			),
		),
		'conditional_child_radio' => array(
			'label'      => 'Child',
			'section'    => 'conditional',
			'type'       => 'text',
			'visible_if' => array(
				'setting'    => 'conditional_parent_radio',
				'comparison' => '===',
				'value'      => 'show',
			),
		),

		// Alpha Colour
		'conditional_title_alpha' => array(
			'label'   => 'Alpha Colour',
			'section' => 'conditional',
			'type'    => 'subtitle',
		),
		'conditional_description_alpha' => array(
			'description' => 'Matches if Parent is "rgba(0,0,0,0.5)"',
			'section'     => 'conditional',
			'type'        => 'description',
		),
		'conditional_parent_alpha' => array(
			'label'   => 'Parent',
			'section' => 'conditional',
			'type'    => 'colour',
			'alpha'   => true,
			'default' => '#444',
		),
		'conditional_child_alpha' => array(
			'label'      => 'Child',
			'section'    => 'conditional',
			'type'       => 'text',
			'visible_if' => array(
				'setting'    => 'conditional_parent_alpha',
				'comparison' => '===',
				'value'      => 'rgba(0,0,0,0.5)',
			),
		),

		// Colour
		'conditional_title_colour' => array(
			'label'   => 'Colour',
			'section' => 'conditional',
			'type'    => 'subtitle',
		),
		'conditional_description_colour' => array(
			'description' => 'Matches if Parent is "#cccccc"',
			'section'     => 'conditional',
			'type'        => 'description',
		),
		'conditional_parent_colour' => array(
			'label'   => 'Parent',
			'section' => 'conditional',
			'type'    => 'color',
		),
		'conditional_child_colour' => array(
			'label'      => 'Child',
			'section'    => 'conditional',
			'type'       => 'text',
			'visible_if' => array(
				'setting'    => 'conditional_parent_colour',
				'comparison' => '===',
				'value'      => '#cccccc',
			),
		),

		// Text
		'conditional_title_text' => array(
			'label'   => 'Text',
			'section' => 'conditional',
			'type'    => 'subtitle',
		),
		'conditional_description_text' => array(
			'description' => 'Matches if Parent is "test"',
			'section'     => 'conditional',
			'type'        => 'description',
		),
		'conditional_parent_text' => array(
			'label'   => 'Parent',
			'section' => 'conditional',
			'type'    => 'text',
		),
		'conditional_child_text' => array(
			'label'      => 'Child',
			'section'    => 'conditional',
			'type'       => 'text',
			'visible_if' => array(
				'setting'    => 'conditional_parent_text',
				'comparison' => '===',
				'value'      => 'test',
			),
		),

		// Checkbox
		'conditional_title_checkbox' => array(
			'label'   => 'Checkbox',
			'section' => 'conditional',
			'type'    => 'subtitle',
		),
		'conditional_parent_checkbox' => array(
			'label'   => 'Parent',
			'section' => 'conditional',
			'type'    => 'checkbox',
		),
		'conditional_child_checkbox' => array(
			'label'      => 'Child',
			'section'    => 'conditional',
			'type'       => 'text',
			'visible_if' => array(
				'setting'    => 'conditional_parent_checkbox',
				'comparison' => '==',
				'value'      => 'true',
			),
		),

		// Select
		'conditional_title_select' => array(
			'label'   => 'Select',
			'section' => 'conditional',
			'type'    => 'subtitle',
		),
		'conditional_parent_select' => array(
			'label'   => 'Parent',
			'section' => 'conditional',
			'type'    => 'select',
			'choices' => array(
				'hide' => 'Hide',
				'show' => 'Show',
			),
		),
		'conditional_child_select' => array(
			'label'      => 'Child',
			'section'    => 'conditional',
			'type'       => 'text',
			'visible_if' => array(
				'setting'    => 'conditional_parent_select',
				'comparison' => '===',
				'value'      => 'show',
			),
		),

		// Textarea
		'conditional_title_textarea' => array(
			'label'   => 'Textarea',
			'section' => 'conditional',
			'type'    => 'subtitle',
		),
		'conditional_description_textarea' => array(
			'description' => 'Matches if Parent is "test"',
			'section'     => 'conditional',
			'type'        => 'description',
		),
		'conditional_parent_textarea' => array(
			'label'   => 'Parent',
			'section' => 'conditional',
			'type'    => 'textarea',
		),
		'conditional_child_textarea' => array(
			'label'      => 'Child',
			'section'    => 'conditional',
			'type'       => 'text',
			'visible_if' => array(
				'setting'    => 'conditional_parent_textarea',
				'comparison' => '===',
				'value'      => 'test',
			),
		),

		// Image
		'conditional_title_image' => array(
			'label'   => 'Parent',
			'section' => 'conditional',
			'type'    => 'subtitle',
		),
		'conditional_description_image' => array(
			'description' => 'Matches if Parent is not empty',
			'section'     => 'conditional',
			'type'        => 'description',
		),
		'conditional_parent_image' => array(
			'label'   => 'Parent',
			'section' => 'conditional',
			'type'    => 'image',
		),
		'conditional_child_image' => array(
			'label'      => 'Child',
			'section'    => 'conditional',
			'type'       => 'text',
			'visible_if' => array(
				'setting'    => 'conditional_parent_image',
				'comparison' => '==',
				'value'      => 'true',
			),
		),
	) );
endif;
```
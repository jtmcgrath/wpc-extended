<?php
if ( ! class_exists( 'WPC_Extended' ) ) :
class WPC_Extended {
	/**
	 * Namespace used for Customizer variables.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var string
	 */
	var $namespace = 'wpc_extended_';

	/**
	 * Panels to be added to the Customizer.
	 *
	 * @since 1.0.0
	 * @access public
	 * @var array
	 */
	public $panels = array();

	/**
	 * Sections to be added to the Customizer.
	 *
	 * @since 1.0.0
	 * @access public
	 * @var array
	 */
	public $sections = array();

	/**
	 * Settings to be added to the Customizer.
	 *
	 * @since 1.0.0
	 * @access public
	 * @var array
	 */
	public $settings = array();

	/**
	 * Conditional setting display types.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var array
	 */
	var $condition_types = array(
		'visible_if',
		'hidden_if',
	);

	/**
	 * Comment setting types.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var array
	 */
	var $comment_types = array(
		'title',
		'subtitle',
		'description',
	);

	/**
	 * Array containing details for section shorthands.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var array
	 */
	var $section_shorthands = array(
		'background_section' => array(
			'_bgcolor' => array(
				'label'     => 'Color',
				'type'      => 'color',
				'attribute' => 'background-color',
			),
			'_bgimage' => array(
				'label'   => 'Image',
				'type'    => 'image',
				'default' => '',
			),
			'_bgrepeat' => array(
				'label'     => 'Repeat',
				'type'      => 'radio',
				'default'   => 'no-repeat',
				'choices'   => array(
					'no-repeat' => 'No Repeat',
					'repeat'    => 'Tile',
					'repeat-x'  => 'Horizontal Tiles',
					'repeat-y'  => 'Vertical Tiles',
				),
				'attribute' => 'background-repeat',
			),
			'_bgposition' => array(
				'label'     => 'Position',
				'type'      => 'radio',
				'default'   => 'center',
				'choices'   => array(
					'left top'      => 'Top Left',
					'center top'    => 'Top',
					'right top'     => 'Top Right',
					'left center'   => 'Left',
					'center'        => 'Center',
					'right center'  => 'Right',
					'left bottom'   => 'Bottom Left',
					'center bottom' => 'Bottom',
					'right bottom'  => 'Bottom Right',
				),
				'attribute' => 'background-position',
			),
			'_bgattachment' => array(
				'label'     => 'Attachment',
				'type'      => 'radio',
				'default'   => 'scroll',
				'choices'   => array(
					'scroll' => 'Scroll',
					'fixed'  => 'Fixed',
				),
				'attribute' => 'background-attachment',
			),
			'_bgsize' => array(
				'label'     => 'Size',
				'type'      => 'radio',
				'default'   => 'cover',
				'choices'   => array(
					'auto'    => 'Auto',
					'cover'   => 'Cover',
					'contain' => 'Contain',
				),
				'attribute' => 'background-size',
			)
		),
		'border_section' => array(
			'_borderwidth' => array(
				'label'   => 'Width',
				'type'    => 'range',
				'default' => '0',
				'units'   => 'px',
				'range'   => array(
					'min'  => '0',
					'max'  => '10',
					'step' => '1',
				),
			),
			'_bordercolor' => array(
				'label'     => 'Color',
				'type'      => 'color',
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
					'outset' => 'Outset',
				),
			),
			'_borderradius' => array(
				'label'   => 'Radius',
				'type'    => 'range',
				'default' => '0',
				'units'   => 'px',
				'range'   => array(
					'min'  => '0',
					'max'  => '10',
					'step' => '1',
				),
			),
		),
		'typography_section' => array(
			'_font_family' => array(
				'label'   => 'Font Family',
				'type'    => 'text',
				'default' => 'inherit',
			),
			'_font_size' => array(
				'label'   => 'Font Size',
				'type'    => 'range',
				'default' => '16',
				'units'   => 'px',
				'range'   => array(
					'min'  => '8',
					'max'  => '60',
					'step' => '1',
				),
			),
			'_font_style' => array(
				'label'   => 'Font Style',
				'type'    => 'radio',
				'default' => 'inherit',
				'choices' => array(
					'inherit' => 'Inherit',
					'normal'  => 'Normal',
					'italic'  => 'Italic',
					'oblique' => 'Oblique',
				),
			),
			'_font_weight' => array(
				'label'   => 'Font Weight',
				'type'    => 'select',
				'default' => 400,
				'choices' => array(
					100 => 'Thin',
					200 => 'Extra Light',
					300 => 'Light',
					400 => 'Normal',
					500 => 'Medium',
					600 => 'Semi Bold',
					700 => 'Bold',
					800 => 'Extra Bold',
					900 => 'Black',
				),
			),
			'_line_height' => array(
				'label'   => 'Line Height',
				'type'    => 'range',
				'default' => '1.2',
				'units'   => '',
				'range'   => array(
					'min'  => '0.5',
					'max'  => '5',
					'step' => '0.1',
				),
			),
		)
	);

	/**
	 * Adds or updates a section shorthand.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $shorthand_id Id of the shorthand to add or update.
	 * @param array  $data         An associative array containing the content of the shorthand.
	 */
	public function add_shorthand( $shorthand_id, $data ) {
		$this->panels[ $shorthand_id ] = $data;
	}

	/**
	 * Adds or updates a Customizer panel.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $panel_id Id of the panel to add or update.
	 * @param int    $priority Priority of the panel.
	 * @param string $title    Title of the panel.
	 */
	public function add_panel( $panel_id, $title = null, $priority = 50 ) {
		if ( null === $title ) :
			$title = $panel_id;
		endif;

		$this->panels[ $panel_id ] = array(
			'priority' => $priority,
			'title'    => $title,
		);
	}

	/**
	 * Adds or updates multiple Customizer panels.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $panels Array of panels to add or update.
	 */
	public function add_panels( $panels ) {
		$i = 50;
		foreach ( $panels as $panel_id => $data ) :
			if ( ! array_key_exists( 'priority', $data ) ) :
				$data['priority'] = $i;
			endif;

			if ( ! array_key_exists( 'title', $data ) ) :
				$data['title'] = null;
			endif;

			$this->add_panel( $panel_id, $data['title'], $data['priority'] );
			$i++;
		endforeach;
	}

	/**
	 * Adds or updates a Customizer section.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $section_id Id of the section to add or update.
	 * @param int    $priority   Priority of the section.
	 * @param string $title      Title of the section.
	 * @param string $panel      Id of the panel the section belongs to.
	 */
	public function add_section( $section_id, $title = null, $panel_id = null, $priority = 50 ) {
		if ( null === $title ) :
			$title = $section_id;
		endif;

		$this->sections[ $section_id ] = array(
			'priority' => $priority,
			'title'    => $title,
		);

		if ( $panel_id ) :
			$this->sections[ $section_id ]['panel'] = $panel_id;
		endif;
	}

	/**
	 * Adds or updates multiple Customizer sections.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $sections Array of sections to add or update.
	 */
	public function add_sections( $sections ) {
		$i = 1;
		foreach ( $sections as $section_id => $data ) :
			if ( ! array_key_exists( 'priority', $data ) ) :
				$data['priority'] = $i;
			endif;

			if ( ! array_key_exists( 'title', $data ) ) :
				$data['title'] = null;
			endif;

			$this->add_section( $section_id, $data['title'], $data['panel'], $data['priority'] );
		endforeach;
	}

	/**
	 * Adds or updates an existing setting.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $setting_id Id of the setting to add or update.
	 * @param string $data       An associative array containing arguments for the setting.
	 */
	public function add_setting( $setting_id, $data ) {
		// If the setting's type matches a setting_shorthand...
		if ( array_key_exists( $data['type'], $this->section_shorthands ) ) :
			// ...generate settings from shorthand.
			$this->generate_settings_from_shorthand( $setting_id, $data );
		else :
			if ( array_key_exists( 'inherit', $data ) ) :
				// Generate inherit setting.
				$this->generate_inherit_setting( $setting_id, $data );

				// Remove the label from the parent setting.
				$data['label'] = '';
			endif;

			$data['vardump'] = $data['type'];
			$this->settings[ $setting_id ] = $data;
		endif;
	}

	/**
	 * Generates dynamic settings from shorthand.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @param string $setting_id Id of the setting group.
	 * @param string $data       An associative array containing arguments for the setting group.
	 */
	private function generate_settings_from_shorthand( $setting_id, $data ) {
		foreach ( $this->section_shorthands[ $data['type'] ] as $setting_suffix => $setting_data ) :
			// Create sub-setting id.
			$_setting_id = $setting_id . $setting_suffix;

			// Create sub-setting data array.
			$_data = $setting_data;

			// Concatenate labels.
			$_data['label'] = $data['label'] . ' ' . $setting_data['label'];

			// Set section.
			$_data['section'] = $data['section'];

			// Get default value for colour sub-setting.
			if ( '_color' === $setting_suffix ) :
				$_data['default'] = $data['default'];

				if ( $data['alpha'] ) :
					$_data['alpha'] = true;
				endif;
			else :
				$_data['default'] = $setting_data['default'];
			endif;

			// Add conditional display logic.
			foreach ( $this->condition_types as $type ) :
				if ( array_key_exists( $type, $data ) ) :
					$_data[ $type ] = $data[ $type ];
				endif;
			endforeach;

			$this->settings[ $_setting_id ] = $_data;
		endforeach;
	}

	/**
	 * Generates an inherit setting.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @param string $setting_id Id of the parent setting.
	 * @param string $data       An associative array containing arguments for the parent setting.
	 */
	private function generate_inherit_setting( $setting_id, $data ) {
		// Populate the $_data array for the inherit setting.
		$_data = array(
			'label'   => $data['label'],
			'section' => $data['section'],
			'type'    => 'radio',
			'choices' => $data['inherit'],
			'vardump' => 'inherit',
		);

		// Reset the options array and set the default to the first option.
		reset( $data['inherit'] );
		$_data['default'] = key( $data['inherit'] );

		// Add the current setting_id to the choices array as "Custom".
		$_data['choices'][$setting_id] = 'Custom';

		// Add conditional display logic.
		foreach ( $this->condition_types as $type ) :
			if ( array_key_exists( $type, $data ) ) :
				$_data[ $type ] = $data[ $type ];
			endif;
		endforeach;

		// Create inherit setting.
		$this->settings[ $setting_id . '_inherit' ] = $_data;
	}

	/**
	 * Adds or updates multiple settings.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $settings Array of settings to add or update.
	 */
	public function add_settings( $settings ) {
		foreach ( $settings as $setting_id => $data ) {
			$this->add_setting( $setting_id, $data );
		}
	}

	/**
	 * Gets the value for a setting.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $setting_id Settings to retrieve.
	 * @param bool   $options    Options.
	 */
	public function get_setting( $setting_id, $options = array() ) {
		if ( is_string( $options ) ) :
			$options = array( $options );
		endif;

		// If setting might inherit from another setting, check the inherit setting first.
		if ( array_key_exists( $setting_id . '_inherit', $this->settings ) ) :
			$_data = $this->settings[$setting_id . '_inherit'];
			$_setting_id = get_theme_mod( $this->namespace . $setting_id . '_inherit', $_data['default'] );

			/**
			 * In some situations, we want to print the inherited value's original
			 * source, rather than print the value itself; for example if we want
			 * one Sass variable to be an alias for another.
			 */
			if ( in_array( 'show_reference', $options ) && $setting_id !== $_setting_id ) {
				return '$' . $_setting_id;
			}

			$setting_id = $_setting_id;
		endif;

		$data = $this->settings[$setting_id];
		$value = get_theme_mod( $this->namespace . $setting_id, $data['default'] );

		return $this->format_value( $value, $data, $options );
	}

	/**
	 * Formats the setting's value.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @param {*}   $value The setting's value.
	 * @param array $data  The setting's data.
	 */
	private function format_value( $value, $data, $options = array() ) {
		if ( is_string( $options ) ) :
			$options = array( $options );
		endif;

		if ( ! in_array( 'no_quotes', $options ) && ( 'image' === $data['type']  || 'textarea' === $data['type'] || '' === $value ) ) :
			$value = "'" . $value . "'";
		endif;

		if (  'checkbox' === $data['type'] ) :
			if ( $value ) :
				$value = 'true';
			else :
				$value = 'false';
			endif;
		endif;

		if ( ! in_array( 'no_units', $options ) && isset( $data['units'] ) ) :
			$value .= $data['units'];
		endif;

		return $value;
	}

	/**
	 * Get setting values as an array.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $options Options to be passed on to the get_setting() method.
	 */
	public function get_settings( $options = array() ) {
		if ( is_string( $options ) ) :
			$options = array( $options );
		endif;

		$values = array();

		foreach ( $this->settings as $setting_id => $data ) :
			if (
				array_key_exists( $data['type'], $this->section_shorthands ) ||
				in_array( $data['type'], $this->comment_types )
			) :
				continue;
			else :
				// Add value to results array
				$values[$setting_id] = $this->get_setting( $setting_id, $options );

				// If setting is an image upload form, get dimensions
				if ( $data['type'] === 'image' ) {
					if ( $values[$setting_id] === "''" || empty ( $values[$setting_id] ) ) :
						$size = [ 0, 0 ];
					else :
						$size = getimagesize( $this->get_setting( $setting_id, [ 'no_quotes' ] ) );
					endif;

					$values[$setting_id . '_width'] = $size[0];
					$values[$setting_id . '_height'] = $size[1];
				}
			endif;
		endforeach;

		return $values;
	}

	/**
	 * Get the conditional logic for setting visibility.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function get_conditional_logic() {
		$logic = array();

		foreach ( $this->settings as $setting_id => $data ) :
			foreach ( $this->condition_types as $type ) :
				if ( array_key_exists( $type, $data ) ) :
					if ( ! array_key_exists( $type, $logic ) ) :
						$logic[$type] = array();
					endif;

					$condition = array(
						'target'     => '#customize-control-' . $this->namespace . $setting_id,
						'setting'    => '#customize-control-' . $this->namespace . $data[$type]['setting'],
						'comparison' => $data[$type]['comparison'],
						'value'      => $data[$type]['value'],
					);

					array_push( $logic[$type], $condition );
				endif;
			endforeach;
		endforeach;

		return $logic;
	}

	/**
	 * Registers the Customizer settings.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param object $wp_customize Instance of the WP_Customize_Control object.
	 */
	public function register( $wp_customize ) {
		// Add panels to Customizer
		foreach ( $this->panels as $panel_id => $data ) {
			$wp_customize->add_panel( $this->namespace . $panel_id, $data );
		}

		// Add sections to Customizer
		foreach ( $this->sections as $section_id => $data ) {
			if ( array_key_exists('panel', $data ) ) :
				$data['panel'] = $this->namespace . $data['panel'];
			endif;
			$wp_customize->add_section( $this->namespace . $section_id, $data );
		}

		// Add settings to Customizer
		foreach ( $this->settings as $setting_id => $data ) :
			$this->add_control( $wp_customize, $setting_id, $data );
		endforeach;
	}

	/**
	 * Creates Customizer controls.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @param object $wp_customize Instance of the WP_Customize_Control object.
	 * @param string $setting_id   Id of the setting to be added.
	 * @param array  $data         Setting data.
	 */
	private function add_control( $wp_customize, $setting_id, $data ) {

		if ( array_key_exists('section', $data ) ) :
			$data['section'] = $this->namespace . $data['section'];
		endif;
		$setting_id = $this->namespace . $setting_id;

		$wp_customize->add_setting( $setting_id, array(
			'default' => $data['default'],
		) );

		switch( $data['type'] ) :

			case 'title' :
				$wp_customize->add_control(
					new WPC_Extended_Insert_HTML(
						$wp_customize,
						$setting_id,
						array(
							'label'    => '<h1 class="wpc_extended_title">' . $data['label'] . '</h1>',
							'section'  => $data['section'],
							'settings' => $setting_id,
						)
					)
				);
				break;

			case 'subtitle' :
				$wp_customize->add_control(
					new WPC_Extended_Insert_HTML(
						$wp_customize,
						$setting_id,
						array(
							'label'    => '<h3 class="wpc_extended_subtitle">' . $data['label'] . '</h3>',
							'section'  => $data['section'],
							'settings' => $setting_id,
						)
					)
				);
				break;

			case 'description' :
				$wp_customize->add_control(
					new WPC_Extended_Insert_HTML(
						$wp_customize,
						$setting_id,
						array(
							'description' => $data['description'],
							'section'     => $data['section'],
							'settings'    => $setting_id,
						)
					)
				);
				break;

			case 'color' :
			case 'colour' :
				if ( $data['alpha'] ) :
					$wp_customize->add_control(
						new Customize_Alpha_Color_Control(
							$wp_customize,
							$setting_id,
							array(
								'label'    => $data['label'],
								'section'  => $data['section'],
								'settings' => $setting_id,
							)
						)
					);
				else :
					$wp_customize->add_control(
						new WP_Customize_Color_Control(
							$wp_customize,
							$setting_id,
							array(
								'label'    => $data['label'],
								'section'  => $data['section'],
								'settings' => $setting_id,
							)
						)
					);
				endif;
				break;

			case 'radio' :
				$wp_customize->add_control(
					new WPC_Extended_Radio(
						$wp_customize,
						$setting_id,
						array(
							'label'    => $data['label'],
							'section'  => $data['section'],
							'settings' => $setting_id,
							'type'     => $data['type'],
							'choices'  => $data['choices'],
						)
					)
				);
				break;

			case 'select' :
				$wp_customize->add_control(
					new WP_Customize_Control(
						$wp_customize,
						$setting_id,
						array(
							'label'    => $data['label'],
							'section'  => $data['section'],
							'settings' => $setting_id,
							'type'     => $data['type'],
							'choices'  => $data['choices'],
						)
					)
				);
				break;

			case 'image' :
				$wp_customize->add_control(
					new WP_Customize_Image_Control(
						$wp_customize,
						$setting_id,
						array(
							'label'    => $data['label'],
							'section'  => $data['section'],
							'settings' => $setting_id,
						)
					)
				);
				break;

			case 'range' :
				$wp_customize->add_control(
					new WPC_Extended_Range(
						$wp_customize,
						$setting_id,
						array(
							'label'       => $data['label'],
							'section'     => $data['section'],
							'settings'    => $setting_id,
							'description' => $data['units'],
							'input_attrs' => array(
								'min'  => $data['range']['min'],
								'max'  => $data['range']['max'],
								'step' => $data['range']['step'],
							),
						)
					)
				);
				break;

			default:
				$wp_customize->add_control(
					new WP_Customize_Control(
						$wp_customize,
						$setting_id,
						array(
							'label'    => $data['label'],
							'section'  => $data['section'],
							'settings' => $setting_id,
							'type'     => $data['type'],
							'default'  => $data['default'],
						)
					)
				);
				break;
		endswitch;
	}

	/**
	 * Using singleton pattern.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public static function Instance() {
		static $instance = null;
		if ( $instance === null ) {
			$instance = new WPC_Extended;
		}
		return $instance;
	}

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {
		add_action( 'customize_register', array( $this, 'register' ) );
	}
}
endif;

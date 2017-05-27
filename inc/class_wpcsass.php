<?php
if ( ! class_exists( 'WPC_Sass' ) ) :
class WPC_Sass {
	/**
	 * Namespace used for Customizer variables.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var string
	 */
	var $namespace = 'wpcsass_';

	/**
	 * Sass entry point.
	 *
	 * @since 1.0.0
	 * @access public
	 * @var string
	 */
	public $sass_entry_point = 'style.scss';

	/**
	 * Sets Sass entry point.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $filename Filename for the Sass entry point.
	 */
	public function set_sass_entry_point( $filename ) {
		$this->sass_entry_point = $filename;
	}

	/**
	 * CSS backup quantity.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var int
	 */
	private $css_backup_quantity = 1;

	/**
	 * Sets CSS backup quantity.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param int $quantity Number of css backup files to create.
	 */
	public function set_css_backup_quantity( $quantity ) {
		$this->css_backup_quantity = $quantity;
	}

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
	 * Comment setting types.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var array
	 */
	var $comment_types = array(
		'title',
		'subtitle',
		'description'
	);

	/**
	 * Array containing details for section generators
	 *
	 * @since 1.0.0
	 * @access private
	 * @var array
	 */
	var $section_generators = array(
		'background_section' => array(
			'_bgcolor' => array(
				'label'     => 'Color',
				'type'      => 'color',
				'attribute' => 'background-color'
			),
			'_bgimage' => array(
				'label'   => 'Image',
				'type'    => 'image',
				'default' => ''
			),
			'_bgrepeat' => array(
				'label'     => 'Repeat',
				'type'      => 'radio',
				'default'   => 'no-repeat',
				'choices'   => array(
					'no-repeat' => 'No Repeat',
					'repeat'    => 'Tile',
					'repeat-x'  => 'Horizontal Tiles',
					'repeat-y'  => 'Vertical Tiles'
				),
				'attribute' => 'background-repeat'
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
					'right bottom'  => 'Bottom Right'
				),
				'attribute' => 'background-position'
			),
			'_bgattachment' => array(
				'label'     => 'Attachment',
				'type'      => 'radio',
				'default'   => 'scroll',
				'choices'   => array(
					'scroll' => 'Scroll',
					'fixed'  => 'Fixed'
				),
				'attribute' => 'background-attachment'
			),
			'_bgsize' => array(
				'label'     => 'Size',
				'type'      => 'radio',
				'default'   => 'cover',
				'choices'   => array(
					'auto'    => 'Auto',
					'cover'   => 'Cover',
					'contain' => 'Contain'
				),
				'attribute' => 'background-size'
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
		),
		'typography_section' => array(
			'_font_family' => array(
				'label'   => 'Font Family',
				'type'    => 'text',
				'default' => 'inherit'
			),
			'_font_size' => array(
				'label'   => 'Font Size',
				'type'    => 'range',
				'default' => '16',
				'units'   => 'px',
				'range'   => array(
					'min'  => '8',
					'max'  => '60',
					'step' => '1'
				)
			),
			'_font_style' => array(
				'label'   => 'Font Style',
				'type'    => 'radio',
				'default' => 'inherit',
				'choices' => array(
					'inherit' => 'Inherit',
					'normal'  => 'Normal',
					'italic'  => 'Italic',
					'oblique' => 'Oblique'
				)
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
					900 => 'Black'
				)
			),
			'_line_height' => array(
				'label'   => 'Line Height',
				'type'    => 'range',
				'default' => '1.2',
				'units'   => '',
				'range'   => array(
					'min'  => '0.5',
					'max'  => '5',
					'step' => '0.1'
				)
			)
		)
	);

	/**
	 * Sass input directory
	 *
	 * @since 1.0.0
	 * @access public
	 * @var string
	 */
	public $file_sass_input_directory;

	/**
	 * Sass output directory
	 *
	 * @since 1.0.0
	 * @access public
	 * @var string
	 */
	public $file_sass_output_directory;

	/**
	 * Sass vardump file
	 *
	 * @since 1.0.0
	 * @access public
	 * @var string
	 */
	public $file_sass_vardump;

	/**
	 * Sass output file
	 *
	 * @since 1.0.0
	 * @access public
	 * @var string
	 */
	public $file_sass_output;

	/**
	 * Live css file
	 *
	 * @since 1.0.0
	 * @access public
	 * @var string
	 */
	public $file_live_css;

	/**
	 * Sets Sass input directory
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $directory Location for the Sass input directory
	 */
	public function set_sass_input_directory( $directory ) {
		$this->file_sass_input_directory = $directory;
	}

	/**
	 * Sets Sass output directory
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $directory Location for the Sass output directory
	 */
	public function set_sass_output_directory( $directory ) {
		$this->file_sass_output_directory = $directory;
	}

	/**
	 * Sets Sass vardump file location
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $file Location for the Sass vardump file
	 */
	public function set_sass_vardump( $file ) {
		$this->file_sass_vardump = $file;
	}

	/**
	 * Sets Sass output file location
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $file Location for the Sass output file
	 */
	public function set_sass_output( $file ) {
		$this->file_sass_output = $file;
	}

	/**
	 * Sets live css file location
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $file Location for the live css file
	 */
	public function set_live_stylesheet( $file ) {
		$this->file_live_css = $file;
	}

	/**
	 * Adds or updates a Customizer panel.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $panel_id    Id of the panel to add or update
	 * @param int    $priority Priority of the panel
	 * @param string $title    Title of the panel
	 */
	public function add_panel( $panel_id, $priority = 50, $title = null ) {
		if ( null === $title ) :
			$title = $panel_id;
		endif;

		$this->panels[ $panel_id ] = array(
			'priority' => $priority,
			'title'    => $title
		);
	}

	/**
	 * Adds or updates multiple Customizer panels.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $panels Array of panels to add or update
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

			$this->add_panel( $panel_id, $data['priority'], $data['title'] );
			$i++;
		endforeach;
	}

	/**
	 * Adds default Customizer panel if there are no predefined panels.
	 *
	 * @since 1.0.0
	 * @access private
	 */
	private function test_panels() {
		if ( empty( $this->panels ) ) :
			$this->add_panel( "WPC_Sass", 50, "WPC_Sass" );
		endif;
	}


	/**
	 * Adds or updates a Customizer section.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $section_id  Id of the section to add or update
	 * @param int    $priority Priority of the section
	 * @param string $title    Title of the section
	 * @param string $panel    Id of the panel the section belongs to
	 */
	public function add_section( $section_id, $priority = 50, $title = null, $panel_id ) {
		if ( null === $title ) :
			$title = $section_id;
		endif;

		$this->sections[ $section_id ] = array(
			'priority' => $priority,
			'title'    => $title,
			'panel'    => $panel_id
		);
	}

	/**
	 * Adds or updates multiple Customizer sections.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $sections Array of sections to add or update
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

			if ( ! array_key_exists( 'panel', $data ) ) :
				$this->add_panel( "WPC_Sass", 50, "WPC_Sass" );
				$data['panel'] = "WPC_Sass";
			endif;

			$this->add_section( $section_id, $data['priority'], $data['title'], $data['panel'] );
		endforeach;
	}

	/**
	 * Adds or updates an existing setting.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $setting_id Id of the setting to add or update
	 * @param string $data       An associative array containing arguments for the setting
	 */
	public function add_setting( $setting_id, $data ) {
		if ( array_key_exists( $data['type'], $this->section_generators ) ) :
			foreach ( $this->section_generators[ $data['type'] ] as $setting_suffix => $setting_data ) :
				// Create sub-setting id.
				$_setting_id = $setting_id . $setting_suffix;

				// Create sub-setting data array.
				$_data = $setting_data;

				// Concatenate labels.
				$_data['label'] = $data['label'] . ' ' . $setting_data['label'];

				// Set section.
				$_data['section'] = $data['section'];

				// Get default value for colour sub-setting.
				if ( $setting_suffix === '_color') :
					$_data['default'] = $data['default'];

					if ( $data['alpha'] ) :
						$_data['alpha'] = true;
					endif;
				else :
					$_data['default'] = $setting_data['default'];
				endif;

				$this->settings[ $_setting_id ] = $_data;
			endforeach;
		else :
			if ( array_key_exists( 'inherit', $data ) ) :
				// Populate the $_data array for the inherit setting.
				$_data = array(
					'label'   => $data['label'],
					'section' => $data['section'],
					'type'    => 'radio',
					'choices' => $data['inherit'],
					'vardump' => 'inherit'
				);

				// Reset the options array and set the default to the first option.
				reset( $data['inherit'] );
				$_data['default'] = key( $data['inherit'] );

				// Add the current setting_id to the choices array as "Custom".
				$_data['choices'][$setting_id] = 'Custom';

				// Remove the label from the parent setting.
				$data['label'] = '';

				// Create inherit setting.
				$this->settings[ $setting_id . '_inherit' ] = $_data;
			endif;
			$data['vardump'] = $data['type'];
			$this->settings[ $setting_id ] = $data;
		endif;
	}

	/**
	 * Adds or updates multiple settings.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param array $settings Array of settings to add or update
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
	 * @param string $setting_id     Settings to retrieve
	 * @param bool   $show_reference Reference a Sass variable instead of a value.
	 */
	public function get_setting( $setting_id, $show_reference = false ) {
		if ( array_key_exists( $setting_id . '_inherit', $this->settings ) ) :
			$_data = $this->settings[$setting_id . '_inherit'];
			$_setting_id = get_theme_mod( $this->namespace . $setting_id . '_inherit', $_data['default'] );

			if ( $show_reference && $setting_id !== $_setting_id ) {
				return '$' . $_setting_id;
			}

			$setting_id = $_setting_id;
		endif;

		$data = $this->settings[$setting_id];
		$value = get_theme_mod( $this->namespace . $setting_id, $data['default'] );

		if ( $data['type'] === 'image' || $data['type'] === 'textarea' || $value === '' ) :
			$value = "'" . $value . "'";
		endif;

		if ( $data['type'] === 'checkbox' ) :
			if ( $value ) :
				$value = 'true';
			else :
				$value = 'false';
			endif;
		endif;

		if ( isset( $data['units'] ) ) :
			$value .= $data['units'];
		endif;

		return $value;
	}

	/**
	 * Registers the Customizer settings
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param object $wp_customize Instance of the WP_Customize_Control object.
	 */
	public function register( $wp_customize ) {
		// Ensure at least one panel will be added.
		$this->test_panels();

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
	 * Creates Customizer controls
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @param object $wp_customize Instance of the WP_Customize_Control object
	 * @param string $setting_id   Id of the setting to be added
	 * @param array  $data         Setting data
	 */
	private function add_control( $wp_customize, $setting_id, $data ) {

		if ( array_key_exists('section', $data ) ) :
			$data['section'] = $this->namespace . $data['section'];
		endif;
		$setting_id = $this->namespace . $setting_id;

		$wp_customize->add_setting( $setting_id, array(
			'default' => $data['default']
		) );

		switch( $data['type'] ) :

			case 'title' :
				$wp_customize->add_control(
					new WPCSASS_Insert_HTML(
						$wp_customize,
						$setting_id,
						array(
							'label'    => '<h1 class="wpcsass_title">' . $data['label'] . '</h1>',
							'section'  => $data['section'],
							'settings' => $setting_id
						)
					)
				);
				break;

			case 'subtitle' :
				$wp_customize->add_control(
					new WPCSASS_Insert_HTML(
						$wp_customize,
						$setting_id,
						array(
							'label'    => '<h3 class="wpcsass_subtitle">' . $data['label'] . '</h3>',
							'section'  => $data['section'],
							'settings' => $setting_id
						)
					)
				);
				break;

			case 'description' :
				$wp_customize->add_control(
					new WPCSASS_Insert_HTML(
						$wp_customize,
						$setting_id,
						array(
							'description' => $data['description'],
							'section'     => $data['section'],
							'settings'    => $setting_id
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
								'settings' => $setting_id
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
								'settings' => $setting_id
							)
						)
					);
				endif;
				break;

			case 'radio' :
				$wp_customize->add_control(
					new WPCSASS_Radio(
						$wp_customize,
						$setting_id,
						array(
							'label'    => $data['label'],
							'section'  => $data['section'],
							'settings' => $setting_id,
							'type'     => $data['type'],
							'choices'  => $data['choices']
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
							'choices'  => $data['choices']
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
							'settings' => $setting_id
						)
					)
				);
				break;

			case 'range' :
				$wp_customize->add_control(
					new WPCSASS_Range(
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
								'step' => $data['range']['step']
							)
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
							'default'  => $data['default']
						)
					)
				);
				break;
		endswitch;
	}

	/**
	 * Compile Sass
	 *
	 * @param array $settings settings to pass to Sass
	 * @since 1.0.0
	 */
	public function compile() {
		$variables = array();
		$var_dump = "";
		foreach ( $this->settings as $setting_id => $data ) :
			if ( $data['vardump'] === 'title' ) :
				// Add label to string as comment.
				$var_dump .= "\n// " . $data['label'] . "\n";
			elseif ( $data['vardump'] === 'subtitle' ) :
				// Add label to string as comment.
				$var_dump .= "// " . $data['label'] . "\n";
			elseif ( array_key_exists( $data['type'], $this->section_generators ) ) :
				continue;
			elseif ( ! in_array( $data['type'], $this->comment_types ) ) :
				// Get setting value
				$value = $this->get_setting( $setting_id, true );

				// Add value to results array
				$variables[$setting_id] = $value;

				// Add $ if it's a reference to another variable
				if ( $data['vardump'] === 'inherit' ) :
					$value = '$' . $value;
				endif;

				// Add value to string.
				$var_dump .= "\$$setting_id: $value;\n";
			endif;
		endforeach;

		// Save $var_dump to Sass dump file.
		file_put_contents( $this->file_sass_vardump, $var_dump );

		// Load scssphp compiler.
		require plugin_dir_path( __FILE__ ) . '/scssphp/scss.inc.php';
		$scss = new Leafo\ScssPhp\Compiler;

		// Set import directory.
		$scss->setImportPaths( $this->file_sass_input_directory );

		// Set variables.
		$scss->setVariables( $variables );

		// Save css to file.
		file_put_contents( $this->file_sass_output, $scss->compile( '@import "' . $this->sass_entry_point . '"' ) );
	}

	/**
	 * Push CSS live
	 *
	 * @since 1.0.0
	 */
	public function push_live() {
		// Get live css file path without the .css extension
		$target = substr( $this->file_live_css, 0, -4 );

		for ($i = $this->css_backup_quantity; $i > 0; $i--) {
			if ( $i > 1 ) {
				$prev = '.backup' . ( $i - 1 );
			} else {
				$prev = '';
			}
			rename( "$target$prev.css", "$target.backup$i.css" );
		}
		copy( $this->file_sass_output, $this->file_live_css );
	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$template_directory = get_stylesheet_directory();

		$this->set_sass_input_directory( $template_directory . '/sass/' );
		$this->set_sass_output_directory( $template_directory . '/sass_output/' );
		$this->set_sass_vardump( $this->file_sass_input_directory . '_customizer_variables.scss' );
		$this->set_sass_output( $this->file_sass_output_directory . 'style.css' );
		$this->set_live_stylesheet( $template_directory . '/style.css' );

		add_action( 'customize_register', array( $this, 'register' ) );
		add_action( 'customize_preview_init', array( $this, 'compile') );
		add_action( 'customize_save_after', array( $this, 'compile' ) );
		add_action( 'customize_save_after', array( $this, 'push_live' ), 11 );
	}
}
endif;
?>

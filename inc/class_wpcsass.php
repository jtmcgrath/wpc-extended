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
	 * Settings added to the Customizer programatically.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var array
	 */
	private $dynamic_settings = array();

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
	 * Settings array for the background_section shorthand.
	 *
	 * @since 1.0.0
	 * @access private
	 * @var array
	 */
	var $background_section = array(
		'_color' => array(
			'label'     => 'Color',
			'type'      => 'color',
			'attribute' => 'background-color'
		),
		'_bgimage' => array(
			'label'   => 'Image',
			'type'    => 'image',
			'default' => ''
		),
		'_repeat' => array(
			'label'     => 'Repeat',
			'type'      => 'radio',
			'default'   => 'no-repeat',
			'choices'   => array(
				'no-repeat' => 'No Repeat',
				'repeat'    => 'Tile',
				'repeat-x'  => 'Tile Horizontally',
				'repeat-y'  => 'Tile Vertically'
			),
			'attribute' => 'background-repeat'
		),
		'_position' => array(
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
		'_attachment' => array(
			'label'     => 'Attachment',
			'type'      => 'radio',
			'default'   => 'scroll',
			'choices'   => array(
	   			'scroll' => 'Scroll',
	   			'fixed'  => 'Fixed'
	   		),
			'attribute' => 'background-attachment'
		),
		'_size' => array(
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
	 * @param string $path Location for the Sass vardump file
	 */
	public function set_sass_vardump( $path ) {
		$this->file_sass_vardump = $path;
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
	public function set_live_css_location( $file ) {
		$this->file_live_css = $file;
	}

	/**
	 * Adds or updates Customizer panels.
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
	 * Adds or updates Customizer sections.
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
	 * Adds or updates existing settings.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @param string $setting_id Id of the setting to add or update
	 * @param string $data       An associative array containing arguments for the setting
	 */
	public function add_setting( $setting_id, $data ) {
		$this->settings[ $setting_id ] = $data;
	}

	/**
	 * Adds or updates existing dynamic settings.
	 *
	 * @since 1.0.0
	 * @access private
	 *
	 * @param string $setting_id Id of the setting to add or update
	 * @param string $data       An associative array containing arguments for the setting
	 */
	private function add_dynamic_setting( $setting_id, $data ) {
		$this->dynamic_settings[ $setting_id ] = $data;
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
			if ( $data['type'] === 'background_section' ) :
				foreach ( $this->background_section as $setting_suffix => $setting_data ) :
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
						$data['default'] = $data['default_color'];

						if ( $data['alpha'] ) :
							$_data['alpha'] = true;
						endif;
					else :
						$_data['default'] = $setting_data['default'];
					endif;

					$this->add_control( $wp_customize, $_setting_id, $_data );
					$this->add_dynamic_setting( $_setting_id, $_data );
				endforeach;
			else :
				$this->add_control( $wp_customize, $setting_id, $data );
			endif;
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
		endswitch;
	}

	/**
	 * Compile Sass
	 *
	 * @param array $settings settings to pass to Sass
	 * @since 1.0.0
	 */
	public function compile() {
		$all_settings = array_merge( $this->settings, $this->dynamic_settings );

		$variables = array();
		$var_dump = "";
		foreach ( $all_settings as $setting_id => $data ) :
			if ( $data['type'] === 'title' ) :
				// Add label to string as comment.
				$var_dump .= "\n// " . $data['label'] . "\n";
			elseif ( $data['type'] === 'subtitle' ) :
				// Add label to string as comment.
				$var_dump .= "// " . $data['label'] . "\n";
			elseif ( $data['type'] === 'background_section' ) :
			  continue;
			elseif ( ! in_array( $data['type'], $this->comment_types ) ) :
				// Get setting value
				$value = get_theme_mod( $this->namespace . $setting_id, $data['default'] );

				if ( $data['type'] === 'image' ) :
					$value = "'" . $value . "'";
				endif;

				if ( $data['units'] ) :
					$value += $data['units'];
				endif;

				// Add value to results array
				$variables[$setting_id] = $value;

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
		file_put_contents( $this->file_sass_output, $scss->compile( '@import "style.scss"' ) );
	}

	/**
	 * Push CSS live
	 *
	 * @since 1.0.0
	 */
	public function push_live() {
		copy( $this->file_live_css, $this->file_live_css . '.backup' );
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
		$this->set_live_css_location( $template_directory . '/style.css' );

		add_action( 'customize_register', array( $this, 'register' ) );
		add_action( 'customize_preview_init', array( $this, 'compile') );
		add_action( 'customize_save_after', array( $this, 'compile' ) );
		add_action( 'customize_save_after', array( $this, 'push_live' ), 11 );
	}
}
endif;
?>

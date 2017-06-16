<?php
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Customize_Alpha_Color_Control ' ) ) :
require plugin_dir_path( __FILE__ ) . 'alpha-color-picker/alpha-color-picker.php';
endif;


if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'WPC_Extended_Insert_HTML' ) ) :
class WPC_Extended_Insert_HTML extends WP_Customize_Control {
	public $content = '';
	public function render_content() {
		if ( isset( $this->label ) ) :
			echo $this->label;
		endif;
		if ( isset( $this->content ) ) :
			echo $this->content;
		endif;
		if ( isset( $this->description ) ) :
			echo $this->description;
		endif;
	}
}
endif;



if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'WPC_Extended_Radio' ) ) :
class WPC_Extended_Radio extends WP_Customize_Control {
	public function render_content() {
		if ( empty( $this->choices ) ) :
			return;
		endif;

		$name = '_customize-radio-' . $this->id;
		$label = empty( $this->label ) ? '' : '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
		$description = empty( $this->description ) ? '' : '<span class="description customize-control-description">' .  $this->description . '</span>';
		?>
		<div class="wpc_extended_radio <?php echo esc_html( $this-> id ); ?>">
			<?php echo $label; ?>
			<?php echo $description; ?>
			<?php foreach ( $this->choices as $value => $label ) : ?>
			<label>
				<input type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
				<span class="button"><?php echo esc_html( $label ); ?></span>
			</label>
			<?php endforeach; ?>
		</div>
		<?php
	}
}
endif;



if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'WPC_Extended_Range' ) ) :
class WPC_Extended_Range extends WP_Customize_Control {
	public function render_content() {
		$label = empty( $this->label ) ? '' : '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
		$description = empty( $this->description ) ? '' : $this->description;

		?>
		<div class="wpc_extended_range <?php echo esc_html( $this-> id ); ?>">
			<?php echo $label; ?>
			<label>
				<input type="range" <?php $this->input_attrs(); ?> value="<?php echo esc_attr( $this->value() ); ?>" />
				<div>
					<input type="text" <?php $this->input_attrs(); ?> value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); ?> />
					<?php echo $description; ?>
				</div>
			</label>
		</div>
		<?php
	}
}
endif;



if ( ! function_exists( 'wpc_extended_customizer_script' ) ) :
function wpc_extended_customizer_script() {
	$theme_settings = WPC_Extended::Instance();

	wp_register_script( 'customizer-admin', plugins_url() . '/wpc-extended/js/customizer-admin.js', array(), true, true );
	wp_localize_script( 'customizer-admin', 'wpc_extended_conditional_logic', $theme_settings->get_conditional_logic() );
	wp_enqueue_script( 'customizer-admin' );
}
add_action( 'customize_controls_enqueue_scripts', 'wpc_extended_customizer_script', 10 );
endif;



if ( ! function_exists( 'wpc_extended_customizer_stylesheet' ) ) :
function wpc_extended_customizer_stylesheet() { ?>
<style type="text/css">
#customize-controls .wpc_extended_title,
#customize-controls .wpc_extended_subtitle {
  border-bottom: 1px solid rgba(0,0,0,0.1);
  color: #555;
  line-height: 1.2;
  margin: 0 !important;
  padding: 0 0 4px;
  text-align: center;
}

#customize-controls .wpc_extended_subtitle {
  color: #777;
}

#customize-controls .wpc_extended_radio {
  font-size: 0;
  margin-top: -16px;
}

#customize-controls .wpc_extended_radio label {
  box-sizing: border-box;
  display: inline-block;
  font-size: 13px;
  margin: 0;
  padding: 2px;
  width: 50%;
}

#customize-controls .wpc_extended_radio input {
  display: none;
  visibility: hidden;
}

#customize-controls .wpc_extended_radio label span {
  display: block;
  font-size: inherit;
  height: auto;
  line-height: 1;
  padding: 8px;
  text-align: center;
  white-space: normal;
}

#customize-controls .wpc_extended_radio :focus + span {
  border-color: #5b9dd9;
  -webkit-box-shadow: 0 0 3px rgba(0,115,170,.8);
  box-shadow: 0 0 3px rgba(0,115,170,.8);
}

#customize-controls .wpc_extended_radio :checked + span {
  background: #eee;
  border-color: #999;
  -webkit-box-shadow: inset 0 2px 5px -3px rgba(0, 0, 0, .5);
  box-shadow: inset 0 2px 5px -3px rgba(0, 0, 0, .5);
}

#customize-controls .wpc_extended_radio :checked + span:before {
  border: 2px solid #555;
  border-left: none;
  border-radius: 2px;
  border-top: none;
  content: '';
  display: inline-block;
  width: 4px;
  height: 10px;
  margin: 0 4px 0 -4px;
  transform: rotate(45deg);
}

#customize-controls .wpc_extended_radio[class*='_bgposition'] label span {
  align-items: center;
  display: flex;
  height: 40px;
  line-height: 13px;
  white-space: normal;
  justify-content: center;
}

#customize-controls .wpc_extended_radio[class*='_bgposition'] :checked + span {
  text-align: left;
}

#customize-controls .wpc_extended_radio label:first-of-type:nth-last-of-type(3n),
#customize-controls .wpc_extended_radio label:first-of-type:nth-last-of-type(3n) ~ label {
  font-size: 13px;
  width: 33%;
  width: calc(100% / 3);
}

#customize-controls .wpc_extended_range label {
  align-items: center;
  display: flex;
}

#customize-controls .wpc_extended_range label input {
  cursor: pointer;
  flex: 1 1 100%;
}

#customize-controls .wpc_extended_range label div {
  background: #f7f7f7;
  border: 1px solid #ccc;
  border-radius: 3px;
  cursor: default;
  line-height: 24px;
  padding: 0 8px 0 4px;
  position: relative;
  white-space: nowrap;
}

#customize-controls .wpc_extended_range label div:before {
  background: inherit;
  border: inherit;
  border-top: none;
  border-right: none;
  content: '';
  display: block;
  height: 6px;
  left: 0;
  margin: -4px;
  position: absolute;
  top: 50%;
  width: 6px;
  transform: rotate(45deg);
}

#customize-controls .wpc_extended_range label div input {
  background: transparent;
  border: 1px solid transparent;
  border-radius: 3px;
  box-shadow: none;
  display: inline;
  line-height: 16px;
  margin: 3px 0;
  padding: 0;
  text-align: right;
  vertical-align: bottom;
  width: 40px;
}

#customize-controls .wpc_extended_range label div input:focus {
  -webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,.07);
  border-color: #ddd;
  box-shadow: inset 0 1px 2px rgba(0,0,0,.07);
}

#customize-controls [id$='_inherit'] {
  margin-bottom: 0;
}
</style>
<?php
}
add_action( 'customize_controls_print_styles', 'wpc_extended_customizer_stylesheet' );
endif;
?>

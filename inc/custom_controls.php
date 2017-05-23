<?php
if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Customize_Alpha_Color_Control ' ) ) :
require plugin_dir_path( __FILE__ ) . 'alpha-color-picker/alpha-color-picker.php';
endif;


if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'WPCSASS_Insert_HTML' ) ) :
class WPCSASS_Insert_HTML extends WP_Customize_Control {
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



if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'WPCSASS_Radio' ) ) :
class WPCSASS_Radio extends WP_Customize_Control {
	public function render_content() {
		if ( empty( $this->choices ) ) :
			return;
		endif;

		$name = '_customize-radio-' . $this->id;
		$label = empty( $this->label ) ? '' : '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
		$description = empty( $this->description ) ? '' : '<span class="description customize-control-description">' .  $this->description . '</span>';
		?>
		<div class="wpcsass_radio <?php echo esc_html( $this-> id ); ?>">
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



if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'WPCSASS_Range' ) ) :
class WPCSASS_Range extends WP_Customize_Control {
	public function render_content() {
		$label = empty( $this->label ) ? '' : '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
		$description = empty( $this->description ) ? '' : $this->description;

		?>
		<div class="wpcsass_range <?php echo esc_html( $this-> id ); ?>">
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



if ( ! function_exists('wpcsass_customizer-admin-js') ) :
function wpcsass_customizer() {
    wp_enqueue_script( 'customizer-admin', plugins_url() . '/wpcsass/js/customizer-admin.js', array(), true, true );
}
add_action( 'customize_controls_enqueue_scripts', 'wpcsass_customizer' );
endif;



if ( ! function_exists( 'wpcsass_customizer_stylesheet' ) ) :
function wpcsass_customizer_stylesheet() { ?>
<style type="text/css">
#customize-controls .wpcsass_title,
#customize-controls .wpcsass_subtitle {
  border-bottom: 1px solid rgba(0,0,0,0.1);
  color: #555;
  line-height: 1.2;
  margin: 0 !important;
  padding: 0 0 4px;
  text-align: center;
}

#customize-controls .wpcsass_subtitle {
  color: #777;
}

#customize-controls .wpcsass_radio {
  font-size: 0;
  margin-top: -16px;
}

#customize-controls .wpcsass_radio label {
  box-sizing: border-box;
  display: inline-block;
  font-size: 13px;
  margin: 0;
  padding: 2px;
  width: 50%;
}

#customize-controls .wpcsass_radio input {
  display: none;
  visibility: hidden;
}

#customize-controls .wpcsass_radio label span {
  display: block;
  font-size: inherit;
  text-align: center;
}

#customize-controls .wpcsass_radio :focus + span {
  border-color: #5b9dd9;
  -webkit-box-shadow: 0 0 3px rgba(0,115,170,.8);
  box-shadow: 0 0 3px rgba(0,115,170,.8);
}

#customize-controls .wpcsass_radio :checked + span {
  background: #eee;
  border-color: #999;
  -webkit-box-shadow: inset 0 2px 5px -3px rgba(0, 0, 0, .5);
  box-shadow: inset 0 2px 5px -3px rgba(0, 0, 0, .5);
}

#customize-controls .wpcsass_radio :checked + span:before {
  border: 2px solid #555;
  border-left: none;
  border-radius: 2px;
  border-top: none;
  content: '';
  display: inline-block;
  width: 4px;
  height: 10px;
  margin-right: 10px;
  transform: rotate(45deg);
}

#customize-controls .wpcsass_radio[class*='background_position'] label span {
  align-items: center;
  display: flex;
  height: 40px;
  line-height: 13px;
  white-space: normal;
  justify-content: center;
}

#customize-controls .wpcsass_radio[class*='background_position'] :checked + span {
  text-align: left;
}

#customize-controls .wpcsass_radio label:first-of-type:nth-last-of-type(3n),
#customize-controls .wpcsass_radio label:first-of-type:nth-last-of-type(3n) ~ label {
  font-size: 13px;
  width: 33%;
  width: calc(100% / 3);
}

#customize-controls .wpcsass_range label {
  align-items: center;
  display: flex;
}

#customize-controls .wpcsass_range label input {
  cursor: pointer;
  flex: 1 1 100%;
}

#customize-controls .wpcsass_range label div {
  background: #f7f7f7;
  border: 1px solid #ccc;
  border-radius: 3px;
  cursor: default;
  line-height: 24px;
  padding: 0 8px 0 4px;
  position: relative;
  white-space: nowrap;
}

#customize-controls .wpcsass_range label div:before {
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

#customize-controls .wpcsass_range label div input {
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

#customize-controls .wpcsass_range label div input:focus {
  -webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,.07);
  border-color: #ddd;
  box-shadow: inset 0 1px 2px rgba(0,0,0,.07);
}
</style>
<?php
}
add_action( 'customize_controls_print_styles', 'wpcsass_customizer_stylesheet' );
endif;
?>

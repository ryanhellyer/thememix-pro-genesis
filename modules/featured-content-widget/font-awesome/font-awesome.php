<?php

/**
 * Enqueue dashicons picker scripts.
 */
function dashicons_picker_scripts() {

	// Only load when on the widgets admin page
	if ( 'widgets.php' != basename( $_SERVER['REQUEST_URI'] ) ) {
		return;
	}

	$plugin_url = plugin_dir_url( __FILE__ );

	wp_enqueue_style( 'dashicons-picker',  $plugin_url . 'css/dashicons-picker.css', array( 'dashicons' ), '1.0', false );
	wp_enqueue_script( 'dashicons-picker', $plugin_url . 'js/dashicons-picker.js',   array( 'jquery'    ), '1.1', true  );
}
add_action( 'admin_enqueue_scripts', 'dashicons_picker_scripts' );

function themefix_font_awesome_settings_extension( $args ) {

	$args['col2'][] = array(
		'font-awesome'             => array(
			'label'       => __( 'Display Font Awesome icon', 'thememixfc' ),
			'description' => '',
			'type'        => 'checkbox',
		),
		'fontawesome-icon' => array(
			'label'       => __( 'Icon', 'thememixfc' ),
			'description' => '',
			'type'        => 'fontawesome',
			'requires'    => array(
				'font-awesome',
				'',
				true
			),
		),

		'fontawesome-size' => array(
			'label'       => __( 'Size', 'thememixfc' ),
			'description' => '',
			'type'        => 'select',
			'options'     => array(
				'lg' => __( 'Normal', 'thememix-pro-genesis' ),
				'1x' => '1x',
				'2x' => '2x',
				'3x' => '3x',
				'4x' => '4x',
				'5x' => '5x',
				'6x' => '6x',
			),
			'requires'    => array(
				'font-awesome',
				'',
				true
			),
		),


		'fontawesome-position' => array(
			'label'       => __( 'Position', 'thememixfc' ),
			'description' => '',
			'type'        => 'select',
			'options'     => array(
				'before_title'        => __( 'Before title (centered)', 'thememix-pro-genesis' ),
				'inline_before_title' => __( 'Inline before title', 'thememix-pro-genesis' ),
				'inline_after_title'  => __( 'Inline after title', 'thememix-pro-genesis' ),
				'after_title'         => __( 'After title (centered)', 'thememix-pro-genesis' ),
			),
			'requires'    => array(
				'font-awesome',
				'',
				true
			),
		),

	);


	return $args;
}
add_filter( 'thememixfc_form_fields', 'themefix_font_awesome_settings_extension' );



function thememixfc_top_fontawesome() {
	$settings = get_option( 'widget_featured-content' );
	if ( isset( $settings[3]['font-awesome'] ) && isset( $settings[3]['fontawesome-icon'] ) ) {
		if ( 1 == $settings[3]['font-awesome'] ) {
			$icon     = $settings[3]['fontawesome-icon'];
			$position = $settings[3]['fontawesome-position'];
	echo $position."\n";
	echo $icon."\n\n\n\n\n";
		}
	}
}
add_action( 'thememixfc_before_post_content', 'thememixfc_top_fontawesome' );

function themefix_fontawesome_init() {
	$settings = get_option( 'widget_featured-content' );
	if ( isset( $settings[3]['font-awesome'] ) && 1 == $settings[3]['font-awesome'] && isset( $settings[3]['fontawesome-position'] ) ) {
		$position = $settings[3]['fontawesome-position'];

		$positions = array(
			'inline_before_title',
			'inline_after_title',
		);
		if ( in_array( $position, $positions ) ) {
			add_filter( 'thememixfc_post_title_pattern', 'thememixfc_' . $position . '_fontawesome' );
		}

		if ( 'before_title' == $position ) {
			add_action( 'thememixfc_before_post_content', 'thememixfc_' . $position . '_fontawesome', 1 );
		}

		if ( 'after_title' == $position ) {
			add_action( 'thememixfc_after_post_content', 'thememixfc_' . $position . '_fontawesome' );
		}

	}

}
add_action( 'init', 'themefix_fontawesome_init' );

function thememixfc_before_title_fontawesome() {
	echo '<div style="width:100%;text-align:center;"><span class="fa fa-camera-retro fa-' . thememixfc_get_size_fontawesome() . '"></span></div>';
}

function thememixfc_after_title_fontawesome() {
	echo '<div style="width:100%;text-align:center;"><span class="fa fa-camera-retro fa-' . thememixfc_get_size_fontawesome() . '"></span></div>';
}

function thememixfc_get_size_fontawesome() {

	$settings = get_option( 'widget_featured-content' );
	if ( isset( $settings[3]['fontawesome-size'] ) ) {
		$size = $settings[3]['fontawesome-size'];
	} else {
		$size = 'lg';
	}

	return $size;
}

function thememixfc_inline_before_title_fontawesome( $content ) {
	$content = str_replace( '%s%s%s', '%s<span class="fa fa-camera-retro fa-' . thememixfc_get_size_fontawesome() . '"></span>%s%s', $content );
	return $content;
}

function thememixfc_inline_after_title_fontawesome( $content ) {
	$content = str_replace( '%s%s%s', '%s%s<span class="fa fa-camera-retro fa-' . thememixfc_get_size_fontawesome() . '"></span>%s', $content );
	return $content;
}

/**
 * Add Font Awesome stylesheet.
 */
function thememixfc_fontawesome_styles() {
	$plugin_url = plugin_dir_url( __FILE__ );
	wp_enqueue_style( 'font-awesome',  $plugin_url . 'css/font-awesome.min.css', array(), '1.0', false );
}
add_action( 'wp_enqueue_scripts', 'thememixfc_fontawesome_styles' );

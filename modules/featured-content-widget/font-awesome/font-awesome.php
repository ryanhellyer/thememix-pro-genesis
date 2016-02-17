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

		'fontawesome-colour' => array(
			'label'       => __( 'Colour', 'thememixfc' ),
			'description' => '',
			'type'        => 'colour_picker',
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

function thememixfc_span_fontawesome( $key ) {

	$settings = get_option( 'widget_featured-content' );
	if ( ! isset( $settings[$key]['font-awesome'] ) || '' == $settings[$key]['font-awesome'] ) {
		return;
	}

	if ( isset( $settings[$key]['fontawesome-icon'] ) ) {
		$icon = $settings[$key]['fontawesome-icon'];
	} else {
		$icon = 'dashicons-admin-site';
	}

	echo '<div style="width:100%;text-align:center;"><span class="' . esc_attr( 'dashicons ' . $icon . ' icon-size-' . thememixfc_get_size_fontawesome( $key ) ) . '"></span></div>';
}

function thememixfc_get_size_fontawesome( $key ) {

	$settings = get_option( 'widget_featured-content' );
	if ( isset( $settings[$key]['fontawesome-size'] ) ) {
		$size = $settings[$key]['fontawesome-size'];
	} else {
		$size = 'lg';
	}

	return $size;
}

/**
 * Add Font Awesome stylesheet.
 */
function thememixfc_fontawesome_styles() {
	$plugin_url = plugin_dir_url( __FILE__ );
	wp_enqueue_style( 'dashicon-sizes',  $plugin_url . 'css/dashicons.css', array( 'dashicons' ), '1.0', false );
}
add_action( 'wp_enqueue_scripts', 'thememixfc_fontawesome_styles' );

/**
 * Add Font Awesome related stylesheets.
 */
function thememixfc_fontawesome_color_picker_style() {
	wp_enqueue_style('farbtastic');	
}
add_action( 'admin_print_scripts-widgets.php', 'thememixfc_fontawesome_color_picker_style' );

/**
 * Add Farbtastic colour picker script.
 */
function thememixfc_fontawesome_color_picker_script() {
	wp_enqueue_script('farbtastic');
}
add_action('admin_print_scripts-widgets.php', 'thememixfc_fontawesome_color_picker_script');



function sample_load_color_picker_script() {
	wp_enqueue_script('farbtastic');
}
function sample_load_color_picker_style() {
	wp_enqueue_style('farbtastic');	
}
add_action('admin_print_scripts-widgets.php', 'sample_load_color_picker_script');
add_action('admin_print_styles-widgets.php', 'sample_load_color_picker_style');

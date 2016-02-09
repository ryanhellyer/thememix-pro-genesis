<?php

/**
 * Enqueue dashicons picker scripts.
 */
function dashicons_picker_scripts() {

	$plugin_url = plugin_dir_url( __FILE__ );

	wp_enqueue_style( 'dashicons-picker',  $plugin_url . 'css/dashicons-picker.css', array( 'dashicons' ), '1.0', false );
	wp_enqueue_script( 'dashicons-picker', $plugin_url . 'js/dashicons-picker.js',   array( 'jquery'    ), '1.1', true  );
}
add_action( 'admin_enqueue_scripts', 'dashicons_picker_scripts' );





add_filter( 'thememixfc_form_fields', 'themefix_font_awesome_settings_extension' );
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

		'fontawesome-position' => array(
			'label'       => __( 'Position', 'thememixfc' ),
			'description' => '',
			'type'        => 'select',
			'options'     => array(
				'top'    => __( 'Top', 'thememix-pro-genesis' ),
				'middle' => __( 'Middle', 'thememix-pro-genesis' ),
				'bottom' => __( 'Bottom', 'thememix-pro-genesis' ),
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

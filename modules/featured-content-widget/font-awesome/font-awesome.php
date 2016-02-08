<?php

add_filter( 'thememixfc_form_fields', 'themefix_font_awesome_settings_extension' );
function themefix_font_awesome_settings_extension( $args ) {

	require( 'icons.php' );

	$args['col2'][] = array(
		'font-awesome'             => array(
			'label'       => __( 'Display Font Awesome icon', 'thememixfc' ),
			'description' => '',
			'type'        => 'checkbox',
		),
		'fontawesome-icon' => array(
			'label'       => __( 'Icon', 'thememixfc' ),
			'description' => '',
			'type'        => 'select',
			'options'     => $icons,
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

<?php

add_filter( 'thememixfc_form_fields', 'themefix_buddypress_groups_settings_extension' );
function themefix_buddypress_groups_settings_extension( $args ) {

	$groups = BP_Groups_Group::get(array(
		'type'     => 'alphabetical',
		'per_page' => 100
	));
	$the_groups = array();
	foreach ( $groups['groups'] as $key => $group ) {
		$the_groups[$group->id] = $group->name;
	}

	$extra = array(
		'buddypress-group' => array(
			'label'       => __( 'Display a BuddyPress Group activity instead of post(s)', 'thememixfc' ),
			'description' => '',
			'type'        => 'checkbox',
		),
		'buddypress-group-group' => array(
			'label'       => __( 'BuddyPress Group', 'thememixfc' ),
			'description' => '',
			'type'        => 'select',
			'options'     => $the_groups,
			'requires'    => array(
				'buddypress-group',
				'',
				true
			),
		),
	);

	$args['col1'][0] = array_slice( $args['col1'][0], 0, 1, true ) +
		$extra +
		array_slice( $args['col1'][0], 1, count( $args['col1'][0] ) - 1, true) ;

	return $args;
}

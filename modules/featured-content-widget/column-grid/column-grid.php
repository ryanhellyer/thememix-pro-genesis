<?php

$thememixfc_grid_counter = 0;

function bla_after() {
	global $thememixfc_grid_counter;
	$thememixfc_grid_counter++;
}
add_action( 'thememixfc_after_post_content', 'bla_after' );


function bla_styling() {
	global $thememixfc_grid_counter;

	// Find chosen number of columns
	$settings = get_option( 'widget_featured-content' );
	if ( isset( $settings[3]['column-grid'] ) ) {
		$chosen_number_of_columns = $settings[3]['column-grid'];
	} else {
		$chosen_number_of_columns = 1;
	}

	// Set actual number of columns based on how many posts are being loaded (no point in doing 25% width for a single post)
	if ( $thememixfc_grid_counter < $chosen_number_of_columns ) {
		$actual_number_of_columns = $thememixfc_grid_counter;
	} else {
		$actual_number_of_columns = $chosen_number_of_columns;
	}

	if ( $actual_number_of_columns > 1 ) {
		echo '<style>.featured-content article, .featured-content li {float:left;width:';

		if ( 2 == $actual_number_of_columns ) {
			echo '50';
		} elseif ( 3 == $actual_number_of_columns ) {
			echo '33.3';
		} elseif ( 4 == $actual_number_of_columns ) {
			echo '25';
		}

		echo '%}</style>';
	}

}
add_action( 'wp_footer', 'bla_styling' );




add_filter( 'thememixfc_form_fields', 'themefix_column_grid_settings_extension' );
function themefix_column_grid_settings_extension( $args ) {

	$args['col2'][] = array(
		'column-grid' => array(
			'label'       => __( 'Number of columns', 'thememixfc' ),
			'description' => '',
			'type'        => 'select',
			'options'     => array(
				1 => 1, 2 => 2, 3 => 3, 4 => 4,
			),
		),
	);


	return $args;
}

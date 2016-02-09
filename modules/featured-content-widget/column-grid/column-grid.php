<?php

$thememixfc_grid_counter = 0;

function bla_after() {
	global $thememixfc_grid_counter;
	$thememixfc_grid_counter++;
}
add_action( 'thememixfc_after_post_content', 'bla_after' );


function bla_styling() {
	global $thememixfc_grid_counter;

	echo '<style>.featured-content article {float:left;width:';

	if ( 1 == $thememixfc_grid_counter ) {
		echo '100';
	} elseif ( 2 == $thememixfc_grid_counter ) {
		echo '50';
	} elseif ( 3 == $thememixfc_grid_counter ) {
		echo '33';
	}

	echo '%}</style>';

}
add_action( 'wp_footer', 'bla_styling' );

<?php

$file = dirname( __FILE__ ) . '/css/font-awesome.css';
$css = file_get_contents( $file );

$before = explode( ':before {', $css );

$js = "var all_font_awesome_icons = [\n";
foreach ( $before as $key => $item ) {

	if ( 0 == $key ) {
		continue;
	} elseif ( 1 != $key ) {
		$item_before = $before[$key - 1];
		$exploded = explode( '";
}', $item_before );
		$selector = str_replace( '.fa-', '', $exploded[1] );
		$selector = str_replace( "\n", '', $selector );
	} else {
		$selector = 'glass';
	}

		print_r( $item );
		echo "\n\n\n";
	if ( $selector == 'remove:before,close:before,times') {
		echo "\n\n\n";
		print_r( $item );
		die;
	}

	$exploded = explode( 'content: "', $item );
	$exploded_again = explode( '";', $exploded[1] );
	$content = $exploded_again[0];

	$js .= "	'" . $selector . "',\n";


	$font_awesome_items[$selector] = $content;
}

$js .= "];";

file_put_contents( dirname( __FILE__ ) . '/js/font-awesome-icons.js', $js );
die;
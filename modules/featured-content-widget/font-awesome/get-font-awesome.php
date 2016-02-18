<?php

$file = dirname( __FILE__ ) . '/css/font-awesome.css';
$css = file_get_contents( $file );

$before = explode( ':before {', $css );

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

	$exploded = explode( 'content: "', $item );
	$exploded_again = explode( '";', $exploded[1] );
	$content = $exploded_again[0];

echo "			'" . $selector . "',\n";


	$font_awesome_items[$selector] = $content;
}
die;
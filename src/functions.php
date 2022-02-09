<?php

use PhpKnight\WpDd\Dumper;

if ( ! function_exists( 'dd' ) ) {
	function dd( ...$args ) {
		foreach ( $args as $arg ) {
			Dumper::dump( $arg );
		}
		die(1);
	}
}

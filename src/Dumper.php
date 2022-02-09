<?php

namespace PhpKnight\WpDd;

use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\CliDumper;
use Symfony\Component\VarDumper\Dumper\HtmlDumper;

/**
 * Class Dumper
 * Handles dumping of data.
 *
 * @package PhpKnight\WpDd
 */
class Dumper {

	/**
	 * Dumps the given variable.
	 *
	 * @access public
	 *
	 * @param mixed $value
	 *
	 * @throws \ErrorException
	 *
	 * @return void
	 */
	public static function dump( $value ): void {
		if ( class_exists(CliDumper::class ) ) {
			$dumper = 'cli' === PHP_SAPI ? new CliDumper : new HtmlDumper;

			$dumper->dump( ( new VarCloner )->cloneVar( $value ), true );
		} else {
			var_dump( $value );
		}
	}

	/**
	 * Debug Dumps the given variable.
	 *
	 * @access public
	 *
	 * @param mixed $value
	 *
	 * @throws \ErrorException
	 *
	 * @return string
	 */
	public static function debug_dump( $value ): string {
		if ( class_exists(CliDumper::class ) ) {
			$dumper = 'cli' === PHP_SAPI ? new CliDumper : new HtmlDumper;

			$data = ( new VarCloner )->cloneVar( $value );

			return rtrim ( $dumper->dump( $data, true ) );
		} else {
			ob_start();
			var_dump( $value );
			return rtrim( ob_get_clean() );
		}
	}
}

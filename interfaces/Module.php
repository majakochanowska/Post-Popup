<?php
/**
 * Module interface
 *
 * @package post-popup
 */

namespace Maja\PostPopup\Interfaces;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Module interface
 */
interface Module {

	/**
	 * Register hooks
	 */
	public static function register();
}

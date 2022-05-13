<?php
/**
 * Plugin Name: Post Popup
 * Version: 1.0.0
 * Author: Maja Kochanowska
 * Description: Popup that displays content of Custom Post Type "Popup"
 * Text Domain: post-popup
 *
 * @package post-popup
 */

namespace Maja\PostPopup;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once __DIR__ . '/vendor/autoload.php';

const MAIN_FILE = __FILE__;
const VERSION   = '1.0.0';

Modules\Popup::register();
Modules\Acf::register();

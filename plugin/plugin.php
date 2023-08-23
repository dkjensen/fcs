<?php
/**
 * Plugin Name:       Coding Challenge
 * Description:       Description of the plugin
 * Requires at least: 6.0.2
 * Requires PHP:      7.0
 * Version:           0.0.0-development
 * Author:            David Jensen
 * Author URI:        https://dkjensen.com
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       coding-challenge
 *
 * @package Dkjensen\FCS
 */

namespace Dkjensen\FCS;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'FCS_CODING_CHALLENGE_URI', plugin_dir_url( __FILE__ ) );

require_once 'vendor/autoload.php';
require_once 'includes/ajax.php';
require_once 'includes/shortcodes.php';
require_once 'includes/cli.php';
require_once 'includes/admin-page.php';

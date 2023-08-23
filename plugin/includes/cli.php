<?php
/**
 * CLI
 *
 * @package Dkjensen\FCS
 */

namespace Dkjensen\FCS;

/**
 * Register CLI commands
 *
 * @return void
 */
function register_cli(): void {
	\WP_CLI::add_command( 'fcs', __NAMESPACE__ . '\CLI' );
}
add_action( 'cli_init', __NAMESPACE__ . '\register_cli' );

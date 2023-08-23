<?php
/**
 * CLI.
 *
 * @package Dkjensen\FCS
 */

namespace Dkjensen\FCS;

/**
 * CLI
 */
class CLI {

	/**
	 * Flushes the cache
	 *
	 * @return void
	 */
	public function cache_flush() {
		delete_transient( 'fcs_challenge_response' );

		\WP_CLI::success( 'API cache deleted' );
	}
}

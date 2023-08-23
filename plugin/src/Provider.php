<?php
/**
 * API provider.
 *
 * @package Dkjensen\FCS
 */

namespace Dkjensen\FCS;

/**
 * Live provider
 */
class Provider {

	/**
	 * Rest base
	 *
	 * @var string
	 */
	private string $rest_base = 'https://api.strategy11.com/wp-json';


	/**
	 * Make the request
	 *
	 * @param string $url Endpoint.
	 * @param array  $options Request options.
	 * @return array|\WP_Error
	 */
	public function get_request( string $url, array $options = array() ) {
		/** @var array|\WP_Error $response */
		$response = wp_remote_get( $this->rest_base . $url, $options );

		return $response;
	}
}

<?php
/**
 * API provider.
 *
 * @package Dkjensen\FCS
 */

namespace Dkjensen\FCS;

use WP_Error;

/**
 * API adapter
 */
class Adapter {

	/**
	 * API provider
	 *
	 * @var Provider
	 */
	private Provider $provider;

	/**
	 * Take in the appropriate Adapter
	 * We use DI so we can reliably test
	 *
	 * @param Provider $provider API provider.
	 */
	public function __construct( Provider $provider ) {
		$this->provider = $provider;
	}

	/**
	 * Get challenge response
	 *
	 * @return array
	 */
	public function get_challenge_response() {
		/** @var false|string $cached */
		$cached = get_transient( 'fcs_challenge_response' );

		if ( false !== $cached ) {
			return $cached;
		}

		/** @var array|\WP_Error $response */
		$response = $this->provider->get_request(
			'/challenge/v1/1',
			array(
				'headers' => array(
					'Accept' => 'application/json',
				),
			)
		);

		/** @var string $body */
		$body = wp_remote_retrieve_body( $response );

		/** @var array $parsed_body */
		$parsed_body                 = json_decode( $body, true );
		$parsed_body['data']['rows'] = array_values( $parsed_body['data']['rows'] );

		if ( ! is_wp_error( $response ) && 200 === (int) wp_remote_retrieve_response_code( $response ) ) {
			set_transient( 'fcs_challenge_response', $parsed_body, HOUR_IN_SECONDS );
		}

		return $parsed_body;
	}
}

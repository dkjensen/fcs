<?php
/**
 * AJAX
 *
 * @package Dkjensen\FCS
 */

namespace Dkjensen\FCS;

/**
 * Return challenge response from API
 *
 * @return void
 */
function get_challenge(): void {
	$strategy11 = new Provider();
	$api        = new Adapter( $strategy11 );

	$challenge = $api->get_challenge_response();

	if ( '' === $challenge ) {
		wp_send_json_error( esc_html__( 'Invalid response from API.', 'coding-challenge' ), 503 );
	}

	wp_send_json_success( $challenge );
}
add_action( 'wp_ajax_get_challenge', __NAMESPACE__ . '\get_challenge' );
add_action( 'wp_ajax_nopriv_get_challenge', __NAMESPACE__ . '\get_challenge' );

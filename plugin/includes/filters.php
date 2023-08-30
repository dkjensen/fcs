<?php
/**
 * Filters
 *
 * @package Dkjensen\FCS
 */

namespace Dkjensen\FCS;

/**
 * Sanitize challenge response before saving in database
 *
 * @param mixed $value   Value to sanitize.
 * @param string $option Option name.
 * @return mixed
 */
function sanitize_challenge_response( $value, $option ): mixed {
	if ( is_array( $value ) ) {
		array_walk_recursive( $value, function( &$_value, $key ) {
			if ( in_array( $key, array( 'id', 'date' ) ) ) {
				$_value = (int) preg_replace( '/[^\d]/', '', $_value );
			} elseif ( 'email' === $key ) {
				$_value = sanitize_email( $_value );
			} else {
				$_value = sanitize_text_field( $_value );
			}
		} );

		return $value;
	}

	return sanitize_text_field( $value );
}
add_filter( 'sanitize_option__transient_fcs_challenge_response', __NAMESPACE__ . '\sanitize_challenge_response', 10, 2 );

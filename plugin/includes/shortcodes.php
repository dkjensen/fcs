<?php
/**
 * Shortcodes
 *
 * @package Dkjensen\FCS
 */

namespace Dkjensen\FCS;

/**
 * Render the shortcode
 *
 * @param array $atts Shortcode attributes.
 * @return string
 */
function challenge_table( $atts ) { // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter
	$content = '';

	wp_enqueue_style( 'coding-challenge', FCS_CODING_CHALLENGE_URI . 'assets/css/main.css', array(), '0.0.0-development' );
	wp_register_script( 'coding-challenge', FCS_CODING_CHALLENGE_URI . 'assets/js/main.js', array(), '0.0.0-development', true );

	wp_localize_script(
		'coding-challenge',
		'fcs',
		array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
		)
	);

	wp_enqueue_script( 'coding-challenge' );

	return sprintf( '<div class="challenge-table"><span class="challenge-table__loading">%s</span></div>', esc_html__( 'Loading', 'coding-challenge' ) );
}
add_shortcode( 'challenge_table', __NAMESPACE__ . '\challenge_table' );

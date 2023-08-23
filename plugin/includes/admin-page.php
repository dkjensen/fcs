<?php
/**
 * Admin interface
 *
 * @package Dkjensen\FCS
 */

namespace Dkjensen\FCS;

/**
 * Register the new menu page
 *
 * @return void
 */
function admin_menu() {
	add_menu_page(
		esc_html__( 'Coding Challenge', 'coding-challenge' ),
		esc_html__( 'Coding Challenge', 'coding-challenge' ),
		'manage_options',
		'fcs_frm_display', // Include "frm_display" to display white background.
		__NAMESPACE__ . '\admin_page',
	);
}
add_action( 'admin_menu', __NAMESPACE__ . '\admin_menu' );

/**
 * Purge the API cache via admin-post.php
 *
 * @throws \Exception Check if user can purge the cache.
 *
 * @return void
 */
function action_purge_cache() {
	try {
		if ( ! current_user_can( 'manage_options' ) ) {
			throw new \Exception( esc_html__( 'You are not allowed to do that', 'coding-challenge' ) );
		}

		if ( ! wp_verify_nonce( sanitize_key( $_REQUEST['_wpnonce'] ?? '' ) ) ) {
			throw new \Exception( esc_html__( 'Invalid nonce, please go back and try again', 'coding-challenge' ) );
		}

		delete_transient( 'fcs_challenge_response' );

		wp_safe_redirect(
			add_query_arg(
				array(
					'page'   => 'fcs_frm_display',
					'purged' => 'true',
				),
				admin_url( 'admin.php' )
			)
		);
		exit;
	} catch ( \Exception $e ) {
		wp_die( esc_html( $e->getMessage() ) );
	}
}
add_action( 'admin_post_fcs_purge_cache', __NAMESPACE__ . '\action_purge_cache' );

/**
 * Render the admin page
 *
 * @return void
 */
function admin_page() {
	if ( ! class_exists( '\FrmAppHelper' ) ) {
		printf( '<div class="wrap">%s</div>', esc_html__( 'Formidable Forms must be activated to view this page.', 'coding-challenge' ) );

		return;
	}

	wp_enqueue_style( 'formidable-admin' );
	?>

	<div class="frm_wrap">
		<?php

		\FrmAppHelper::get_admin_header(
			array(
				'label'   => __( 'Coding Challenge', 'coding-challenge' ),
				'publish' => array(
					function ( $atts ) { // phpcs:ignore Generic.CodeAnalysis.UnusedFunctionParameter
						?>

						<form method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
							<button type="submit" class="frm-button-secondary"><?php esc_html_e( 'Purge Cache', 'coding-challenge' ); ?></button>
							<input type="hidden" name="action" value="fcs_purge_cache" />
							<?php wp_nonce_field(); ?>
						</form>

						<?php
					},
					array(),
				),
			)
		);
	?>
		<div class="wrap">

			<?php

			// Display a success message if cache purged.
			if ( 'true' === ( $_GET['purged'] ?? '' ) ) { // phpcs:ignore
				$notes = array( esc_html__( 'Cached purged successfully', 'coding-challenge' ) );
			}

			require \FrmAppHelper::plugin_path() . '/classes/views/shared/errors.php';

			$wp_list_table = new List_Table( array() );
			$wp_list_table->prepare_items();
			$wp_list_table->display();

			?>

		</div>
	</div>

	<?php
}

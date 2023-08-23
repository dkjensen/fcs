<?php
/**
 * List Table.
 *
 * @package Dkjensen\FCS
 */

namespace Dkjensen\FCS;

use Dkjensen\FCS\Models\Root;
use Dkjensen\FCS\Models\Data;
use Dkjensen\FCS\Models\Row;

/**
 * List_Table
 */
class List_Table extends \WP_List_Table {

	/**
	 * Columns
	 *
	 * @var array
	 */
	protected array $columns = array();

	/**
	 * Prepare items.
	 *
	 * @return void
	 */
	public function prepare_items() {
		$strategy11 = new Provider();
		$api        = new Adapter( $strategy11 );

		$challenge = $api->get_challenge_response();

		if ( '' === $challenge ) {
			return;
		}

		$root = Root::fromJson( $challenge );
		$data = $root->data;

		if ( JSON_ERROR_NONE === json_last_error() ) {
			$headers = $data->get_headers();

			if ( ! empty( $headers ) ) {
				$this->columns = array_combine( $headers, $headers );
			}
		}

		$this->items = $data->get_rows();

		$total_items = count( $this->items );

		$this->set_pagination_args(
			array(
				'total_items' => $total_items,
			)
		);

		$this->_column_headers = array( $this->columns, array(), array() );
	}

	/**
	 * Render the columns
	 *
	 * @param Row    $item Item data.
	 * @param string $column_name Colum name.
	 * @return string
	 */
	public function column_default( $item, $column_name ) {
		$content = '';

		switch ( $column_name ) {
			case 'ID':
				$content = esc_html( $item->get_id() );
				break;
			case 'First Name':
				$content = esc_html( $item->get_fname() );
				break;
			case 'Last Name':
				$content = esc_html( $item->get_lname() );
				break;
			case 'Email':
				$content = esc_html( $item->get_email() );
				break;
			case 'Date':
				$date = $item->get_date();

				if ( $date ) {
					$date = gmdate( 'F j, Y', $date );
				} else {
					$date = esc_html__( 'N/A', 'coding-challenge' );
				}

				$content = esc_html( $date );
				break;
			default:
				$content = esc_html__( 'Invalid column', 'coding-challenge' );
		}

		return $content;
	}

	/**
	 * Column headers
	 *
	 * @return array
	 */
	public function get_columns() {
		return $this->columns;
	}
}

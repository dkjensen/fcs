<?php
/**
 * Root model.
 *
 * @package Dkjensen\FCS
 */

namespace Dkjensen\FCS\Models;

class Data {

	/**
	 * @var string[]|null
	 */
	public ?array $headers;

	/**
	 * @var Row[]|null
	 */
	public ?array $rows;

	/**
	 * @param string[]|null $headers
	 * @param Row[]|null    $rows
	 */
	public function __construct( ?array $headers, ?array $rows ) {
		$this->headers = $headers;
		$this->rows    = $rows;
	}

	/**
	 * @return string[]|null
	 */
	public function get_headers(): ?array {
		return $this->headers;
	}

	/**
	 * @return Row[]|null
	 */
	public function get_rows(): ?array {
		return $this->rows;
	}

	/**
	 * @param array $data
	 * @return self
	 */
	public static function fromJson( array $data ): self {
		return new self(
			$data['headers'] ?? null,
			( $data['rows'] ?? null ) !== null ? array_map(
				static function ( $data ) {
					return Row::fromJson( $data );
				},
				$data['rows']
			) : null
		);
	}
}

<?php
/**
 * Root model.
 *
 * @package Dkjensen\FCS
 */

namespace Dkjensen\FCS\Models;

class Root {

	/**
	 * @var string|null
	 */
	public ?string $title;

	/**
	 * @var Data|null
	 */
	public ?Data $data;

	/**
	 * @param string|null $title
	 * @param Data|null   $data
	 */
	public function __construct( ?string $title, ?Data $data ) {
		$this->title = $title;
		$this->data  = $data;
	}

	/**
	 * @return string|null
	 */
	public function get_title(): ?string {
		return $this->title;
	}

	/**
	 * @return Data|null
	 */
	public function get_data(): ?Data {
		return $this->data;
	}

	/**
	 * @param array $data
	 * @return self
	 */
	public static function fromJson( array $data ): self {
		return new self(
			$data['title'] ?? null,
			( $data['data'] ?? null ) !== null ? Data::fromJson( $data['data'] ) : null
		);
	}
}

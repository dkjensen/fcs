<?php
/**
 * Root model.
 *
 * @package Dkjensen\FCS
 */

namespace Dkjensen\FCS\Models;

class Row {

	/**
	 * @var int|null
	 */
	public ?int $id;

	/**
	 * @var string|null
	 */
	public ?string $fname;

	/**
	 * @var string|null
	 */
	public ?string $lname;

	/**
	 * @var string|null
	 */
	public ?string $email;

	/**
	 * @var int|null
	 */
	public ?int $date;

	/**
	 * @param int|null    $id
	 * @param string|null $fname
	 * @param string|null $lname
	 * @param string|null $email
	 * @param int|null    $date
	 */
	public function __construct(
		?int $id,
		?string $fname,
		?string $lname,
		?string $email,
		?int $date
	) {
		$this->id    = $id;
		$this->fname = $fname;
		$this->lname = $lname;
		$this->email = $email;
		$this->date  = $date;
	}

	/**
	 * @return int|null
	 */
	public function get_id(): ?int {
		return $this->id;
	}

	/**
	 * @return string|null
	 */
	public function get_fname(): ?string {
		return $this->fname;
	}

	/**
	 * @return string|null
	 */
	public function get_lname(): ?string {
		return $this->lname;
	}

	/**
	 * @return string|null
	 */
	public function get_email(): ?string {
		return $this->email;
	}

	/**
	 * @return int|null
	 */
	public function get_date(): ?int {
		return $this->date;
	}

	/**
	 * @param array $data
	 * @return self
	 */
	public static function fromJson( array $data ): self {
		return new self(
			$data['id'] ?? null,
			$data['fname'] ?? null,
			$data['lname'] ?? null,
			$data['email'] ?? null,
			$data['date'] ?? null
		);
	}
}

<?php declare(strict_types=1);

namespace database\models;

// -- to storage user emails
// create table if not exists emails (
// 	id BIGINT GENERATED ALWAYS AS IDENTITY PRIMARY KEY,
// 	uuid TEXT NOT NULL UNIQUE,
// 	id_user INTEGER NOT NULL,
// 	email TEXT NOT NULL,
// 	verified BOOLEAN NOT NULL DEFAULT FALSE,
// 	last_verification_code TEXT NOT NULL,
// 	last_verification_code_sent_at TIMESTAMP NOT NULL,
// 	created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
// 	updated_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
// 
// 	FOREIGN KEY (id_user) REFERENCES users(id)
// 	ON DELETE CASCADE
// 	ON UPDATE CASCADE
// );

class EmailRecord implements Record {

	public function __construct(
		public private(set) ?int $id = null,
		public private(set) ?string $uuid = null,
		public private(set) ?int $user_id = null,
		public private(set) ?string $email= null,
		public private(set) ?bool $verified = null,
		public private(set) ?string $last_verification_code= null,
		public private(set) ?string $last_verification_code_sent_at = null,
		public private(set) ?string $created_at = null,
		public private(set) ?string $updated_at = null	
	) {}

	public function from_result_row(array $row): void {
		$this->id = $row['id'];
		$this->uuid = $row['uuid'];
		$this->user_id = $row['id_user'];
		$this->email = $row['email'];
		$this->verified = $row['verified'];
		$this->last_verification_code = $row['last_verification_code'];
		$this->last_verification_code_sent_at = $row['last_verification_code_sent_at'];
		$this->created_at = $row['created_at'];
		$this->updated_at = $row['updated_at'];
	}

	public function to_result_array(): array {
		$email = (array) $this;
		return $email;
	}
}

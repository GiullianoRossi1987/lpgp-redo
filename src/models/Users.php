<?php declare(strict_types=1);
namespace database\models;

class UserRecord implements Record {


	public function __construct(
		public private(set) ?int $id = null,
		public private(set) ?string $cpf = null,
		public private(set) ?string $uuid = null,
		public private(set) ?string $name = null,
		public private(set) ?string $password = null,
		public private(set) ?bool $proprietary = null,
		public private(set) ?string $created_at = null,
		public private(set) ?string $updated_at = null
	) {}

	public function from_result_row(array $row): void {
		$this->id = $row['id'];
		$this->uuid = $row['uuid'];
		$this->cpf = $row['cpf'];
		$this->name = $row['full_name'];
		$this->password = $row['password'];
		$this->proprietary = $row['is_proprietary'];
		$this->created_at = $row['created_at'];
		$this->updated_at = $row['updated_at'];
	}
	
	public function to_result_array(): array {
		$array = (array) $this;
		$array['full_name'] = $array['name'];
		$array['is_proprietary'] = $array['proprietary'];
		unset($array['proprietary']);
		unset($array['name']);
		
		return $array;

	}
	
}


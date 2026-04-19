<?php declare(strict_type=1);

namespace database\models;

interface Record {
	
	public function from_result_row(array $row): void ;
	public function to_result_array(): array ;
}
?>

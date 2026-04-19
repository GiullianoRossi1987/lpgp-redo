<?php declare(strict_types=1);

namespace database\repositories;

use database\models\UserRecord;
use Amp\Postgres\PostgresConnectionPool;
use Exception;

class Users {

	public function __construct(
		public private(set) PostgresConnectionPool $db
	){}

	public function userExists(int $id): bool {
		$results = $this->getUser($id);
		return (bool) sizeof($results);
	}

	public function getUser(int $id): ?UserRecord {
		$transaction = $this->db->beginTransaction();
		$result = null;
		try {
			$stmt = $transaction->prepare('SELECT * FROM users WHERE id = ?');
			$results = $stmt->execute($id);
			$usr = new UserRecord();
			$result = $usr->from_result_row($results->fetchRow());
		} 
		catch(Exception $e) {
			$transaction->rollback();
			throw $e;
		}
		$transaction->close();
		return $result;
	}

	public function getUserByName(string $name): ?UserRecord {	
		$transaction = $this->db->beginTransaction();
		$result = null;
		try {
			$stmt = $transaction->prepare("SELECT * FROM users WHERE full_name LIKE ");
			$results = $stmt->execute($name);
			$usr = new UserRecord();
			$result = $usr->from_result_row($results->fetchRow());
		} 
		catch(Exception $e) {
			$transaction->rollback();
			throw $e;
		}
		$transaction->close();
		return $result;
	}

	public function addUser(UserRecord $user): void {
		$transaction = $this->db->beginTransaction();
		try {
			$userArray = $user->to_row_array();
			$stmt = $transaction->prepare("INSERT INTO users (cpf, full_name, ) VALUES ()");
			$result = $stmt->execute(...$userArray);
		}
		catch (Exception $e) {
			$transaction->rollback();
			throw $e;
		}
		$transaction->commit();
		$transaction->close(); // maybe it's unnecessary but who knows
	}

	public function deleteUser(int $id): void {
		$transaction = $this->db->beginTransaction();
		try{
			$stmt = $transaction->prepare("DELETE FROM users WHERE id = ?;");
			$result = $stmt->execute($id);
		}
		catch( Exception $e) {
			$transaction->rollback();
			throw $e;
		}
		$transaction->commit();
		$transaction->close();
	}


	public function updateUser(UserRecord $user): void {
		if (!$this->userExists($user->id)) {
			return ; // TODO create exceptions
		}
		$transaction = $this->db->beginTransaction();
		try {
			$userArray = $user->to_row_array();
			$stmt = $transaction->prepare(""); // TODO
			$result = $stmt->execute(...($userArray));
		}
		catch (Exception $e) {
			$transaction->rollback();
			throw $e;
		}
		$transaction->commit();
		$transaction->close();
	}
}

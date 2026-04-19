<?php declare(strict_types=1);
namespace database;
use Amp\Postgres\{
	PostgresConfig,
	PostgresConnectionPool
};

class PostgresConnection {
	public private(set) PostgresConnectionPool $pool;
	public private(set) string $connectionString;

	public function __construct() {
		$this->connectionString = sprintf(
			'host=%s user=%s password=%s db=%s',
			$_ENV['HOSTNAME'],
			$_ENV['USERNAME'],
			$_ENV['PASSWORD'],
			$_ENV['DATABASE']
		);
		$this->pool = new PostgresConnectionPool(PostgresConfig::fromString($this->connectionString));
	}

	public function __destruct() {
		$this->pool->close();
	}

};
?>

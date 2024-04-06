<?php 

namespace App\Core;

class Database
{
	public \PDO $pdo;

	public function __construct(array $config)
	{
		$this->handleConnexion($config['default'], $config['connections']);
	}

	private function handleConnexion(string $driver, array $config)
	{
		switch($driver)
		{
			case 'mysql':
				$connexion = $config['mysql'];
				$dsn = "mysql:host={$connexion['host']};dbname={$connexion['database']};charset={$connexion['charset']}";
				$this->pdo = new \PDO($dsn, $connexion['username'], $connexion['password']);
				$this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
				$this->pdo->exec("USE " . $connexion['database']);
				break;
		}
	}
}
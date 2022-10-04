<?php

namespace Treedata;

use PDO;

class Db
{
    private string $dbHost;
    private string $dbUser;
    private string $dbPass;
    private string $dbName;

    public function __invoke(array $config)
    {
        $this->dbHost = (string) $config['db_host'] ?? 'localhost';
        $this->dbUser = (string) $config['db_user'] ?? 'root';
        $this->dbPass = (string) $config['db_pass'] ?? '';
        $this->dbName = (string) $config['db_name'] ?? 'treedata';

        return $this->connect();
    }

    private function connect()
    {
        return new PDO(
            sprintf('mysql:host=%s;port=%d;dbname=%s;charset=utf8mb4', $this->dbHost, 3306, $this->dbName),
            $this->dbUser,
            $this->dbPass,
            [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            ]
        );
    }
}

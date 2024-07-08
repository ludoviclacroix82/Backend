<?php

namespace Api\config;

use PDO;
use PDOException;

class Database
{
    private string $dbName;
    private string $dbUser;
    private string $dbPassword;
    private string $dbHost;
    private ?PDO $pdo = null;

    public function __construct(string $dbName, string $dbUser, string $dbPassword, string $dbHost)
    {
        $this->dbName = $dbName;
        $this->dbUser = $dbUser;
        $this->dbPassword = $dbPassword;
        $this->dbHost = $dbHost;
    }

    private function getPdo(): PDO
    {
        if ($this->pdo === null) {
            try {
                $pdo = new PDO("mysql:host={$this->dbHost};dbname={$this->dbName}", $this->dbUser, $this->dbPassword);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->pdo = $pdo;
            } catch (PDOException $e) {
                throw new PDOException("Database connection error: " . $e->getMessage());
            }
        }
        return $this->pdo;
    }

    public function query(string $statement, ?array $params = []): array
    {
        try {
            $request = $this->getPdo()->prepare($statement);
            $request->execute($params);
            $datas = $request->fetchAll(PDO::FETCH_ASSOC);

            return $datas;
        } catch (PDOException $e) {
            // Handle query execution error
            throw new PDOException("Query execution error: " . $e->getMessage());
        }
    }
}

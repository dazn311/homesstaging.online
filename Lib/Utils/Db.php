<?php

namespace Utils;

use PDO;
use PDOException;
use PDOStatement;

final class Db
{

    private $connection;
    private PDOStatement $stmt;
    private static ?Db $instance = null;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    public function __wakeup()
    {
    }

    public static function getInstance(): ?Db
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection(array $db_config)
    {
        if ($this->connection instanceof PDO) {
            return $this;
        }
        $dsn = "mysql:host={$db_config['host']};dbname={$db_config['dbname']};charset={$db_config['charset']}";
        try {
            $this->connection = new PDO($dsn, $db_config['username'], $db_config['password'], $db_config['options']);
            return $this;
        } catch (PDOException $e) {
            abort(500,'[46 Db] error: ' . $e->getMessage());
        }
    }

    public function query($query, $params = []): false|Db
    {
        try {
            $this->stmt = $this->connection->prepare($query);
            $this->stmt->execute($params);
        } catch (PDOException $e) {
            return false;
        }
        return $this;
    }

    public function findAll(): false|array
    {
        try {
            return $this->stmt->fetchAll();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function find()
    {
        try {
            return $this->stmt->fetch();
        } catch (PDOException $e) {
            return false;
        }
    }

    public function findOrFail()
    {
        $res = $this->find();
        if (!$res) {
            abort();
        }
        return $res;
    }

    public function rowCount(): int
    {
        return $this->stmt->rowCount();
    }
    
    public function getColumn()
    {
        return $this->stmt->fetchColumn();
    }

    public function getInsertId()
    {
        return $this->connection->lastInsertId();
    }
}

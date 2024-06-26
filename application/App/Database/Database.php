<?php

namespace App\Database;

use PDO;
use PDOException;
use PDOStatement;

require_once base_path("/config/db_config.php");

class Database
{
    private $name = DB_NAME;
    private $host = DB_HOST;
    private $port = DB_PORT;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $charset = DB_CHARSET;


    private function _connect()
    {
        try {
            $pdo = new PDO("mysql:host={$this->host};port={$this->port};dbname={$this->name};charset={$this->charset}", $this->user, $this->pass, [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            exit;
        }
    }

    public function query(String $query, Array $params = []): PDOStatement
    {
        $statement = $this->_connect()->prepare($query);
        $statement->execute($params);
        return $statement;
    }
}

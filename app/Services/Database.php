<?php

namespace App\Services;

use PDO;
use PDOException;

class Database
{
    private $host = "127.0.0.1";
    private $db_name = "real_estate_agency";
    private $username = "root";
    private $password = "root";
    public $conn;

    // получаем соединение с БД
    public function getConnection(){

        $this->conn = null;

        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }
}

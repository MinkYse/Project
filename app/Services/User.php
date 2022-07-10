<?php

namespace App\Services;

class User
{
    private $conn;
    private $table_name = "users";

    public $user_id;
    public $username;
    public $password;

    public function __construct($db) {
        $this->conn = $db;
    }

    function check() {
        $query = 'SELECT *
            FROM ' . $this->table_name . '
            WHERE username = \'' . $this->username . '\' AND password = \'' . $this->password . '\'';

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }
}
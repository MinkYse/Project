<?php

namespace App\Services;

class Estate
{
    private $conn;
    private $table_name = 'estate';

    // свойства объекта
    public $id;
    public $name;
    public $description;
    public $price;
    public $street;
    public $house_number;
    public $apartment_number;
    public $img_path;
    public $active;
    public $created;
    public $sort;

    public function __construct($db){
        $this->conn = $db;
    }

    function read() {

        $query = "SELECT
                id, name, description, price, street, house_number, apartment_number, img_path, active, created
            FROM
                " . $this->table_name . "
            ORDER BY
                price " . $this->sort;

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }


    function post(): bool
    {
        $query = "INSERT INTO
                " . $this->table_name . "
            SET
                name=:name, price=:price, description=:description, street=:street, house_number=:house_number, apartment_number=:apartment_number, img_path=:img_path, created=:created";

        $stmt = $this->conn->prepare($query);

        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->street=htmlspecialchars(strip_tags($this->street));
        $this->house_number=htmlspecialchars(strip_tags($this->house_number));
        $this->apartment_number=htmlspecialchars(strip_tags($this->apartment_number));
        $this->img_path=htmlspecialchars(strip_tags($this->img_path));
        $this->created=htmlspecialchars(strip_tags($this->created));

        $this->bindParams($stmt);
        $stmt->bindParam(":created", $this->created);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    function delete(): bool
    {

        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";

        $stmt = $this->conn->prepare($query);

        $this->id=htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(1, $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;

    }

    function update(){

        // запрос для обновления записи (товара)
        $query = "UPDATE
                " . $this->table_name . "
            SET
                name=:name,
                price=:price,
                description=:description,
                street=:street, 
                house_number=:house_number, 
                apartment_number=:apartment_number, 
                img_path=:img_path
            WHERE
                id = :id";

        $stmt = $this->conn->prepare($query);

        $this->name=htmlspecialchars(strip_tags($this->name));
        $this->price=htmlspecialchars(strip_tags($this->price));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->street=htmlspecialchars(strip_tags($this->street));
        $this->house_number=htmlspecialchars(strip_tags($this->house_number));
        $this->apartment_number=htmlspecialchars(strip_tags($this->apartment_number));
        $this->img_path=htmlspecialchars(strip_tags($this->img_path));

        $this->bindParams($stmt);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    public function bindParams($stmt): void
    {
        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":price", $this->price);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":street", $this->street);
        $stmt->bindParam(":house_number", $this->house_number);
        $stmt->bindParam(":apartment_number", $this->apartment_number);
        $stmt->bindParam(":img_path", $this->img_path);
    }

}
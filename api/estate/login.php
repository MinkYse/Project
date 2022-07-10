<?php

session_start();
require_once(realpath("../../vendor/autoload.php"));

use App\Services\Database;
use App\Services\User;

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$username = $_POST['username'];
$password = $_POST['password'];

$user->username = $username;
$user->password = $password;

$stmt = $user->check();
$num = $stmt->rowCount();

if ($num>0) {

    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    $_SESSION['user'] = [
        "id" => $row["user_id"],
        "username" => $row["username"],
        "password" => $row["password"],
    ];

    $response = array(
        "status" => true
    );

    echo json_encode($response);
}else {

    $response = array(
        "status" => false,
        "message" => 'Неверный логин или пароль'
    );

    echo json_encode($response);
}
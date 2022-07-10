<?php

require_once(realpath("../../vendor/autoload.php"));

use App\Services\Database;
use App\Services\Estate;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$database = new Database();
$db = $database->getConnection();

$estate = new Estate($db);

$estate->id = $_POST['id'];
$imgPath = $_SERVER['DOCUMENT_ROOT'] . $_POST['src'];

if ($estate->delete()) {

    unlink($imgPath);

    http_response_code(200);

    echo json_encode(array("message" => "Запись удалена."), JSON_UNESCAPED_UNICODE);
}

else {

    http_response_code(503);

    echo json_encode(array("message" => "Ошибка при удалении записи."));
}
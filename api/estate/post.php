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

$file = $_FILES['file'];
$data = $_POST;

$path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';
$extension = explode('.', $file['name'])[1];
$fileName = substr(md5(microtime() . rand(0, 1000)), 0, 15);
$copySrc = $path . $fileName . '.' . $extension;
$baseSrc = '/uploads/' . $fileName . '.' . $extension;

if (
    !empty($data['name']) &&
    !empty($data['price']) &&
    !empty($data['description']) &&
    !empty($data['street']) &&
    !empty($data['house_number']) &&
    !empty($data['apartment_number'])
) {
    extracted($data, $estate);
    $estate->img_path = $baseSrc;
    $estate->created = date("Y-m-d H:i:s");

    if($estate->post()) {

        move_uploaded_file($file['tmp_name'], $copySrc);

        http_response_code(201);

        echo json_encode(array('message' => 'Обьявление опубликованно.'), JSON_UNESCAPED_UNICODE);
    } else {

        http_response_code(503);

        echo json_encode(array('message' => 'Неудалось создать обьявление.'), JSON_UNESCAPED_UNICODE);
    }

} else {

    http_response_code(400);

    echo json_encode(array('message' => 'Недостаточно данных для размещения обьявления.'), JSON_UNESCAPED_UNICODE);
};

function extracted(array $data, Estate $estate): void
{
    $estate->name = $data['name'];
    $estate->price = $data['price'];
    $estate->description = $data['description'];
    $estate->street = $data['street'];
    $estate->house_number = $data['house_number'];
    $estate->apartment_number = $data['apartment_number'];
    $estate->created = date("Y-m-d H:i:s");
}
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

$data = $_POST;
$src = $_SERVER['DOCUMENT_ROOT'] . $_POST['src'];

if (!empty($_FILES)) {
    $file = $_FILES['file'];

    $path = $_SERVER['DOCUMENT_ROOT'] . '/uploads/';
    $extension = explode('.', $file['name'])[1];
    $fileName = substr(md5(microtime() . rand(0, 1000)), 0, 15);
    $copySrc = $path . $fileName . '.' . $extension;
    $baseSrc = '/uploads/' . $fileName . '.' . $extension;

    $estate->img_path = $baseSrc;
} else {
    $estate->img_path = $data['src'];
}

function extracted(array $data, Estate $estate): void
{
    $estate->id = $data['id'];
    $estate->name = $data['name'];
    $estate->price = $data['price'];
    $estate->description = $data['description'];
    $estate->street = $data['street'];
    $estate->house_number = $data['house_number'];
    $estate->apartment_number = $data['apartment_number'];
    $estate->created = date("Y-m-d H:i:s");
}

extracted($data, $estate);

if ($estate->update()) {

    if (isset($baseSrc)) {
        unlink($src);
        move_uploaded_file($file['tmp_name'], $copySrc);
    }

    http_response_code(200);

    echo json_encode(array("message" => "Товар был обновлён."), JSON_UNESCAPED_UNICODE);
}

else {

    http_response_code(503);

    echo json_encode(array("message" => "Невозможно обновить товар."), JSON_UNESCAPED_UNICODE);
}

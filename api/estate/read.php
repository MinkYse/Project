<?php

require_once(realpath("../../vendor/autoload.php"));

use App\Services\Database;
use App\Services\Estate;


$database = new Database();
$db = $database->getConnection();

$estate = new Estate($db);

$filter = $_POST['filter'];
$estate->sort = $filter;

$stmt = $estate->read();
$num = $stmt->rowCount();

if ($num>0) {
    $products_arr = array();
    $products_arr["records"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        extract($row);
        $product_item = array(
            'id' => $id,
            'name' => $name,
            'description' => html_entity_decode($description),
            'price' =>  number_format($price, 0, ',', ' '),
            'street' => $street,
            'house_number' => $house_number,
            'apartment_number' => $apartment_number,
            'img_path' => $img_path,
            'created' => $created
        );

        $products_arr["records"][] = $product_item;

    }

    http_response_code(200);

    echo json_encode($products_arr);

}else {

    http_response_code(404);

    echo json_encode(array("message" => "Товары не найдены."), JSON_UNESCAPED_UNICODE);
}

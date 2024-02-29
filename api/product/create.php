<?php

header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Method, Authorization, X-Requested-With');


include_once('../../config/db.php');
include_once('../../model/product.php');

$db = new DB();
$connect = $db->connect();

$product = new Product($connect);

$data = json_decode(file_get_contents("php://input"));

$product->product_name = $data->product_name;
$product->group_id = $data->group_id;

if($product->create()) {
  echo  json_encode(array('message', 'product Created'));
} else {
  echo  json_encode(array('message', 'product Not Created'));
}

?>
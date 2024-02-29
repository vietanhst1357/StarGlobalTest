<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');

include_once('../../config/db.php');
include_once('../../model/product.php');

$db = new DB();
$connect = $db->connect();

$product = new Product($connect);

$product->id = isset($_GET['id']) ? $_GET['id'] : die();

if (!$product->show()) {
  echo  json_encode(array('message', 'Cannot find the product'));
  return;
}

$product_item = array(
  'id' => $product->id,
  'group_id' => $product->group_id,
  'product_name' => $product->product_name
);

print_r(json_encode(array("product" => $product_item)));

?>
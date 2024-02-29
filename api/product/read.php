<?php
  header('Access-Control-Allow-Origin:*');
  header('Content-Type: application/json');
  
  include_once('../../config/db.php');
  include_once('../../model/product.php');

  $db = new DB();
  $connect = $db->connect();

  $product = new Product($connect);
  $read = $product->read();

  $num = $read->rowCount();
  if($num > 0) {
    $products_array = [];
    $products_array['products'] = [];
    while($row = $read->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $product_item = array(
        'id' => $id,
        'group_id' => $group_id,
        'product_name' => $product_name
      );
      array_push($products_array['products'], $product_item);
    }

    echo json_encode($products_array);
  }

?>
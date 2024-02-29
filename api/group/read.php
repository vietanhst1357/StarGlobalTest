<?php
  header('Access-Control-Allow-Origin:*');
  header('Content-Type: application/json');
  
  include_once('../../config/db.php');
  include_once('../../model/group.php');

  $db = new DB();
  $connect = $db->connect();

  $group = new Group($connect);
  $read = $group->read();

  $num = $read->rowCount();
  if($num > 0) {
    $groups_array = [];
    $groups_array['groups'] = [];
    while($row = $read->fetch(PDO::FETCH_ASSOC)) {
      extract($row);

      $group_item = array(
        'id' => $id,
        'group_name' => $group_name,
        'title' => $title,
        'content' => $content
      );
      array_push($groups_array['groups'], $group_item);
    }

    echo json_encode($groups_array);
  }



?>
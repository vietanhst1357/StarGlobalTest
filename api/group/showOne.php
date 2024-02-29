<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');

include_once('../../config/db.php');
include_once('../../model/group.php');

$db = new DB();
$connect = $db->connect();

$group = new Group($connect);

$group->id = isset($_GET['id']) ? $_GET['id'] : die();

if (!$group->show()) {
  echo  json_encode(array('message', 'Cannot find the group'));
  return;
}

$group_item = array(
  'id' => $group->id,
  'group_name' => $group->group_name,
  'title' => $group->title,
  'content' => $group->content
);

print_r(json_encode(array("group" => $group_item)));

?>
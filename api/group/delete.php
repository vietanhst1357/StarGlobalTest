<?php

header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: PUT');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Method, Authorization, X-Requested-With');


include_once('../../config/db.php');
include_once('../../model/group.php');

$db = new DB();
$connect = $db->connect();

$group = new Group($connect);

$data = json_decode(file_get_contents("php://input"));

$group->id = $data->id;

if($group->delete()) {
  echo  json_encode(array('message', 'Group Deleted'));
} else {
  echo  json_encode(array('message', 'Group Not Deleted'));
}

?>
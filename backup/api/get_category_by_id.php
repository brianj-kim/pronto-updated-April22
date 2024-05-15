<?php
//header('Access-Control-Allow-Origin: http://localhost:4000');
include_once('./origin_config.php');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Content-type');

$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata)){
  $postdata = json_decode($postdata);

  require_once('./dbconn.php');
  $conn = new DbConnect();
  $db = $conn->connect();

  $stmt = $db->prepare("SELECT mc_title as `title`, mc_detail as `details`, mc_image as `image` FROM `menu_category` WHERE mc_id = ? ");
  $stmt->execute([$postdata->id]);

  $data = $stmt->fetchAll();
  echo json_encode($data);

}

?>
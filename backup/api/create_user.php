<?php
//header('Access-Control-Allow-Origin: http://localhost:4000');
include_once('./origin_config.php');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Content-type');

$postdata = file_get_contents("php://input");

// var_dump($postdata);
if(isset($postdata) && !empty($postdata)){
  $postdata = json_decode($postdata);
  $encoded_password = md5($postdata->password);

  $user_role = array("user");

  if($postdata->email == 'jiwoone@gmail.com') {
    array_unshift($user_role, "root-admin");
  }
  
  require_once('./dbconn.php');
  $conn = new DbConnect();
  $db = $conn->connect();

  $stmt = $db->prepare("INSERT INTO `users` (`email`, `passwd`, `user_name`, `user_role`) VALUES ( 
    ?,
    ?,
    ?,
    ?
  )");

  if($stmt->execute([$postdata->email, $encoded_password, $postdata->username, json_encode($user_role)])) {
    $data = ['status' => 1, 'message' => "Successfuly creeated the user information"];
  } else {
    $data = ['status' => 0, 'message' => "Failed to create the user"];
  }

  header('Content-Type: application/json; charset=utf-8');
  echo json_encode($data);
  return;
}

?>
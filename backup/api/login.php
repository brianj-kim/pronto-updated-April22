<?php
  //header('Access-Control-Allow-Origin: http://gopronto.ca');
  //header('Access-Control-Allow-Origin: http://localhost:4000');
  include_once('./origin_config.php');
  header('Access-Control-Allow-Method: POST');
  header('Access-Control-Allow-Headers: Content-type, Authorization');

  $postdata = file_get_contents("php://input");

  if(isset($postdata) && !empty($postdata)){
    require_once('./dbconn.php');
    $conn = new DbConnect();
    $db = $conn->connect();

    $postdata = json_decode($postdata);
    $qry = $db -> prepare('SELECT id, user_name, email, user_role FROM `users` WHERE email=? AND passwd=?');
    $qry->execute([$postdata->email, md5($postdata->password)]);

    $data = $qry->fetch();

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);
  }

?>
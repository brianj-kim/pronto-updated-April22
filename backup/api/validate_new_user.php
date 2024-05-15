<?php  
  //header('Access-Control-Allow-Origin: http://gopronto.ca');
  include_once('./origin_config.php');
  header('Access-Control-Allow-Method: POST');
  header('Access-Control-Allow-Headers: Content-type');

  $postdata = file_get_contents("php://input");

  if(isset($postdata) && !empty($postdata)){
    require_once('./dbconn.php');
    $conn = new DbConnect();
    $db = $conn->connect();
    
    $dataset = json_decode($postdata);
    $key_val = key((array)$dataset);

    if($key_val == 'username') {
      $stmt = $db->prepare('SELECT count(*) as row_num FROM users WHERE user_name = ?');
      $stmt->execute([$dataset->username]);

    } else if($key_val == 'email') {
      $stmt = $db->prepare('SELECT count(*) as row_num FROM users WHERE email = ?');
      $stmt->execute([$dataset->email]);

    }    

    // print_r($stmt->execute());
    // return;

    if($stmt->execute()) {
      $data = $stmt->fetch();
      // var_dump($data);
      // return;
    }

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);
    return;
  }

?>
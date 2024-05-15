<?php
  //header("Access-Control-Allow-Origin: http://localhost:4000");
  include_once('./origin_config.php');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Content-type');

  $postdata = file_get_contents("php://input");

  if(isset($postdata) && !empty($postdata)){
    // echo $postdata;
    // exit;
    require_once('./dbconn.php');
    $conn = new DbConnect();
    $db = $conn->connect();

    // var_dump( (array) $postdata);
    // exit;

    $postdata = json_decode($postdata);
    
    $data = array();
    $qry = $db -> prepare('UPDATE `menu_list` SET ml_order = ? WHERE ml_id = ?');
    foreach($postdata as $post) {
      // echo $post->mid . " - " . $post->order;
      // echo ", ";
      $qry->execute([$post->order, $post->mid]);
      // $data[$post] = new stdClass;
      // $data[$post]->mid = $post->mid;
      // $data[$post]->order = $post->order;
    }

    echo json_encode($data);
    // exit;
    // if($qry->execute([$postdata->order, $postdata->mid])) {
    //   echo json_encode("success");
    // }
    // echo json_encode("failed");
  
  }

?>
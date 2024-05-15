<?php
  //header('Access-Control-Allow-Origin: http://localhost:4000');
  include_once('./origin_config.php');
  header('Access-Control-Allow-Method: POST');
  header('Access-Control-Allow-Headers: Content-type');

  $postdata = file_get_contents("php://input");

  // var_dump($postdata);
  // exit;  

  if(isset($postdata) && !empty($postdata)){
    require_once('./dbconn.php');
    $conn = new DbConnect();
    $db = $conn->connect();
    
    $postdata = json_decode($postdata);

    $stmt = $db->prepare("SELECT 
                          ml_id as `id`,
                          ml_order as `order`,
                          ml_title as `title`,
                          ml_price as `price`,
                          ml_detail as `details`,
                          ml_image as `image`,
                          ml_isVeggie as `isVeggie`
                        FROM `menu_list`
                        WHERE `mc_id` = ? ");
    $stmt->execute([$postdata->category_id]);
  
    $data = $stmt->fetchAll();
  
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);
  }
?>
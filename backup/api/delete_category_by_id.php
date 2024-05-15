<?php
//header('Access-Control-Allow-Origin: http://localhost:4000');
include_once('./origin_config.php');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Content-type');

$postdata = file_get_contents("php://input");

// echo $postdata;
// exit;

if(isset($postdata) && !empty($postdata)){  
  $postdata = json_decode($postdata);
  $data = ['status' => 4, 'message' => 'Initial state']; 

  // status - 1: successful for file and database deletions
  //          4: Initial Status
  //

  require_once('./dbconn.php');
  $conn = new DbConnect();
  $db = $conn->connect();

  if(count($postdata->menus) > 0) { // menus is not empty, iterate the menus and delete image on each menu
    $menus = $postdata->menus;

    foreach($menus as $i => $value) {
      if(!empty($value->image)) {
        unlink(__DIR__ . $value->image);
      }
    }

    // delete menus record(s) on the database
    $query = $db->prepare("DELETE FROM `menu_list` WHERE mc_id = ? ");
    $query->execute([$postdata->cid]);
  }
  
  // exit;

  // var_dump($data);
  // exit;

  // If an image file exist with the category, delete the image first: void
  // var_dump(!empty($postdata->image_path));
  if(!empty($postdata->image_path)) {
    unlink(__DIR__ . $postdata->image_path);
  }
  // exit;
  
  $stmt = $db->prepare("DELETE FROM `menu_category` WHERE mc_id = ? ");
  $stmt->execute([$postdata->cid]);
  $deleted = $stmt->rowCount();

  $data['status'] = $deleted == 1 ? true : false;
  $data['message'] = 'Successfully deleted the category.';

  echo json_encode($data);

} else {
  echo "Data (json) is not transferred. Please check front end request";  
}

?>
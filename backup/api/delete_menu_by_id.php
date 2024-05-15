<?php
//header('Access-Control-Allow-Origin: http://localhost:4000');
include_once('./origin_config.php');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers: Content-type');

function menu_reorder ($cid, $order, $db) {
  $tmp = $db->prepare('SELECT ml_id FROM menu_list WHERE mc_id = ? AND ml_order > ?');
  $tmp->execute([$cid, $order]);

  $stmt = $db->prepare('UPDATE menu_list SET ml_order = ml_order - 1 WHERE ml_id = ?');
  foreach($tmp as $row) {
    $stmt->execute([$row['ml_id']]);
    // echo json_encode($row);
  }
}

$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata)){
  $postdata = json_decode($postdata);
  $data = ['status' => 4, 'message' => 'Initial state']; 
  
  // status - 1: successful for file and database deletions
  //          4: Initial Status
  //

  // If an image file exist with the category, delete the image first: void
  // var_dump(!empty($postdata->image_path)); 
  if(!empty($postdata->image_path)) {
    unlink(__DIR__ . $postdata->image_path);
  }

  require_once('./dbconn.php');
  $conn = new DbConnect();
  $db = $conn->connect();

  // reorder the rest menu(s)
  menu_reorder($postdata->cid, $postdata->order, $db);

  $stmt = $db->prepare("DELETE FROM `menu_list` WHERE ml_id = ? ");
  $stmt->execute([$postdata->mid]);
  $deleted = $stmt->rowCount();

  $data['status'] = $deleted == 1 ? true : false;
  $data['message'] = 'Successfully deleted the menu.';

  echo json_encode($data);

} else {
  echo "Data (json) is not transferred. Please check front end request";  
}

?>
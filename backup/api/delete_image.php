<?php
// header('Access-Control-Allow-Origin: http://localhost:4000');
include_once('./origin_config.php');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Content-type');

$postdata = file_get_contents("php://input");

if(isset($postdata) && !empty($postdata)) {
  $postdata = json_decode($postdata);

  if(file_exists(__DIR__ . $postdata->image_path)){
    if(unlink(__DIR__ . $postdata->image_path)) {
      // database update
      $target = $postdata->target;
      $image_path = '';
      $id = $postdata->id;

      require_once('./dbconn.php');
      $conn = new DbConnect();
      $db = $conn->connect();

      
      if($target == 'catregory') {
        $stmt = $db->prepare('UPDATE menu_category SET mc_image = ? WHERE mc_id = ?' );
      } else if($target == 'menu') {
        $stmt = $db->prepare('UPDATE menu_list SET ml_image = ? WHERE ml_id = ?' );
      } else {
        $data = ['status'=>9, 'message'=>'Error. target is not specified'];
        echo json_encode($data);
        exit;
      }

      if($stmt->execute([$image_path, $id])) {
        $data = ['status'=>0, 'message'=>'the image deleted succsessfully'];
      } else {
        $data = ['status'=>4, 'message'=>'Error occured during db query'];
      }
    } else {
      $data = ['status'=>4, 'message'=>'Error occured during the image file deletion'];
    }
  } else {
    $data = ['status'=>4, 'message'=>'Error. The file does not exist'];
  }
  echo json_encode($data);
  exit;
}

echo json_encode(['status'=>9, 'Parameter does not exist']);
?>
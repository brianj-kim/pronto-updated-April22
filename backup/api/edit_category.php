<?php
//header("Access-Control-Allow-Origin: http://localhost:4000");
include_once('./origin_config.php');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-type');

if(isset($_POST)) {
  // echo json_encode($_POST);
  // // echo empty($_FILES);
  // exit;

  $cid = (int)$_POST['cid'];
  $order = (int)$_POST['order'];
  $title = $_POST['title'];
  $details = $_POST['details'];
  $image_file_path = '';

  // If the post has an image, process the image to save on server directory
  if(!empty($_FILES['imageFile']['name'])) {
    // var_dump($_FILES);
    $db_path = '/category_images/';
    $upload_path = __DIR__ . $db_path;

    if (!is_dir( $upload_path)) {
      mkdir($upload_path, 0777, true);
    }

    $uploadfile = $upload_path . basename($_FILES['imageFile']['name']);
    
    if (move_uploaded_file($_FILES['imageFile']['tmp_name'], $uploadfile)) {
      $image_file_path = $db_path . $_FILES['imageFile']['name'];
    }
  }

  // database update
  require_once('./dbconn.php');
  $conn = new DbConnect();
  $db = $conn->connect();

  $stmt = $db->prepare('UPDATE `menu_category` SET mc_order = ?, mc_title = ?, mc_details = ?, mc_image = ? WHERE mc_id = ? ');
  if($stmt->execute([$order, $title, $details, $image_file_path, $cid])) {
    $data = new stdClass;
    $data -> cid = $cid;
    $data -> order = $order;
    $data -> title = $title;
    $data -> details = $details;
    $data -> imageFile = $image_file_path;
  } else {
    $data = ['status' => 0, 'message' => "Failed to update the category"];
  }

  echo json_encode($data);
}

?>
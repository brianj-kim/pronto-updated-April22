<?php
//header('Access-Control-Allow-Origin: http://localhost:4000');
include_once('./origin_config.php');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-type');

if(isset($_POST)) {

  // echo json_encode($_POST);
  // exit;

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

    // echo( __DIR__ . $uploaddir);
    // exit;

    $uploadfile = $upload_path . basename($_FILES['imageFile']['name']);
    
    if (move_uploaded_file($_FILES['imageFile']['tmp_name'], $uploadfile)) {
      $image_file_path = $db_path . $_FILES['imageFile']['name'];
    }
  }

  require_once('./dbconn.php');
  $conn = new DbConnect();
  $db = $conn->connect();

  $row_count = $db->query("SELECT count(*) FROM `menu_category` ")->fetchColumn() + 1;
  //echo $row_count;  

  $stmt = $db->prepare("INSERT INTO `menu_category` (`mc_order`, `mc_title`, `mc_details`, `mc_image`) VALUES ( 
    ?,
    ?,
    ?,
    ?
  )");

  if($stmt->execute([$row_count, $title, $details, $image_file_path])) {
    // $cid = $db->lastInsertId();

    $data = new stdClass;
    $data -> cid = $db->lastInsertId();
    $data -> order = $row_count;
    $data -> title = $title;
    $data -> details = $details;
    $data -> imageFile = $image_file_path;
    
  } else {
    $data = ['status' => 0, 'message' => "Failed to create the category"];
  }  

  echo json_encode($data);
}
?>
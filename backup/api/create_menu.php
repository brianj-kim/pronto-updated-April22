<?php
//header('Access-Control-Allow-Origin: http://localhost:4000');
include_once('./origin_config.php');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-type');

if(isset($_POST)) {
  // echo json_encode($_POST);
  // exit;
  
  $cid = (int)$_POST['cid'];
  $title = $_POST['title'];
  $details = $_POST['details'];
  $price = (double)$_POST['price'];

  ($_POST['isSpicy'] == 'true') ? $isSpicy = true : $isSpicy = false;
  ($_POST['isVeggie'] == 'true') ? $isVeggie = true : $isVeggie = false;
  
  $image_file_path = '';

  // If the post has an image, process the image to save on server directory
  if(!empty($_FILES['imageFile']['name'])) {
    // var_dump($_FILES);
    $db_path = '/menu_images/';
    $upload_path = __DIR__ . $db_path;

    if (!is_dir( $upload_path)) {
      mkdir($upload_path, 0777, true);
    }

    $uploadfile = $upload_path . basename($_FILES['imageFile']['name']);
    
    if (move_uploaded_file($_FILES['imageFile']['tmp_name'], $uploadfile)) {
      $image_file_path = $db_path . $_FILES['imageFile']['name'];
    }
  }

  require_once('./dbconn.php');
  $conn = new DbConnect();
  $db = $conn->connect();

  $tmp = $db->prepare("SELECT count(*) as count FROM `menu_list` WHERE mc_id = ? ");
  $tmp->execute([$cid]);
  $row_count = $tmp->fetchAll();
  $row_count = $row_count[0]['count'] +1;

  $stmt = $db->prepare("INSERT INTO `menu_list` (`mc_id`, `ml_order`, `ml_title`, `ml_details`, `ml_image`, `ml_price`, `ml_isSpicy`, `ml_isVeggie`) VALUES ( 
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?,
    ?
  )");

if($stmt->execute([$cid, $row_count, $title, $details, $image_file_path, $price, $isSpicy, $isVeggie])) {
  $data = new stdClass;
  $data -> mid = (int)$db->lastInsertId();
  $data -> order = $row_count;
  $data -> title = $title;
  $data -> details = $details;
  $data -> price = $_POST['price'];
  $data -> isVeggie = $isVeggie;
  $data -> isSpicy = $isSpicy;
  $data -> imageFile = $image_file_path;
  
} else {
  $data = ['status' => 0, 'message' => "Failed to create the menu"];
}   

  echo json_encode($data);
}

?>
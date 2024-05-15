<?php
// PATCH or PUT methods do not work with form data so this uses POST method
  //header("Access-Control-Allow-Origin: http://localhost:4000");
  include_once('./origin_config.php');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Content-type');

  // echo json_encode($_POST);
  // exit;

  if(isset($_POST)) {
    $mid = (int)$_POST['mid'];
    $title = $_POST['title'];
    $details = $_POST['details'];
    $image_file_path = '';
    $isVeggie = $_POST['isVeggie'] == 'true' ? true : false ;
    $isSpicy = $_POST['isSpicy'] == 'true' ? true : false ;
    $price = (double)$_POST['price'];
    $order = (int)$_POST['order'];

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

    // DB process
    require_once('./dbconn.php');
    $conn = new DbConnect();
    $db = $conn->connect();

    $stmt = $db -> prepare('UPDATE `menu_list` SET ml_title = ?, ml_details = ?, ml_order = ?, ml_image = ?, ml_price = ?, ml_isVeggie = ?, ml_isSpicy = ? WHERE ml_id = ? ');
    if($stmt->execute([$title, $details, $order, $image_file_path, $price, $isVeggie, $isSpicy, $mid])) {
      $data = new stdClass;
      $data -> mid = $mid;
      $data -> title = $title;
      $data -> details = $details;
      $data -> order = $order;
      $data -> price = $_POST['price'];
      $data -> isVeggie = $isVeggie;
      $data -> isSpicy = $isSpicy;
      $data -> imageFile = $image_file_path;
    } else {
      $data = ['status' => 0, 'message' => "Failed to update the menu information"];
    }

    echo json_encode($data);
  }

  

?>
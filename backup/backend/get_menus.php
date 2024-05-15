<?php

require_once('./origin_config.php');
header('Access-Control-Allow-Method: GET');
header('Access-Control-Allow-Headers: Content-type');
header('Content-Type: application/json');

require_once('./dbconn.php');
$conn = new DbConnect();
$db = $conn->connect();

$stmt = $db->prepare("SELECT 
t1.mc_id as cid, t1.mc_order as categoryOrder, t1.mc_title as categoryTitle, t1.mc_details as categoryDetails, t1.mc_image as categoryImage,
t2.ml_id as mid, t2.ml_order as menuOrder, t2.ml_title as menuTitle, t2.ml_details as menuDetails, t2.ml_image as menuImage, t2.ml_price as price, t2.ml_isVeggie as isVeggie, t2.ml_isSpicy as isSpicy
FROM menu_category AS t1 
LEFT JOIN menu_list AS t2 ON t1.mc_id = t2.mc_id 
ORDER BY t1.mc_order, t2.ml_order ASC");

$stmt -> execute();

$categoryOriginal = $stmt -> fetchAll();

$data = array();
$newKey = 0;

foreach( $categoryOriginal as $key => $item ) {
  // echo $key . ", ";
  $category = [
            'cid' => $item['cid'],
            'order' => $item['categoryOrder'],
            'title' => $item['categoryTitle'],
            'details' => $item['categoryDetails'],
            'image' => $item['categoryImage'],
            'menus' => array()
            
          ]; 

  if($newKey != $category['cid']) {
    $data[] = $category;
  }       
    
  if($item['mid'] != null) {
    $menu = [
      'mid' => $item['mid'],
      'order' => $item['menuOrder'],
      'title' => $item['menuTitle'],
      'details' => $item['menuDetails'],
      'image' => $item['menuImage'],
      'price' => $item['price'],
      'isVeggie' => (bool)$item['isVeggie'],
      'isSpicy' => (bool)$item['isSpicy']
    ];
    array_push($data[count($data)-1]['menus'], $menu);
  }
  
  $newKey = $item['cid'];    
}

require_once('./func_create_menu_json.php');
echo create_menu_json($data, '../menu_temp.json');

?>
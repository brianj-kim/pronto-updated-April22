<?php

require_once('./dbconn.php');
$conn = new DbConnect();
$db = $conn->connect();


$stmt = $db->query('SELECT mc_id as `id`, mc_order as `order`, mc_title as `title`, mc_details as `details`, mc_image as `image` FROM menu_category ORDER BY mc_order DESC');
$obj_array = $stmt->fetchAll();  

header('Content-Type: application/json');
echo json_encode($obj_array);

echo "Database Tested";
?>
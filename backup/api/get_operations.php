<?php
  //header('Access-Control-Allow-Origin: http://gopronto.ca');
  include_once('./origin_config.php');
  header('Access-Control-Allow-Method: GET');
  header('Content-Type: application/json');

  require_once('./dbconn.php');
  $conn = new DbConnect();
  $db = $conn->connect();

  $stmt = $db->prepare("SELECT `id` as oid, `day_in_int` as dayInt, `day_in_string` as dayString, `details` as details, `open_hour` as openHr, `open_min` as openMin, `close_hour` as closeHr, `close_min` as closeMin FROM `operations` ORDER BY `day_in_int` ASC");
  $stmt->execute();
  $operation_times = $stmt->fetchAll();

  $data = array();
  foreach( $operation_times as $key => $item ) {
    $data[] = [
      'oid' => $item['oid'],
      'dayInInt' => $item['dayInt'],
      'dayInStr' => $item['dayString'],
      'details' => $item['details'],
      'openHour' => $item['openHr'],
      'openMin' => $item['openMin'],
      'closeHour' => $item['closeHr'],
      'closeMin' => $item['closeMin']      
    ]; 
  }

  echo json_encode($data);
?>
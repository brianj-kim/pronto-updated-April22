<?php

function create_menu_json ($data, $path) {
  $fp = fopen($path, 'w');
  $msg = array('status' => 1, 'message'=>"File written successfully!" );

  try {
    fwrite($fp, json_encode($data));
  } catch (Exception $e) {
    $msg = array('status' => 0, 'message' => $e->getMessage());
  }
  
  fclose($fp);
  return json_encode($msg);
  // echo json_encode($data); 
}

?>
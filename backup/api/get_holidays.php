<?
  //header("Access-Control-Allow-Origin: http://gopronto.ca");
  include_once('./origin_config.php');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Content-type');

  $postdata = file_get_contents("php://input");

  if(isset($postdata) && !empty($postdata)){
    require_once('./dbconn.php');
    $conn = new DbConnect();
    $db = $conn->connect();

    $postdata = json_decode($postdata);

    // var_dump($postdata->fullYear);
    // exit;
    $qry = $db -> prepare('SELECT `date_in_string` as dateInStringISO FROM `holidays` WHERE year = ? ');
    $qry->execute([$postdata->fullYear]);

    $data = $qry->fetchAll();
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);
  } 
?>
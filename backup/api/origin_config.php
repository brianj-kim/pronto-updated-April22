<?php

$http_origin = $_SERVER['HTTP_ORIGIN'];
if ($http_origin == 'http://gopronto.ca' || $http_origin == 'http://localhost:4000') {
  header("Access-Control-Allow-Origin: $http_origin");
}

?>
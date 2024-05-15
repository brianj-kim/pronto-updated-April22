<?php
$http_origin = 'https://pronto-admin.brianjkim.dev';

if($_SERVER['HTTP_ORIGIN'] == 'http://localhost:4000') { // for the test from local device only
  $http_origin = $_SERVER['HTTP_ORIGIN'];
}

header("Access-Control-Allow-Origin: $http_orogin");

?>
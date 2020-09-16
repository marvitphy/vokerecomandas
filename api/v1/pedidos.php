<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Cache-Control: public');
header('Pragma: public');
header('Pragma: no-cache');
header('Content-type: application/json; charset=utf-8');
header('Connection: keep-alive');
header('Access-Control-Allow-Methods: GET');
header("Access-Control-Allow-Headers: Content-Type, X-Request-With, X-Requested-By");

include 'config.php';

$body = file_get_contents("php://input");

$sql = "SELECT * FROM pedidos";
$result = $db->query($sql);
$arr = array();
$arr['data'] = array();

$result_json = array();

while($rows = mysqli_fetch_assoc($result)){
  array_push($result_json, $rows);
}


echo json_encode($result_json);
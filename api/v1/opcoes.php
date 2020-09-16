<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Credentials: true');
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: public');
header('Pragma: no-cache');
header('Content-type: application/json; charset=utf-8');
header('Connection: keep-alive');
header('Access-Control-Allow-Methods: POST');
header("Access-Control-Allow-Headers: Content-Type, X-Request-With, X-Requested-By");

include 'config.php';

$user_id = $_POST['link'];

$sql = "SELECT * FROM especificacoes where link = '$user_id'";
$result = mysqli_query($db, $sql);

$result_json = array();
$result_json_2 = array();

while ($rows = mysqli_fetch_assoc($result)) {
  $result_2 = mysqli_query($db, $sql_2);
  array_push($result_json, $rows);

}

// send the result now
echo json_encode($result_json);
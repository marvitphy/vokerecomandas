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

$link = $_GET['link'];

$sql = "SELECT nomeEmpresa, descricao, cidade, estado, categoria FROM users where link = '$link'";
$result = mysqli_query($db, $sql);

$result_json = array();

while($rows = mysqli_fetch_assoc($result)){
  array_push($result_json, $rows);
}

// send the result now
echo json_encode($result_json);
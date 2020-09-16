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


if(isset($_POST['numMesa'])){
    $data = date('Y-m-d H:i:s');
    $numMesa = $_POST['numMesa'];
    $tipo = $_POST['tipo'];
    $user_id = $_POST['user_id'];
    $qr = $_POST['qrCode'];
    $sql = "INSERT INTO requests (num_mesa, tipo, user_id, qrCode, dataR) VALUES ('$numMesa', '$tipo', '$user_id', '$qr', '$data')";
    $query = mysqli_query($db, $sql);

}




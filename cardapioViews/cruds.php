<?php

include 'config.php';
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
session_start();

if(isset($_POST['numMesa'])){
    $data = date('Y-m-d H:i:s');
    $numMesa = $_POST['numMesa'];
    $tipo = $_POST['tipo'];
    $user_id = $_POST['user_id'];
    $qr = $_POST['qrCode'];
    $sql = "INSERT INTO requests (num_mesa, tipo, user_id, qrCode, dataR) VALUES ('$numMesa', '$tipo', '$user_id', '$qr', '$data')";
    $query = mysqli_query($db, $sql);

}

if(isset($_POST['email'])){
    $email = $_POST['email'];
    $nome = $_POST['username'];
    $wpp = $_POST['wpp'];
    $_SESSION['username_cliente'] = $nome;
    $_SESSION['email_cliente'] = $email;
    $sql = "INSERT INTO users_clientes (email, nome, telefone) VALUES ('$email', '$nome', '$wpp')";
    $query = mysqli_query($db, $sql);
 
}
if(isset($_POST['nome_cliente'])){
    $nomeC = $_POST['nome_cliente'];
    $detalhes = $_POST['detalhes'];
    $email  = $_POST['email'];
    $preco  = $_POST['precoP'];
    $nomeP = $_POST['nomeP'];
    $sql = "INSERT INTO pedidos_temp (nome_cliente, detalhes, nome_produto, preco, email) VALUES ('$nomeC', '$detalhes', '$nomeP', '$preco', '$email')";
    $query = mysqli_query($db, $sql);
 
}

<?php 


if(isset($_POST['cliente'])){
    $nomeC = $_POST['nome_cliente'];
    $detalhes = $_POST['detalhes'];
    $email  = $_POST['email'];
    $preco  = $_POST['precoP'];
    $nomeP = $_POST['nomeP'];
    $sql = "INSERT INTO pedidos_temp (nome_cliente, detalhes, nome_produto, preco, email) VALUES ('$nomeC', '$detalhes', '$nomeP', '$preco', '$email')";
    $query = mysqli_query($db, $sql);
 
}
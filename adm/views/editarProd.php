<?php 

include 'config.php';
session_start();
if(isset($_POST['prodId'])){
$nome = $_POST['nomeProduto'];
$descricao = $_POST['descricao'];
$categoria = $_POST['categoria'];
$preco = $_POST['preco'];
$id_prod = $_POST['prodId'];
$destacar = $_POST['destaque'];
$min = $_POST['min'];
$max = $_POST['max'];
mysqli_query($db,"UPDATE produtos SET nome = '$nome', descricao = '$descricao' , categoria = '$categoria', preco = '$preco', destaque = '$destacar', min = '$min', max = '$max' WHERE id = '$id_prod'");
echo 'Produto editado com sucesso!';
}
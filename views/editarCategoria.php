<?php 

include 'config.php';
session_start();

$id_cat = $_POST['catId'];
$nome = $_POST['catNome'];
$desc = $_POST['catDesc'];

mysqli_query($db,"UPDATE categorias SET nome = '$nome', descricao = '$desc' WHERE id = '$id_cat'");
echo $desc . $id_cat . $nome;

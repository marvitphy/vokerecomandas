<?php
include 'config.php';
session_start();

$link = $_POST['link'];
$id = $_SESSION['id'];
mysqli_query($db,"UPDATE users SET link = '$link' WHERE id = $id");
echo 'Categoria cadastrada com sucesso!';
?>


<?php
include 'config.php';
session_start();
$id = $_SESSION['id'];
$link = $_POST['link'];
$id = $_SESSION['id'];
mysqli_query($db,"UPDATE users SET link = '$link' WHERE id = $id");
echo 'Link editado com sucesso!';

?>


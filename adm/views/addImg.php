<?php

include('config.php');

if(isset($_POST['submit'])){
    $nome = $_POST['id'];
    $file = $_FILES['arquivo'];
    $fileName = $_FILES['arquivo']['name'];
    $ext = end(explode('.', $_FILES['arquivo']['name']));
    $mod = rand(0,1000);
    $newName = $nome . $mod . '.' . $ext;
    $fileDestino = 'imgs/' . $newName;
    mysqli_query($db,"UPDATE produtos SET foto = '$fileDestino' where id = '$nome'");
    move_uploaded_file($file["tmp_name"], $fileDestino);
    header('Location: ../dashboard#produtos');
}   
<?php
include "config.php";
session_start();
if(isset($_POST["pass"])&& isset($_POST["email"])){
    $email=$_POST["email"];
    $senha=$_POST['pass'];
    $sql="SELECT * FROM users WHERE email= '".$email."'";
    $query=mysqli_query($db,$sql);
    $dados=mysqli_fetch_assoc($query);
    $cryp= $dados["senha"];
    $id = $dados["id"];
        if(password_verify($senha,$cryp)){
            $_SESSION['log']=true;
            $_SESSION['id'] = $id;
            $_SESSION['user']=$dados['nome'];
            header("Location: dashboard.php");
        }
}


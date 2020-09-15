<?php

include 'config.php';
session_start();
if(isset($_POST["nome"])&& isset($_POST["e"])){
    $email= $_POST["e"];
    $nome = $_POST["nome"];
    $telefone = $_POST['telefone'];
    $sql = "INSERT INTO users_clientes (email, nome, telefone) VALUES ('$email', '$nome', '$wpp')";
    $query = mysqli_query($db, $sql);

    $_SESSION['username']=true;
    $_SESSION['email_cliente'] = $id;
    $rows=mysqli_num_rows($query);
    header("Location: dashboard");
    
    
        
}

?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro VComandas</title>

    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2aebc9aa31.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>
        body,
        html {
            background-color: #cfcfcf;
        }

        .cardapio {
            height: 100%;
            width: 700px;
            padding-left: 15px;
            display: flex;
        }

        .btn-mesa {
            background-color: rgba(0, 0, 0, 1);
        }

        .row {
            flex-direction: row;
        }

        /* Flex Container */
        .container {

            margin: 0 auto;
            display: flex;
            border: 1px solid #ccc;
        }

        .container-flex {

            margin: 0 auto;
            display: flex;
            border: 1px solid #ccc;
        }

        /* Flex Item */
        .item {
            /* O flex: 1; é necessário para que cada item se expanda ocupando o tamanho máximo do container. */
            flex: 1;
            margin: 5px;
            font-size: 1.1em;
        }

        .item-2 {
            /* O flex: 1; é necessário para que cada item se expanda ocupando o tamanho máximo do container. */
            flex: 0.5;
            margin: 5px;

            font-size: 1.5em;
        }

        .item-3 {
            /* O flex: 1; é necessário para que cada item se expanda ocupando o tamanho máximo do container. */
            flex: 0.2;
            margin-left: 5px;

            font-size: 1.5em;
        }


        .scrolling-wrapper {
            overflow-x: scroll;
            overflow-y: hidden;
            white-space: nowrap;
            padding-left: 15px;
        }

        .card-cat {
            display: inline-block;
            padding-top: 10px;

        }

        .cat-nome {
            font-size: 18px;
        }

        .item-img {
            background-color: gray;
            height: 85px;
            border-radius: 20px;
        }

        .infos {
            height: 50px;
            width: 100%;
            background-color: white;
            margin-bottom: 15px;
            padding-left: 15px;
            padding-top: 10px;
            font-family: 'Raleway', sans-serif;
            font-size: 4.5vw;
        }

        @media only screen and (max-width: 600px) {}

        .cardapio {
            width: 100%;
            background-color: #fcca03;
        }

        .opcoes-div {
            position: absolute;
            top: 0px;
            left: 0px;
            width: 100%;
            overflow: auto;
            background-color: #CCC;
            z-index: 1000;
            padding-top: 60px;
        }

        .op {
            background: rgba(0, 0, 0, 0.5);
            border-bottom: 2px solid white;
            color: white;
            padding: 20px;
            margin-left: 1px;
            margin-right: 1px;

        }
        .cart{
            width: 100%;
            height: 100%;
            background: white;
            position: absolute;
            top: 0px;
            left: 0px;
            padding-top: 60px;
        }
        .credenciais{
            width: 100%;
            height: 100%;
            background: white;
            position: absolute;
            top: 0px;
            left: 0px;
            padding-top: 30px;
        }
        .input{
            margin-top: 7px;
            border: 2px solid gray;
            border-radius: 25px;
        }
        .btn-entrar{
            margin-top: 7px;
            border-radius: 25px;
        }
    </style>
</head>

<body>
    
    <div class="credenciais">
        
        <div class="container-fluid">
            <div class="text-center fixed-bottom" style="margin-bottom: 20px; width: 100%">
            <img style"margin: 0 auto" src="http://www.vcomandas.com/assets/img/logo-dark.png" width="60%"> 
            </div>
            <br>
            <span class="font-weight-bold"><i class="fas fa-user"></i> Nome completo</span>
            <input type="text" class="form-control input username">
            <span><i class="fas fa-envelope-square "></i> Digite o seu email</span>
            <input type="email" class="form-control input email">
            <span><i class="fab fa-whatsapp"></i> Whatsapp</span>
            <input type="number" class="form-control input wpp">
            <button class="btn btn-success btn-block btn-entrar">Acessar</button>
        </div>
        
    </div>
    
    
</body>
</html>
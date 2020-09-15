<?php

include 'config.php';
$nome = $_GET['nome'];
$sql = "SELECT * FROM categorias where link = '$nome' ORDER BY nome ASC;";
$result = $db->query($sql);
$sql_user = "SELECT nomeEmpresa, id, categoria, link, descricao  FROM users where link = '$nome' ";
$result_user = $db->query($sql_user);
$rows_user = mysqli_fetch_array($result_user);

$value = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

session_start();

if (isset($_POST["nome"]) && isset($_POST["e"])) {
    $email = $_POST["e"];
    $nome = $_POST["nome"];
    $wpp = $_POST['telefone'];
    $sql = "INSERT INTO users_clientes (email, nome, telefone) VALUES ('$email', '$nome', '$wpp')";
    $query = mysqli_query($db, $sql);
    setcookie("nome", $nome);
    setcookie("email", $email);
    $_SESSION['username'] = $nome;
    $_SESSION['email_cliente'] = $email;
    $rows = mysqli_num_rows($query);
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
    <link rel="stylesheet" href="https://unpkg.com/onsenui/css/onsenui.css">
    <link rel="stylesheet" href="https://unpkg.com/onsenui/css/onsen-css-components.min.css">
    <script src="https://unpkg.com/onsenui/js/onsenui.min.js"></script>

    <style>
        body,
        html {
            background-color: #cfcfcf;
            width: 100%;
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
            font-size: 24px;
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
            padding-left: 15px;
            padding-top: 7px;

            font-family: 'Raleway', sans-serif;

        }

        @media only screen and (max-width: 600px) {

            .item {
                font-size: 5vw;

            }

            .infos {
                padding-top: 10px;
            }

        }

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

        .cart {
            width: 100%;
            height: 100%;
            background: white;
            position: fixed;
            overflow: auto;
            top: 0px;
            left: 0px;
            padding-top: 60px;
        }

        .credenciais {
            width: 100%;
            height: 100%;
            background: white;
            position: absolute;
            top: 0px;
            left: 0px;
            padding-top: 60px;
        }

        .input {
            margin-top: 7px;
            border: 2px solid gray;
            border-radius: 25px;
        }

        .btn-entrar {
            margin-top: 7px;
            border-radius: 25px;
        }
    </style>
</head>

<body>
    <div class="all">
        <span class="btn btn-mesa btn-block rounded-0 fixed-top text-white">Mesa: <span class="nMesa"><?php echo $_GET['mesa'] ?></span></span>

        <div class="cardapio " style="height: 165px; z-index: 1000; padding-top: 47px;">
            <div style=" height: 100px; width: 100px; background-image: url('https://fiverr-res.cloudinary.com/images/q_auto,f_auto/gigs/142219743/original/9e74d9934b01436935f084aecae3b0d7e8940392/design-creative-logo-for-restaurant.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; border-radius: 100%;"></div>

            <div class="text-left" style=" font-family: 'Raleway', sans-serif; font-size: 20px; margin-top: 28px; margin-left: 5px">

                <span style="font-weight: bold"><?php echo $rows_user['nomeEmpresa'] ?></span><br>
                <small style="transform: translateY(-10px)"><?php echo $rows_user['categoria'] ?></small>

            </div>

        </div>
        <div class="infos" style="margin-bottom: 12px;">
            <span class="item chamarG"><i class="fas fa-bell"></i> Chamar Garçon</span>
            <span class="item cart-btn"><i class="fas fa-shopping-cart "></i> Meu Carrinho </span>
        </div>

    </div>

    <div class="categorias"></div>
    <div class="produtos"></div>

    <div class="cart" style="display: none">
        <span class="float-left btn btn-dark text-white" style="border-radius: 25px">Meu carrinho</span><i class="far fa-times-circle float-right text-danger close-cart" style="margin-right: 15px; font-size: 26px"></i>
        <br><br>
        <div class="elements" style="margin-top: 5px">

        </div>
    </div>


    
    <?php if (!isset($_SESSION['username'])) { ?>
        <div class="credenciais">
            <div class="container-fluid">
                <form action="" method="POST">
                    <div class="text-center fixed-bottom" style="margin-bottom: 20px; width: 100%">
                        <img style="margin: 0 auto" src="http://www.vcomandas.com/assets/img/logo-dark.png" width="60%">
                    </div>
                    <br>
                    <span class="font-weight-bold"><i class="fas fa-user"></i> Nome completo</span>
                    <input type="text" name="nome" class="form-control input username">
                    <span><i class="fas fa-envelope-square "></i> Digite o seu email</span>
                    <input type="email" name="e" class="form-control input email">
                    <span><i class="fab fa-whatsapp"></i> Whatsapp</span>
                    <input type="number" name="telefone" class="form-control input wpp">
                    <button type="submit" class="btn btn-success btn-block btn-entraar">Acessar</button>
            </div>

        </div>
    <?php } ?>
</body>
<script>
    $(document).ready(function() {

        $('.btn-entrar').on('click', function() {
            var nomeCliente = $(".username").val()
            var email = $(".email").val()
            var wpp = $(".wpp").val()


            if (nomeCliente == '' || email == '') {
                alert('Preencha todos os campos!')
            } else {

                $.ajax({
                    url: "/cardapioViews/cruds.php",
                    method: 'post',
                    data: {
                        email: email,
                        username: nomeCliente,
                        wpp: wpp
                    },
                    success: function(response) {
                        alert('Cadastro realizado')
                        window.location.reload()
                    }
                });
            }

        })

        $('.cart-btn').click(function() {
            $('.cart').show();
            $('.elements').load('/pedidos_temp.php')
        })
        $('.close-cart').click(function() {
            $('.cart').hide();
        })
        $('.chamarG').on('click', function() {
            var numMesa = $('.nMesa').text();
            var tipo = 1
            var userId = '<?php echo $rows_user['id'] ?>'
            var qrCode = '<?php echo $rows_user['link'] ?>'

            $.ajax({
                url: "/cardapioViews/cruds.php",
                method: 'post',
                data: {
                    numMesa: numMesa,
                    tipo: tipo,
                    user_id: parseInt(userId),
                    qrCode: qrCode
                },
                success: function(response) {
                    ons.notification.alert('Garçom solicitado com sucesso!');
                }
            });

        })
        $('.categoria').on('click', function() {
            $(this).closest('.cat').find('.produto').slideToggle('fast');
        })

        $(".categorias").load('/cardapioViews/cardapioAll.php?id=' + <?php echo $rows_user['id']; ?>);

        Notification.requestPermission();
    })
</script>

</html>
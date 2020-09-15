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

$sql_produtos = "SELECT * from produtos where link
 = 'vpizzaria' ";
$query_produtos = mysqli_query($db, $sql_produtos);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro VComandas</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/2aebc9aa31.js" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/onsenui/css/onsenui.css">
    <link rel="stylesheet" href="https://unpkg.com/onsenui/css/onsen-css-components.min.css">

    <script src="https://unpkg.com/onsenui/js/onsenui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.min.js"></script>

    <link rel="stylesheet" type="text/css" href="main.css<?php echo '?' . mt_rand(); ?>">
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Signika&display=swap" rel="stylesheet">
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>


</head>

<body>


    <div id="app">
        <div class="toolbar toolbar--material">
            <div title="asdfasdf" class="toolbar__left toolbar--material__left">
                <span class="toolbar-button toolbar-button--material">
                    <i class="zmdi zmdi-menu"></i>
                </span>
            </div>
            <div class="toolbar__center toolbar--material__center">
                Mesa 1
            </div>

        </div>
        <div class="credenciais d-none container text-center position-fixed">
            <div class="login-form">

                <h2 class="text-center">Entrar</h2>
                <div class="or-seperator"><i>Acesse o cardápio de <span class="nome-empresa"></span></i></div>
                <div class="form-group text-left">
                    <span class=""><i class="fa fa-user"></i> Digite o seu nome:</span>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="João, Maria, José" required="required">
                    </div>
                </div>
                <div class="form-group text-left">
                    <span class=""><i class="fas fa-envelope"></i> Digite o seu email</span>
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="seu_email@email.com" required="required">
                    </div>
                </div>
                <div class="form-group text-left">
                    <span class=""><i class="fas fa-id-card"></i> Digite o seu cpf</span><br>
                    <small class="text-muted">Esta é apenas uma etapa de validação</small>
                    <div class="input-group">
                        <input type="text" id="CPF" class="form-control" name="password" placeholder="000.000.000-00" required="required">
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-success btn-block login-btn">Acessar</button>
                </div>

            </div>
        </div>
        <div class="all">

            <div class="cardapio " style="height: 135px; z-index: 1000; padding-top: 20px; padding-bottom: 0px;">
                <div style=" height: 100px; width: 100px; background-image: url('https://fiverr-res.cloudinary.com/images/q_auto,f_auto/gigs/142219743/original/9e74d9934b01436935f084aecae3b0d7e8940392/design-creative-logo-for-restaurant.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; border-radius: 100%;"></div>

                <div class="text-left" style=" font-family: 'Raleway', sans-serif; font-size: 20px; margin-top: 28px; margin-left: 5px">

                    <span style="font-weight: bold" class="nome-empresa"></span><br>
                    <small style="transform: translateY(-10px)" class="categoria-empresa"></small>

                </div>
            </div>
            <div class="infos" style="margin-bottom: 3px;">
                <span class="item chamarG"><i class="fas fa-bell"></i> Chamar Garçon</span>
            </div>

        </div>
        <div class="scrolling-wrapper categorias mb-2 mt-2">

        </div>


        <div class="modal-vk-body modal" style="display: none">

            <div class="modal-vk modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Escolha a quantidade</h5>
                        <button type="button" class="close fechar-modal" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <span class="nome_produto font-weight-bold"></span> <br> <br>
                        <i class="fas fa-minus-circle del_qtd" style="font-size: 28px; color: red"></i>
                        <input type="number" class="qtd_number" value="1" min="1" max="100" style="width: 100px; border-collapse: collapse; border: none; text-align: center; transform: translateY(-2px); font-size: 22px; font-weight: bold">

                        <i class="fas fa-plus-circle add_qtd" style="font-size: 28px; color: darkgreen"></i> <br>
                        <span class="preco_show"></span>
                        <span class="preco_show_2 d-none"></span>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary fechar-modal" data-dismiss="modal">Fechar</button>
                        <button type="button" class="btn btn-success add-to-cart">Adicionar</button>

                    </div>
                </div>
            </div>


        </div>

        <div class="produtos-all" style="margin-bottom: 150px">


            <div class="progress-bar progress-bar--material progress-bar--indeterminate"></div>

        </div>
    </div>

    <div class="carrinho-page">

        <ul class="list">
            <li class="list-header">
                itens no carrinho:
            </li>
        </ul>
        <br><br><br><br><br><br>



    </div>
    <div class="fixed-bottom total-price finalizar-pedido" style="display: none; width: 100%; text-align: center; bottom: 88px; ">
        <div class="btn btn-success" style="box-shadow: 0px 0px 15px gray;">Finalizar Pedido <small class="font-weight-bold">Total: </small><span class="badge badge-pill badge-light preco-final"></span></div>
    </div>
    <div class="pedir-page">
        <br><br><br><br><br><br>

    </div>

    <div class="pt-1 menu fixed-bottom text-center container-flex row" style="transform: translateY(); height: 55px; background-color: #f2f2f2; border-top-right-radius: 30px; border-top-left-radius: 30px; box-shadow: 0px 0px 15px gray; ">

        <div class="item item-menu pedir-btn" style="transition: 0.6s">

            <button class="fab fab--mini circleThing bg-dark" style="">
                <i class="fas fa-dollar-sign text-white"></i>
            </button> <br>
            <div style="transform: translateY(-5px)">
                <span class="item-menu-text" style="display: none">Pagar Conta</span>
            </div>
        </div>
        <span class="item item-menu item-menu-bottom cardapio-btn" style="transition: 0.6s">
            <button class="fab circleThing bg-dark item-menu-inside" style="">
                <i style="font-size: 22px; font-white" class="fas fa-book-open"></i>
            </button> <br>
            <div style="transform: translateY(-5px)">
                <span class="item-menu-text ">Cardápio</span>
            </div>
        </span>
        <div class="item item-menu carrinho-btn" href="#cart" style="transition: 0.6s">

            <span class="notification notification--material total-cart" style="position: absolute; transform: translateX(-20px); transform: translateY(-5px); z-index: 1000"></span>
            <button class="fab fab--mini circleThing bg-dark" style="">
                <i style="font-size: 20px; font-white" class="fas fa-shopping-cart"></i>
            </button><br>
            <div style="transform: translateY(-5px)">
                <span class="item-menu-text mb-1" style="display: none">Carrinho</span>
            </div>
        </div>

    </div>
</body>
<script src="assets/js/main.js<?php echo '?' . mt_rand(); ?>"></script>

</html>
<?php
include 'config.php';
session_start();


$id = $_SESSION['id'];
if(isset($_POST['nome'])){
$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$id = $_SESSION['id'];
$sql = "SELECT * from users where id='$id'";
$query = mysqli_query($db,$sql);
$result = mysqli_fetch_array($query);
$link= $result['link'];
mysqli_query($db,"INSERT INTO categorias (nome, descricao, user_id, link) VALUES ('$nome', '$descricao', '$id', '$link')");
echo 'Categoria cadastrada com sucesso! 😁';
}

if(isset($_POST['catExcluir'])){
$id = $_POST['catExcluir'];
$sql = "DELETE from categorias where id='$id'";
$query = mysqli_query($db,$sql);
echo 'Categoria excluída com sucesso!';
}

if(isset($_POST['prodExcluir'])){
$id = $_POST['prodExcluir'];
$sql = "DELETE from produtos where id='$id'";
$query = mysqli_query($db,$sql);
echo 'Produto excluído com sucesso!';
}
if(isset($_POST['idop'])){
$id_op = $_POST['idop'];
$sql = "DELETE from opcoes where id='$id_op'";
$query = mysqli_query($db,$sql);
echo 'Opção excluído com sucesso!';
}


if(isset($_POST['catNome']) && $_POST['catNome'] && $_POST['catDesc'] ){
$id_cat = $_POST['catId'];
$nome = $_POST['catNome'];
$desc = $_POST['catDesc'];

mysqli_query($db,"UPDATE categorias SET nome = '$nome', descricao = '$desc' WHERE id = '$id_cat'");
echo 'Categoria editada com sucesso!';
}

if(isset($_POST['mesaNumero']) ){
$mesaNumero = $_POST['mesaNumero'];

mysqli_query($db,"UPDATE requests SET status = 0 WHERE user_id = '$id' and num_mesa='$mesaNumero'");
echo 'Status da mesa alterado';
}

if(isset($_POST['idOpc']) ){
$idOpc = $_POST['idOpc'];
$n_opc = $_POST['n_opc'];
$d_opc = $_POST['d_opc'];

mysqli_query($db,"UPDATE opcoes SET nome = '$n_opc', descricao = '$d_opc' where id = '$idOpc'");

}

if(isset($_POST['mesa'])){
$mesa = $_POST['mesa'];
$sql = "SELECT * from users where id='$id'";
$query = mysqli_query($db,$sql);
$result = mysqli_fetch_array($query);
$link= $result['link'];
mysqli_query($db,"INSERT INTO mesas (numero_mesa, user_id, qrCode) VALUES ('$mesa', '$id', '$link')");
echo 'Mesa Cadastrada com sucesso!';
}

if(isset($_POST['nomeProd'])){
$nome = $_POST['nomeProd'];
$descricao = $_POST['descricao'];
$categoria = $_POST['categoria'];
$preco = $_POST['preco'];
$min = $_POST['minProd'];
$max = $_POST['maxProd'];
$sql = "SELECT * from users where id='$id'";
$query = mysqli_query($db,$sql);
$result = mysqli_fetch_array($query);
$link= $result['link'];
mysqli_query($db,"INSERT INTO produtos (user_id, nome, descricao, preco, categoria, link,  min, max) VALUES ('$id', '$nome', '$descricao', '$preco', '$categoria', '$link', '$min', '$max')");
echo 'Produto cadastrado com sucesso!';
}

if(isset($_POST['idOp'])){
$idOp = $_POST['idOp'];
$nome = $_POST['nomeOp'];
$desc = $_POST['descOp'];
$min = $_POST['minOp'];
$max = $_POST['maxOp'];
$sql = "SELECT * from users where id='$id'";
$query = mysqli_query($db,$sql);
$result = mysqli_fetch_array($query);
$link= $result['link'];
mysqli_query($db,"INSERT INTO opcoes (nome, descricao, produto_id, empresa_id) VALUES ('$nome', '$desc', '$idOp', '$id')");
echo 'Opção cadastrada com sucesso!';
}




?>


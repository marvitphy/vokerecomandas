<?php
include "config.php";

$dadosUser= array(
    'nomeResponsavel' => $_POST['nome'] ,
    'sobrenomeResponsavel' => $_POST['sobrenome'] ,
    'nomeEmpresa' => $_POST['nomeEmpresa'] ,
    'telefone' => $_POST['telefone'] ,
    'cnpj' => $_POST['cnpj'] ,
    'cidade' => $_POST['cidade'] ,
    'estado' => $_POST['estado'] ,
    'enderecoEmpresa' => $_POST['enderecoEmpresa'] ,
    'email' => $_POST['email'] ,
    'senha_1' =>$_POST['senha01'],
    'senha_2' =>$_POST['senha02']
);

$hash=md5($dadosUser["senha_2"]);

$sqlVerificarEmail="SELECT * FROM users WHERE email ='".$dadosUser["email"]."'";
$queryVE=mysqli_query($db,$sqlVerificarEmail);
$rows=mysqli_num_rows($queryVE);

if($rows==0){
    $sql="INSERT INTO users";
    $sql.="(nomeResponsavel,sobrenomeResponsavel,nomeEmpresa,telefone,cnpj,estado,cidade,enderecoEmpresa,email,senha_1,senha_2)";
    $sql.=" VALUES('".$dadosUser["nomeResponsavel"]."','".$dadosUser["sobrenomeResponsavel"]."','".$dadosUser["nomeEmpresa"]."','".$dadosUser["telefone"]."','".$dadosUser["cnpj"]."','".$dadosUser["estado"]."','".$dadosUser["cidade"]."','".$dadosUser["enderecoEmpresa"]."','".$dadosUser["email"]."','".$hash."','".$hash."')";
    $query=mysqli_query($db,$sql);
    $json=array("error"=>false,"success"=>true);
    echo json_encode($json);
    header('Location: ../dashboard.php');
}else{
    $json=array("error"=>true,"success"=>false);
    echo json_encode($json);
}
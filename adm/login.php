<?php
include "config.php";
session_start();
if(isset($_POST["pass"])&& isset($_POST["email"])){
    $email=$_POST["email"];
    $senha= md5($_POST['pass']);
    $sql="SELECT * FROM users WHERE email='$email' AND senha_1='$senha'";
    $query=mysqli_query($db,$sql);
    $dados=mysqli_fetch_assoc($query);
    $id = $dados["id"];
    $email = $dados["email"];
    $_SESSION['log']=true;
    $_SESSION['id'] = $id;
    $_SESSION['email'] = $email;
    $_SESSION['empresa']=$dados['nomeEmpresa'];
    $rows=mysqli_num_rows($query);
    if($rows > 0){
        
        header("Location: dashboard");
        
    }else{
        echo '<br><span class="verify bg-danger p-2 text-white rounded">Email ou senha incorretos</span>';
        
    }
    
    
        
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Vokerê Comandas</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<style>
    :root {
  --input-padding-x: 1.5rem;
  --input-padding-y: .75rem;
}

body {
  background: #007bff;
  background: linear-gradient(to right, #0062E6, #33AEFF);
}

.card-signin {
  border: 0;
  border-radius: 1rem;
  box-shadow: 0 0.5rem 1rem 0 rgba(0, 0, 0, 0.1);
}

.card-signin .card-title {
  margin-bottom: 2rem;
  font-weight: 300;
  font-size: 1.5rem;
}

.card-signin .card-body {
  padding: 2rem;
}

.form-signin {
  width: 100%;
}

.form-signin .btn {
  font-size: 80%;
  border-radius: 5rem;
  letter-spacing: .1rem;
  font-weight: bold;
  padding: 1rem;
  transition: all 0.2s;
}

.form-label-group {
  position: relative;
  margin-bottom: 1rem;
}

.form-label-group input {
  height: auto;
  border-radius: 2rem;
}

.form-label-group>input,
.form-label-group>label {
  padding: var(--input-padding-y) var(--input-padding-x);
}

.form-label-group>label {
  position: absolute;
  top: 0;
  left: 0;
  display: block;
  width: 100%;
  margin-bottom: 0;
  /* Override default `<label>` margin */
  line-height: 1.5;
  color: #495057;
  border: 1px solid transparent;
  border-radius: .25rem;
  transition: all .1s ease-in-out;
}

.form-label-group input::-webkit-input-placeholder {
  color: transparent;
}

.form-label-group input:-ms-input-placeholder {
  color: transparent;
}

.form-label-group input::-ms-input-placeholder {
  color: transparent;
}

.form-label-group input::-moz-placeholder {
  color: transparent;
}

.form-label-group input::placeholder {
  color: transparent;
}

.form-label-group input:not(:placeholder-shown) {
  padding-top: calc(var(--input-padding-y) + var(--input-padding-y) * (2 / 3));
  padding-bottom: calc(var(--input-padding-y) / 3);
}

.form-label-group input:not(:placeholder-shown)~label {
  padding-top: calc(var(--input-padding-y) / 3);
  padding-bottom: calc(var(--input-padding-y) / 3);
  font-size: 12px;
  color: #777;
}

.btn-google {
  color: white;
  background-color: #ea4335;
}

.btn-facebook {
  color: white;
  background-color: #3b5998;
}

/* Fallback for Edge
-------------------------------------------------- */

@supports (-ms-ime-align: auto) {
  .form-label-group>label {
    display: none;
  }
  .form-label-group input::-ms-input-placeholder {
    color: #777;
  }
}

</style>

<body>
    <div class="container">
      <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
          <div class="card card-signin my-5">
            <div class="card-body">
              <h5 class="card-title text-center">Login</h5>
              <form class="form-signin" action="" method="post">
                <div class="form-label-group">
                    
                  <input type="email" id="inputEmail" class="form-control" placeholder="Email" required autofocus name="email">
                  <div class="return"></div>
                  <label for="inputEmail">Email</label>
                </div>
  
                <div class="form-label-group">
                  <input type="password" id="inputPassword" class="form-control" style="pointer-events: none;" placeholder="Senha" required name="pass">
                  <label for="inputPassword">Senha</label>
                </div>
  
                <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit">Entrar</button>
                <hr class="my-4">
                <button class="btn btn-lg btn-google btn-block text-uppercase" type="submit"><img width="180px" style="fill: white" src="http://www.vcomandas.com/assets/img/logo-dark.png"></button>
                
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>


    <script>

        $(document).ready(function () {

        function verificar(email){
            
            $.ajax({
                url: "php/verificarEmail.php",
                method: 'post',
                dataType : 'html',
                data: {email: email},
                success: function (response) {
                    $('.return').html(response)

                }
            });
            
        }  
        
         function validateEmail(email){
        var re = /\S+@\S+\.\S+/;
        return re.test(email);
            
        }
        
        
        
        $('#inputEmail').on('change', function(){
            var email = $('#inputEmail').val()
            if(validateEmail(email) == true){
                verificar(email)
            }else{
                $('.return').html('<br><span class="bg-warning p-2 rounded">Email inválido</span>')
            }
            
        })
        
       

        
        
            
        })
    </script>
</body>

</html>
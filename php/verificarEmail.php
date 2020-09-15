<?php
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: *');
 
  header('Access-Control-Allow-Credentials: true');
  header('Cache-Control: no-cache');
  header('Pragma: no-cache');
    header('Content-type: text/html');

include "config.php";
if(isset($_POST["email"])){
       $email=$_POST["email"];
    $sql="SELECT * FROM users WHERE email= '". $email ."'";
    $query=mysqli_query($db,$sql);
    $dados=mysqli_fetch_assoc($query);
    $rows=mysqli_num_rows($query);
    if($rows <= 0){
        echo '<br><span class="verify bg-danger p-2 text-white rounded">Email não cadastrado</span>';
    }

}



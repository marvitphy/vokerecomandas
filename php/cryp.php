<?php
$hash=password_hash("Gabriel1rocha2",PASSWORD_DEFAULT,['cost'=>12]);
echo $hash;


if(password_verify("Gabriel1rocha2",$hash)){
    echo "<br> <p>foi</p>";
}else{
    echo "<script> console.log('não foi');</script>";
}
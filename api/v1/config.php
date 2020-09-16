<?php

  $db = new mysqli('localhost', 'u951173166_vc', 'Vcomandas54321', 'u951173166_vc');
  if ($db->connect_error) {
    die("Conexão não estabelecida" . $conn->connect_error);
  }

?>
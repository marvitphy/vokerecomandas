<?php 

session_start();
if(!isset($_SESSION['email'])){
    header('Location: login.php');
}
if(isset($_GET['logout'])){
    session_destroy();
    header('Location: login.php');
}
include 'headerDash.php';
include 'mainDash.php';
include 'footerDash.php';
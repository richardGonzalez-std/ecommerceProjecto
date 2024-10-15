<?php
$host = 'localhost';
$user = 'root';
$password = '';
$db = 'ecommerce';
$link = mysqli_connect($host,$user,$password,$db);

if(!$link){
    die('Error de conexión' . mysqli_connect_error());
}
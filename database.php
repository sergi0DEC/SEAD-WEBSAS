<?php

$server = 'localhost';
$username = 'root';
//$username = 'websas';
$password = '';
//$password = 'Y3iC+vF7Vx(ybqjk';
$database = 'websas_database';
// $database = 'id19826863_websas_database';

try {
  $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
  die('Connection Failed: ' . $e->getMessage());
}

$connn = new mysqli($server , $username, $password, $database);
    mysqli_query($connn , "SET CHARACTER SET utf8");
    if($connn->connect_error){
        die("Database Error : " . $connn->connect_error);
    }
?>
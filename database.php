<?php

$server = 'localhost';
$username = 'root';
$password = '';
$database = 'websas_database';

try {
  $conn = new PDO("mysql:host=$server;dbname=$database;", $username, $password);
} catch (PDOException $e) {
  die('Connection Failed: ' . $e->getMessage());
}

$connn = new mysqli($server , $username, $password, $database);
    mysqli_query($connn , "SET character_set_result=utf8");
    if($connn->connect_error){
        die("Database Error : " . $connn->connect_error);
    }
?>
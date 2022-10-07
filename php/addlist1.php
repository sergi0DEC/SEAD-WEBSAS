<?php

require '../database.php';

    if($_POST['name'] != null && $_POST['amount'] != null ){
        $sql = "INSERT INTO product (proname,amount) VALUES ('". trim($_POST['name']). "','". trim($_POST['amount']). "')";
        if($connn->query($sql)){
            echo "<script>alert('Success added')</script>";
            header("Refresh:0 , url = ../addlist.php");
            exit();

        }
        else{
            echo "<script>alert('Add failed')</script>";
            header("Refresh:0 , url = ../addlist.php");
            exit();

        }
    }
?>
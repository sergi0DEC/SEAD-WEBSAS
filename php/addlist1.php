<?php

require '../database.php';
if($_POST['name'] != null && $_POST['amount'] != null ){
    $sql = "INSERT INTO product (proname,amount) VALUES ('". trim($_POST['name']). "','". trim($_POST['amount']). "')";
    if($connn->query($sql)){
        header("Refresh:0 , url = ../list.php");
        echo "<script>alert('¡Inventario agregado con éxito!')</script>";
        exit();

    }
    else{           
        header("Refresh:0 , url = ../list.php");
        echo "<script>alert('Fallo al agregar inventario')</script>";
        exit();

    }
}
?>
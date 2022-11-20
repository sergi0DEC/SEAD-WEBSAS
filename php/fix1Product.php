<?php

require '../database.php';
if($_POST['name'] != null && $_POST['marca'] != null){
    $sql = "UPDATE productos_marcas SET nombre = '" . trim($_POST['name']) . "' ,marca = '" . trim($_POST['marca']) . "',descripcion = '" . trim($_POST['descripcion']) . "' WHERE id = '" . $_POST['id'] . "'";
    if($conn->query($sql)){
        header("Refresh:0 , url =../productos.php");
        echo "<script>alert('Proceso completado exitósamente')</script>";
        exit();

    }
    else{       
        header("Refresh:0 , url =../productos.php");
        echo "<script>alert('Inconvenientes para realizar el proceso')</script>";
        exit();

    }
}
?>
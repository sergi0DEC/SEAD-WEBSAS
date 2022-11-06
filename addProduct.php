<?php
require 'database.php';

    if($_POST['nombre'] != null && $_POST['marca'] != null && $_POST['descripcion'] != null ){
        $sql = "INSERT INTO productos_marcas(nombre,marca,descripcion) VALUES ('". trim($_POST['nombre'])."', '". trim($_POST['marca'])."', '". trim($_POST['descripcion'])."')";
                if($connn-> query($sql)){
                    echo "<script>alert('Success added')</script>";
                    header("Refresh:0 , url = productos.php");
                    exit();
                }
                else{
                    echo "<script>alert('Add failed')</script>";
                    header("Refresh:0 , url = productos.php");
                    exit();
        
                }
    }

?>
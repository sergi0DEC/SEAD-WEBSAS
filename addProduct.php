<?php
require 'database.php';

    if($_POST['nombre'] != null && $_POST['marca'] != null && $_POST['descripcion'] != null ){
        $sql = "INSERT INTO productos_marcas(nombre,marca,descripcion) VALUES ('". trim($_POST['nombre'])."', '". trim($_POST['marca'])."', '". trim($_POST['descripcion'])."')";
                if($connn-> query($sql)){                
                    header("Refresh:0 , url = productos.php");
                    echo "<script>alert('¡Producto Agregado con éxito!')</script>";
                    exit();
                }
                else{
                    header("Refresh:0 , url = productos.php");
                    echo "<script>alert('Error al agregar el producto')</script>";
                    exit();
        
                }
    }

?>
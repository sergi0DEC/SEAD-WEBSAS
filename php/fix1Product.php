<?php

require '../database.php';
if($_POST['name'] != null && $_POST['marca'] != null){
    $sql = "UPDATE productos_marcas SET nombre = '" . trim($_POST['name']) . "' ,marca = '" . trim($_POST['marca']) . "',descripcion = '" . trim($_POST['descripcion']) . "' WHERE id = '" . $_POST['id'] . "'";
    if($conn->query($sql)){
        echo "<script>alert('Proceso completado exitósamente')</script>";
        header("Refresh:0 , url =../productos.php");
        exit();

    }
    else{
        echo "<script>alert('Inconvenientes para realizar el proceso')</script>";
        header("Refresh:0 , url =../productos.php");
        exit();

    }
}
else{
//    echo "<script>alert('Por favor diligencia todos los campos')</script>";
//    header("Refresh:0 , url = ../list.php");
//    exit();

}
// mysqli_close($connn);
?>